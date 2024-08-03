<?php

namespace App\Controllers\Waserda;
use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\ItemTerjualModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;
use App\Models\UserModel;

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
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new BarangModel;
        $data['result'] = $model->findAll();

        echo view("waserda/kasir", $data);
    }

    public function kasir()
    {

        $barangModel = new BarangModel();
        $result = [];

        if ($this->request->isAJAX()) {
            $q = $this->request->getVar('q');
            $result = $barangModel->like('nama_barang', $q)
                ->orLike('barcode', $q)
                ->findAll();

            return view('components/tabelbarangtransaksi', ['result' => $result]);
        }

        return view('waserda/transaksi', ['result' => $result]);
    }

    public function selesaitransaksi()
    {
        if ($this->request->getMethod() === 'post') {
            $penjualanModel = new PenjualanModel();
            $itemTerjualModel = new ItemTerjualModel();
            $stokModel = new StokModel();
    
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
                $db->transCommit(); // Commit jika semua berhasil
                session()->setFlashdata('success', 'Transaction completed successfully');
                return redirect()->to(base_url('waserda/kasir/redirect_to_receipt/' . $penjualanId));
            } else {
                $db->transRollback(); // Rollback jika ada kesalahan
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
    
}
