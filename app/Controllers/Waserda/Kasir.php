<?php

namespace App\Controllers\Waserda;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\ItemTerjualModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;

//require_once '../BaseController.php';

class Kasir extends BaseController
{
    public function __construct()
    {
        
        if (session()->get('role') !== "kasir" && session()->get('role') !=="admin") {
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
        $data['result']=$model->findAll();

        echo view("waserda/kasir",$data);
    }
    
    public function kasir()
    {
        $sess = session();
        $role = $sess->get('role');
        $username = $sess->get('username');
        $surename = $sess->get('surename');

        $result['role'] = $role;
        $result['username'] = $username;
        $result['surename'] = $surename;
       
        $barangModel = new BarangModel();
        $result = [];

        if ($this->request->isAJAX()) {
            $q = $this->request->getVar('q');
            $result = $barangModel->like('nama_barang', $q)->findAll();

            return view('components/tabelbarangtransaksi', ['result' => $result]);
        }

        return view('waserda/transaksi', ['result' => $result]);
    }

 
    public function completeTransaction()
    {
        if ($this->request->getMethod() === 'post') {
            $penjualanModel = new PenjualanModel();
            $itemTerjualModel = new ItemTerjualModel();
            $stokModel = new StokModel();
    
            $totalBelanja = $this->request->getVar('total_belanja');
            if (is_null($totalBelanja)) {
                return $this->response->setJSON(['success' => false, 'message' => 'Total belanja is null']);
            }
    
            $data = [
                'id_anggota' => $this->request->getVar('id_anggota'),
                'metode_pembayaran' => $this->request->getVar('metode_pembayaran'),
                'tanggal' => date('Y-m-d H:i:s'),
                'id_users' => session()->get('id'), // assuming you store user id in session
                'total_belanja' => $totalBelanja,
                'struk' => 'STRUK_' . time() // Generate a simple struk value
            ];
    
            // Save the transaction
            $penjualanModel->insert($data);
            $penjualanId = $penjualanModel->insertID();
    
            // Save the transaction details
            $cartItems = $this->request->getVar('cart');
            foreach ($cartItems as $item) {
                // Fetch the stock entry for the current item
                $stockEntries = $stokModel->getstokbarang($item['id_barang']);
                
                foreach ($stockEntries as $stockEntry) {
                    if ($stockEntry['kuantitas'] >= $item['quantity']) {
                        // Update the stock quantity and sales count
                        $stokModel->update($stockEntry['id_stok'], [
                            'kuantitas' => $stockEntry['kuantitas'] - $item['quantity'],
                            'terjual' => $stockEntry['terjual'] + $item['quantity']
                        ]);
    
                        // Save the transaction detail with the correct stock ID
                        $detailData = [
                            'id_penjualan' => $penjualanId,
                            'id_barang' => $item['id_barang'],
                            'jumlah' => $item['quantity'],
                            'harga' => $item['total_price'] / $item['quantity'],
                            'tanggal' => date('Y-m-d H:i:s'),
                            'id_users' => session()->get('id'), // assuming you store user id in session
                            'id_stok' => $stockEntry['id_stok']
                        ];
                        $itemTerjualModel->insert($detailData);
                        break;
                    } else {
                        // Handle case where stock is insufficient
                        return $this->response->setJSON(['success' => false, 'message' => 'Insufficient stock for item ' . $item['id_barang']]);
                    }
                }
            }
    
            return $this->response->setJSON(['success' => true]);
        }
    
        return $this->response->setJSON(['success' => false]);
    }
    
    //controller produk/barang
    public function edit_produk($id_barang)
    {
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new BarangModel;
        $data['barang'] = $model->where('id_barang',$id_barang)->first();

        return view('waserda/edit_produk',$data);
    }

    //controller penjualan
    public function data_penjualan()
    { $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;
        echo view("waserda/data_penjualan",$data);
    }
}