<?php

namespace App\Controllers\Ksp;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\TabunganModel;
use App\Models\RiwayatTabunganModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Message;

class Simpan extends BaseController
{ 
    public function __construct()
    {
        if (session()->get('role') !== "ksp" && session()->get('role') !== "admin") {
            echo 'Access denied';
            exit;
        }
    }

    public function simpanan_kapling(){
        $anggotamodel = new AnggotaModel;
        $tabunganmodel = new TabunganModel;
    
        // Set the number of items per page
        $perPage = 10;
    
        // Get the current page number from the URL, default to 1
        $page = $this->request->getGet('page') ?? 1;        
        $searchQuery = $this->request->getGet('q');
         // Join Anggota dan Tabungan tabel
         $builder = $anggotamodel->select('anggota.surename, anggota.handphone,tabungan.id_tabungan, tabungan.saldo, tabungan.status')
         ->join('tabungan', 'tabungan.id_anggota = anggota.id_anggota')
         ->where('tabungan.jenis_tabungan', 'tabungan kapling');        
        if($searchQuery){
             $builder->like('anggota.surename', $searchQuery)
                    ->orLike('anggota.kelompok_tani', $searchQuery);
        }
        $data['result'] = $builder->paginate($perPage, 'default', $page);
        $data['pager'] = $builder->pager;    

        return view('ksp/tabungan_kapling', $data);
    }

    public function simpanan_umum(){
        $anggotamodel = new AnggotaModel;
        $tabunganmodel = new TabunganModel;
    
        // Set the number of items per page
        $perPage = 10;
    
        // Get the current page number from the URL, default to 1
        $page = $this->request->getGet('page') ?? 1;        
        $searchQuery = $this->request->getGet('q');
         // Join Anggota dan Tabungan tabel
         $builder = $anggotamodel->select('anggota.surename, anggota.handphone, tabungan.id_tabungan, tabungan.saldo, tabungan.status')
         ->join('tabungan', 'tabungan.id_anggota = anggota.id_anggota')
         ->where('tabungan.jenis_tabungan', 'tabungan umum');        
        if($searchQuery){
             $builder->like('anggota.surename', $searchQuery)
                    ->orLike('anggota.handphone', $searchQuery);
        }
        $data['result'] = $builder->paginate($perPage, 'default', $page);
        $data['pager'] = $builder->pager;    

        return view('ksp/tabungan_umum', $data);
    }

    public function tabungan_detail($id_tabungan){
        $anggotamodel = new AnggotaModel;
        $tabunganmodel = new TabunganModel;
        $riwayattabungan = new RiwayatTabunganModel;
    
        $data['simpanan'] = $tabunganmodel->select('tabungan.id_tabungan, tabungan.saldo, tabungan.id_anggota, tabungan.status, tabungan.jenis_tabungan, anggota.surename, anggota.handphone')
                                          ->join('anggota', 'anggota.id_anggota = tabungan.id_anggota')
                                          ->where('tabungan.id_tabungan', $id_tabungan)
                                          ->first();  // Retrieve a single row
        $data['riwayat'] = $riwayattabungan->where('id_tabungan', $data['simpanan']['id_tabungan'])->findAll();
    
        return view('ksp/tabungan_detail', $data);
    }
    
