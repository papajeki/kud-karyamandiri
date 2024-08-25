<?php

namespace App\Controllers\Waserda;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\StokModel;

//require_once '../BaseController.php';

class Barang extends BaseController{
    public function __construct()
    {
        
        if (session()->get('role') !== "kasir" && session()->get('role') !=="admin") {
            echo 'Access denied';
            exit;
            
        }
    }

    //Barang-----------------------------------------------------------------------------
    public function produk()
    { $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;
        $model = new BarangModel;
        $data['result']=$model->findAll();

        $searchQuery = $this->request->getGet('q');

         // Get the current page number from the URL, default to 1
         $page = $this->request->getGet('page') ?? 1;
        
         // Set the number of items per page
         $perPage = 10;
 
         // Set the search and pagination configuration
         if ($searchQuery) {
             $data['result'] = $model->like('nama_barang', $searchQuery)
                                      ->orLike('barcode', $searchQuery)
                                      ->paginate($perPage, 'default', $page);
         } else {
             $data['result'] = $model->paginate($perPage, 'default', $page);
         }
 
         $data['pager'] = $model->pager;

        echo view("waserda/produk",$data);
    }
    public function create_barang()
    {
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        //simpan
        if ($this->request->getMethod() === 'post'){
        $model = new BarangModel;
        $data = [
            'barcode'=> $this->request->getPost('barcode'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_jual' => $this->request->getPost('harga_jual')
        ];
        $model->insert($data);
        session()->setFlashdata('success', 'Data Barang berhasil disimpan!');
        return redirect("waserda/barang",$data);
        }
    return view('waserda/create_barang',$data);
    }

    public function edit_produk($id_barang)
    {
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new BarangModel;
        $data['barang'] = $model->where('id_barang',$id_barang)->first();
        return view('waserda/edit_produk',$data);
    }

    //  Update barang sementara tidak dipakai
    public function update_barang($id_barang)
    {
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new BarangModel;
        
        $update = [
        'nama_barang' => $this->request->getPost('nama_barang'),
        'barcode' => $this->request->getPost('barcode')
         ];
    $model->update($id_barang,$update);
    return redirect("waserda/barang",$data);
    }

    //update barang gabung dengan update harga
    public function update_harga_barang($id_barang){
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new BarangModel;
        //ambil data inputan
        if($this->validate([ 'harga_jual' => 'required|numeric'])){
            //update harga
            $data = [
                'nama_barang' => $this->request->getPost('nama_barang'),
                'barcode' => $this->request->getPost('barcode'),
                'harga_jual' => $this->request->getPost('harga_jual')
            ];
            if ($model->update($id_barang, $data)) {
                // Set success message and redirect
                $sess->setFlashdata('success', 'Produk Berhasil diperbarui.');
            } else {
                // Set error message and redirect
                $sess->setFlashdata('error', 'Failed to update data barang.');
            }
        } else {
            // Set validation errors
            $sess->setFlashdata('errors', $this->validator->getErrors());
        }
        return redirect("waserda/barang",$data);
    }

    //stok barang----------------------------------------------------------------------
    public function stok_barang($id_barang){
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

         $model = new BarangModel;
         $stok = new StokModel;
         $data['barang'] = $model->where('id_barang',$id_barang)->first();
        $stokData = $stok->getstokbarang($id_barang);
        $data['stokdata'] = $stokData;
        //menampilkan jumlah stok
        $jumlah_barang = 0;
        foreach ($stokData as $stok) {
            $jumlah_barang += $stok['kuantitas'] - $stok['terjual'];
        }
        $data['jumlah_barang'] = $jumlah_barang;

        return view('waserda/stok_barang',$data);
    }

    public function restok(){
        $model = new StokModel;
        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'kuantitas' => $this->request->getPost('kuantitas'),
            'harga_beli' => $this->request->getPost('harga_beli')
        ];

    $model->insert($data);
    session()->setFlashdata('success', 'Stok Barang berhasil ditambah!');
    return redirect()->to('/waserda/stok_barang/' . $data['id_barang']);
    }

    public function edit_stok($id_stok)
    {
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new StokModel();
        $stokdata = $model->where('id_stok', $id_stok)->first();
        $data['stok'] = $stokdata;

        if ($stokdata) {
            $id_barang = $stokdata['id_barang'];
            $stokDetail = $model->getstokbarang($id_barang);
            if (!empty($stokDetail)) {
                $data['nama_barang'] = $stokDetail[0]['nama_barang']; // Assuming all records will have the same `nama_barang`
            } else {
                $data['nama_barang'] = 'N/A'; // Default value if no stok found
            }
        } else {
            $data['nama_barang'] = 'N/A';
        }
        return view('waserda/edit_stok',$data);
    }

    public function update_stok($id_stok)
    {
        //get nama asli user
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new StokModel();
        $update = [
            'kuantitas' => $this->request->getPost('kuantitas'),
            'harga_beli' => $this->request->getPost('harga_beli')
        ];
        $model->update($id_stok,$update);
        session()->setFlashdata('success', 'Stok Barang berhasil di update!');
        return redirect("waserda/barang");
    }
}