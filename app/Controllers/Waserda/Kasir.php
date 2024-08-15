<?php

namespace App\Controllers\Waserda;
use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BarangModel;
use App\Models\ItemTerjualModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;
use App\Models\UserModel;
use App\Models\CreditsModel;
use DateTime;
use DateInterval;
class Kasir extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') !== "kasir" && session()->get('role') !== "admin") {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {
        $stokModel = new StokModel();
        $itemTerjualModel = new ItemTerjualModel();
        $barangModel = new BarangModel();
    
        $currentDate = new DateTime();
        $startDate = $currentDate->sub(new DateInterval('P30D'))->format('Y-m-d');
    
        // Query untuk mendapatkan produk dengan penjualan tertinggi
        $topsell = $itemTerjualModel->select('barang.nama_barang, SUM(item_terjual.jumlah * item_terjual.harga) as total_penjualan')
                                    ->join('barang', 'barang.id_barang = item_terjual.id_barang')  // Perbaikan join
                                    ->where('item_terjual.tanggal >=', $startDate)
                                    ->groupBy('barang.id_barang')
                                    ->orderBy('total_penjualan', 'DESC')
                                    ->first();
    
        // Mengambil data stok 30 hari terakhir
        $stokData = $stokModel->select('DATE(tanggal) as tanggal, SUM(kuantitas * harga_beli) as total_beli')
                              ->where('tanggal >=', $startDate)
                              ->groupBy('DATE(tanggal)')
                              ->orderBy('tanggal', 'ASC')
                              ->findAll();
    
        // Mengambil data penjualan 30 hari terakhir
        $penjualanData = $itemTerjualModel->select('DATE(tanggal) as tanggal, SUM(jumlah * harga) as total_jual')
                                          ->where('tanggal >=', $startDate)
                                          ->groupBy('DATE(tanggal)')
                                          ->orderBy('tanggal', 'ASC')
                                          ->findAll();
    
        // Penggabungan data berdasarkan tanggal
        $mergedData = [];
        foreach ($stokData as $stok) {
            $mergedData[$stok['tanggal']]['tanggal'] = $stok['tanggal'];
            $mergedData[$stok['tanggal']]['total_beli'] = $stok['total_beli'];
        }
    
        foreach ($penjualanData as $penjualan) {
            $mergedData[$penjualan['tanggal']]['tanggal'] = $penjualan['tanggal'];
            $mergedData[$penjualan['tanggal']]['total_jual'] = $penjualan['total_jual'];
        }
    
        // Mengisi data yang kosong dengan 0 untuk tanggal yang tidak ada
        $completeData = [];
        for ($i = 0; $i < 30; $i++) {
            $date = (new DateTime())->sub(new DateInterval('P' . (29 - $i) . 'D'))->format('Y-m-d');
            $completeData[] = [
                'tanggal' => $date,
                'total_beli' => isset($mergedData[$date]['total_beli']) ? $mergedData[$date]['total_beli'] : 0,
                'total_jual' => isset($mergedData[$date]['total_jual']) ? $mergedData[$date]['total_jual'] : 0
            ];
        }
    
        $data = [
            'financialData' => $completeData,
            'topsell' => $topsell
        ];
    
        return view("waserda/kasir", $data);
    }
    
    

    public function kasir()
    {
        $barangModel = new BarangModel();
        $anggotaModel = new AnggotaModel();
        $result = [];
    
        if ($this->request->isAJAX()) {
            $q = $this->request->getVar('q');
            $result = $barangModel->like('nama_barang', $q)
                ->orLike('barcode', $q)
                ->findAll();
    
            return view('components/tabelbarangtransaksi', ['result' => $result]);
        }
    
        // Ambil data anggota untuk dropdown
        $anggotaList = $anggotaModel->findAll();
        
        return view('waserda/transaksi', [
            'result' => $result,
            'anggotaList' => $anggotaList,
        ]);
    }
    

    public function selesaitransaksi()
    {
        if ($this->request->getMethod() === 'post') {
            $penjualanModel = new PenjualanModel();
            $itemTerjualModel = new ItemTerjualModel();
            $stokModel = new StokModel();
            $creditsModel = new CreditsModel();
    
            $data = [
                'id_anggota' => $this->request->getVar('id_anggota'),
                'metode_pembayaran' => $this->request->getVar('metode_pembayaran'),
                'tanggal' => date('Y-m-d H:i:s'),
                'id_users' => session()->get('id'), // assuming you store user id in session
                'total_belanja' => $this->request->getVar('total_belanja'),
                'struk' => 'STRUK_' . time() // Generate a simple struk value
            ];
    
            // Mulai Transaksi
            $db = \Config\Database::connect();
            $db->transStart();
    
            // Save the transaction
            $penjualanModel->insert($data);
            $penjualanId = $penjualanModel->insertID();
    
            $transactionSuccessful = true;
            $errorMessage = '';
    
            // Save the transaction details
            $cartItems = $this->request->getVar('cart');
            foreach ($cartItems as $item) {
                // Fetch the stock entries for the current item
                $stockEntries = $stokModel->getstokbarang($item['id_barang']);
    
                $remainingQuantity = $item['quantity'];
    
                foreach ($stockEntries as $stockEntry) {
                    if ($remainingQuantity <= 0) {
                        break;
                    }
    
                    $availableQuantity = $stockEntry['kuantitas'] - $stockEntry['terjual'];
    
                    if ($availableQuantity > 0) {
                        $quantityToDeduct = min($remainingQuantity, $availableQuantity);
    
                        // Update the stock quantity and sales count
                        $stokModel->update($stockEntry['id_stok'], [
                            'terjual' => $stockEntry['terjual'] + $quantityToDeduct
                        ]);
    
                        // Save the transaction detail with the correct stock ID
                        $detailData = [
                            'id_penjualan' => $penjualanId,
                            'id_barang' => $item['id_barang'],
                            'jumlah' => $quantityToDeduct,
                            'harga' => $item['total_price'] / $item['quantity'],
                            'tanggal' => date('Y-m-d H:i:s'),
                            'id_users' => session()->get('id'), // assuming you store user id in session
                            'id_stok' => $stockEntry['id_stok']
                        ];
                        $itemTerjualModel->insert($detailData);
    
                        $remainingQuantity -= $quantityToDeduct;
                    }
                }
    
                if ($remainingQuantity > 0) {
                    $transactionSuccessful = false;
                    $errorMessage = 'Insufficient stock for item ' . $item['id_barang'];
                    break;
                }
            }
    
            if ($transactionSuccessful) {
                // Handle credit payment
                if ($data['metode_pembayaran'] === 'credits') {
                    $creditData = [
                        'id_anggota' => $data['id_anggota'],
                        'id_penjualan' => $penjualanId,
                        'status' => 'belum lunas'
                    ];
                    $creditsModel->insert($creditData);
                }
    
                $db->transCommit(); // Commit if all successful
                session()->setFlashdata('success', 'Transaction completed successfully');
                return redirect()->to(base_url('waserda/kasir/redirect_to_receipt/' . $penjualanId));
            } else {
                $db->transRollback(); // Rollback if any errors
                session()->setFlashdata('error', $errorMessage);
                return redirect()->to(base_url('waserda/kasir'));
            }
        }
    }
    
    
    public function redirect_to_receipt($id_penjualan)
{
    $data['id_penjualan'] = $id_penjualan;
    return view('waserda/redirect_receipt', $data);
}

    public function receipt($id_penjualan)
    {
        $penjualanModel = new PenjualanModel();
        $itemTerjualModel = new ItemTerjualModel();
        $barangModel = new BarangModel(); // Add this line to include the BarangModel
    
        // Fetch the main transaction details
        $transaction = $penjualanModel->find($id_penjualan);
        
        // Fetch the items sold in this transaction
        $items = $itemTerjualModel->where('id_penjualan', $id_penjualan)->findAll();
    
        // Fetch additional item details if needed
        foreach ($items as &$item) {
            $itemDetails = $barangModel->find($item['id_barang']); // Fetch the barang details using the BarangModel
            $item['nama_barang'] = $itemDetails['nama_barang'];  // Assuming this field exists in the barang table
        }
        
        // Pass the data to the view
        $data = [
            'transaction' => $transaction,
            'items' => $items
        ];
        
        return view('waserda/receipt', $data);
    }
    
    
    // Controller produk/barang
    public function edit_produk($id_barang)
    {
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new BarangModel;
        $data['barang'] = $model->where('id_barang', $id_barang)->first();

        return view('waserda/edit_produk', $data);
    }

    // Controller penjualan
    public function data_penjualan()
    {
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;
        
        $penjualanModel = new PenjualanModel();
        $userModel = new UserModel();

        $searchQuery = $this->request->getGet('q');
    
        // Get the current page from the query string, defaulting to the first page
        $page = $this->request->getVar('page') ?? 1;
    
        //query pencarian jika di inputkan
        if($searchQuery) {
            $penjualanModel->select('penjualan.*, users.surename as nama_petugas')
                            ->join('users', 'users.id = penjualan.id_users')
                            ->groupStart()
                            ->like('penjualan.struk',$searchQuery)
                            ->orLike('users.surename', $searchQuery)
                            ->groupEnd()
                            ->orderBy('penjualan.tanggal','DESC');

        }else{
            //jika tidak ada inputan pencarian
            $penjualanModel->select('penjualan.*, users.surename as nama_petugas')
            ->join('users', 'users.id = penjualan.id_users')
            ->orderBy('penjualan.tanggal','DESC');
        }
        // Fetch paginated data
        $penjualan = $penjualanModel->paginate(10, 'group1'); // 10 records per page
    
    
        $data['result'] = $penjualan;
        $data['pager'] = $penjualanModel->pager;
        $data['searchQuery'] = $searchQuery;
    
        echo view("waserda/data_penjualan", $data);
    }
    

 //kredit waserda
 public function credits(){
    $creditsModel = new CreditsModel();
    $creditstotal = $creditsModel->select('credits.status,anggota.id_anggota, anggota.surename, anggota.kelompok_tani, SUM(penjualan.total_belanja) as total_credits')
                                ->join('penjualan','credits.id_penjualan = penjualan.id_penjualan')
                                ->join('anggota', 'anggota.id_anggota = credits.id_anggota')
                                ->groupBy('credits.id_anggota')
                                ->orderBy('kelompok_tani')
                                ->findAll();                                                                                                                                                                                    
    $data['credits'] =$creditstotal;
    return view('waserda/credits', $data);
 }
}
