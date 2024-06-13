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

    public function update_harga_barang($id_barang){
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new BarangModel;
        //ambil data inputan
        $harga_jual = $this->request->getPost('harga_jual');
        if($this->validate([ 'harga_jual' => 'required|numeric'])){
            //update harga
            $data = [
                'harga_jual' => $harga_jual
            ];
            if ($model->update($id_barang, $data)) {
                // Set success message and redirect
                $sess->setFlashdata('success', 'Harga jual updated successfully.');
            } else {
                // Set error message and redirect
                $sess->setFlashdata('error', 'Failed to update harga jual.');
            }
        } else {
            // Set validation errors
            $sess->setFlashdata('errors', $this->validator->getErrors());
        }
        return redirect("waserda/barang",$data);
    }

    //stok barang
    public function stok_barang($id_barang){
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

         $model = new BarangModel;
         $stok = new StokModel;
         $data['barang'] = $model->where('id_barang',$id_barang)->first();
        $stokData = $stok->getstokbarang($id_barang);
        $data['stokdata'] = $stokData;
        // $data['barang'] = $model->where('id_barang',$id_barang)->first();

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
    return redirect()->to('/waserda/stok_barang/' . $data['id_barang']);
    }
}