    public function simpan_transaksi($id_tabungan){
        $session= session();
        $model = new UserModel;
        $riwayattabungan = new RiwayatTabunganModel;
        $tabunganmodel = new TabunganModel;
        $anggotamodel = new AnggotaModel;

        $buku= $tabunganmodel->where('id_anggota',$id_tabungan)->first();
        $person = $anggotamodel->where('id_anggota',$buku['id_tabungan'])->first();
       
        if($this->request->getMethod() === 'post'){
        //persiapan verif password    
        $password = $this->request->getVar('password');
        $username = session('username');
        $builder = $model->where('username', $username)->first();
            if($builder){
                $pass = $builder['password'];
                $verif = password_verify($password, $pass);
            if($verif){
        //
        $data = [
            'id_tabungan' => $buku['id_tabungan'],
            'id_anggota' => $buku['id_anggota'],
            'jenis_transaksi' => 'deposit',
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal' => date('Y-m-d H:i:s'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ]; 
        $riwayattabungan->insert($data);
        $buku['saldo'] += $data['jumlah'];
        $tabunganmodel->update($id_tabungan,$buku);
        return redirect()->to("/ksp/tabungan_detail/" . $data['id_tabungan']);
                }else{
                    $session->setFlashdata('msg',"Password Salah");
                    return redirect()->to('ksp/simpan_transaksi/'.$id_tabungan);
                }
            }
        //
        }
        $data['person']=$person;
        $data['buku']=$buku;
        return view('ksp/menabung',$data);
    }

    public function tarik_transaksi($id_tabungan){
        $session= session();
        $model = new UserModel;
        $riwayattabungan = new RiwayatTabunganModel;
        $tabunganmodel = new TabunganModel;
        $anggotamodel = new AnggotaModel;

        $buku= $tabunganmodel->where('id_anggota',$id_tabungan)->first();
        $person = $anggotamodel->where('id_anggota',$buku['id_anggota'])->first();

        if($this->request->getMethod() === 'post'){
        //persiapan verif password    
        $password = $this->request->getVar('password');
        $username = session('username');
        $builder = $model->where('username', $username)->first();
            if($builder){
                $pass = $builder['password'];
                $verif = password_verify($password, $pass);
            if($verif){
        //
        $data = [
            'id_tabungan' => $buku['id_tabungan'],
            'id_anggota' => $buku['id_anggota'],
            'jenis_transaksi' => 'penarikan',
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal' => date('Y-m-d H:i:s'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ]; 
        $riwayattabungan->insert($data);
        $buku['saldo'] -= $data['jumlah'];
        $tabunganmodel->update($id_tabungan,$buku);
        return redirect()->to("/ksp/tabungan_detail/" . $data['id_tabungan']);
                }else{
                    $session->setFlashdata('msg',"Password Salah");
                    return redirect()->to('ksp/tarik_transaksi/'.$id_tabungan);
                }
            }
        //
        }
        $data['person']=$person;
        $data['buku']=$buku;
        return view('ksp/menarik',$data);
    }

    public function tambah_tabungan(){
        $anggotamodel = new AnggotaModel;
        $tabunganmodel = new TabunganModel;
        $riwayattabunganmodel = new RiwayatTabunganModel;

        $data['anggota'] = $anggotamodel->findAll();

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();

            $validation->setRules([
                'id_anggota' => 'required',
                'saldo' => 'required|numeric',
                'jenis_tabungan' => 'required'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                $data['validation'] = $validation;
                return view('ksp/tambah_tabungan', $data);
            }

            $newData = [
                'id_anggota' => $this->request->getPost('id_anggota'),
                'saldo' => $this->request->getPost('saldo'),
                'jenis_tabungan' => $this->request->getPost('jenis_tabungan'),
                'status' => 'aktif'
            ];

            $tabunganmodel->save($newData);

            // Ambil ID tabungan yang baru saja disimpan
            $id_tabungan = $tabunganmodel->getInsertID();

            // Simpan riwayat tabungan
            $riwayatData = [
                'id_anggota' => $this->request->getPost('id_anggota'),
                'id_tabungan' => $id_tabungan,
                'jenis_transaksi' => 'deposit',
                'jumlah' => $this->request->getPost('saldo'),
                'tanggal' => date('Y-m-d H:i:s'),
                'deskripsi' => 'Initial deposit'
            ];

            $riwayattabunganmodel->save($riwayatData);

            return redirect()->to('/ksp/tabungan_kapling');
        }

        return view('ksp/tambahtabungan', $data);
    }
    }
