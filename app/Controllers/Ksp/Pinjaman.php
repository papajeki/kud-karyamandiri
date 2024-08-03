<?php

namespace App\Controllers\Ksp;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\DurasiTempoModel;
use App\Models\NominalPinjamanModel;
use App\Models\PinjamanModel;
use App\Models\PembayaranModel;
use App\Models\UserModel;
use DateTime;
class Pinjaman extends BaseController{
    public function __construct()
    {
        if (session()->get('role') !== "ksp" && session()->get('role') !== "admin") {
            echo 'Access denied';
            exit;
        }
    }

    public function daftar_peminjam()
    {
        $anggotamodel = new AnggotaModel();
        $pinjamanmodel = new PinjamanModel();
        $pembayaranmodel = new PembayaranModel(); // Tambahkan model pembayaran
    
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;
        $searchQuery = $this->request->getGet('q');
    
        // Membuat query builder untuk mengambil data pinjaman dan anggota
        $builder = $pinjamanmodel->select('pinjaman.id_pinjaman, pinjaman.nominal_pinjaman, pinjaman.angsuran, pinjaman.bunga, pinjaman.status, pinjaman.tanggal_pinjaman, pinjaman.tagihan, anggota.surename, anggota.handphone')
                                 ->join('anggota', 'anggota.id_anggota = pinjaman.id_anggota');
    
        if ($searchQuery) {
            $builder->like('anggota.surename', $searchQuery)
                    ->orLike('pinjaman.status', $searchQuery);
        }
    
        $results = $builder->paginate($perPage, 'default', $page);
        $pager = $builder->pager;
    
        $currentDate = new DateTime();
    
        // Melakukan kalkulasi tagihan untuk setiap hasil
        foreach ($results as &$result) {
  
    
            // Periksa status pinjaman dan tanggal pembayaran
            $idPinjaman = $result['id_pinjaman'];
            $pembayaranBulanIni = $pembayaranmodel->where('id_pinjaman', $idPinjaman)
                                                  ->where('MONTH(tanggal_bayar)', $currentDate->format('m'))
                                                  ->where('YEAR(tanggal_bayar)', $currentDate->format('Y'))
                                                  ->first();
    
            if ($result['status'] !== 'lunas' && $currentDate->format('d') >= 20 && !$pembayaranBulanIni) {
                $result['notification'] = true;
            } else {
                $result['notification'] = false;
            }
        }
    
        $data['result'] = $results;
        $data['pager'] = $pager;
    
        return view('ksp/pinjaman', $data);
    }
    
    public function pinjaman_detail($id_pinjaman) {
        $anggotamodel = new AnggotaModel;
        $pinjamanmodel = new PinjamanModel;
        $pembayaran = new PembayaranModel;
    
        // Ambil data pinjaman
        $data['pinjaman'] = $pinjamanmodel->select('pinjaman.id_pinjaman, pinjaman.nominal_pinjaman, pinjaman.tanggal_pinjaman, pinjaman.angsuran, pinjaman.bunga, pinjaman.status, 
                                                    pinjaman.bukti_disetujui, anggota.surename, anggota.handphone, anggota.kelompok_tani, anggota.nik')
                                          ->join('anggota', 'pinjaman.id_anggota = anggota.id_anggota')  // Corrected join condition
                                          ->where('pinjaman.id_pinjaman', $id_pinjaman)
                                          ->first();  // Retrieve a single row
    
        // Check if pinjaman data is found
        if ($data['pinjaman']) {
            // Ambil data pembayaran jika data pinjaman ditemukan
            $data['pembayaran'] = $pembayaran->where('id_pinjaman', $data['pinjaman']['id_pinjaman'])->findAll();
        } else {
            // Handle the case where no pinjaman is found
            $data['pinjaman'] = [];
            $data['pembayaran'] = [];
            // Optionally, set a flash message or error
            session()->setFlashdata('error', 'Pinjaman not found');
        }
    
        return view('ksp/pinjaman_detail', $data);
    }

    public function pembayaran($id_pinjaman){
        $session = session();
        $anggotamodel = new AnggotaModel;
        $pinjamanmodel = new PinjamanModel;
        $pembayaran = new PembayaranModel;
        $model = new UserModel;

        $buku = $pinjamanmodel->where('id_pinjaman', $id_pinjaman)->first();
        $person =  $anggotamodel->where('id_anggota', $buku['id_anggota'])->first();
            if($this->request->getMethod() === 'post'){
            $password = $this->request->getVar('password');
        $username = session('username');
        $builder = $model->where('username', $username)->first();
            if($builder){
                $pass = $builder['password'];
                $verif = password_verify($password, $pass);
            if($verif){
                $data = [
                    "id_pinjaman" => $buku['id_pinjaman'],
                    "id_anggota" => $buku['id_anggota'],
                    "nominal_pembayaran" => $this->request->getPost('nominal_pembayaran'),
                    "tanggal_bayar" => date('Y-m-d H:i:s'),
                    "deskripsi" => $this->request->getPost('deskripsi')
                ];
                $pembayaran->insert($data);
                $hitungbayar = $pembayaran->where('id_pinjaman', $id_pinjaman)
                                            ->selectSum('nominal_pembayaran')
                                            ->first()['nominal_pembayaran'];

                $bayarbunga = ($buku['nominal_pinjaman']*$buku['bunga']/100)*3;
                if ($hitungbayar >= $buku['nominal_pinjaman'] + $bayarbunga) {
                    // Update the loan status to 'lunas'
                    $pinjamanmodel->update($id_pinjaman, ['status' => 'lunas']);
                }
                return redirect()->to("ksp/pinjaman_detail/" .$id_pinjaman);
                }else{
                    $session->setFlashdata('msg',"Password Salah");
                    return redirect()->to('ksp/pembayaran/'.$id_pinjaman);
                }
            }
        
        }
        $data['pinjaman'] = $buku;
        $data['anggota'] = $person;
        return view('ksp/pembayaran',$data);
    }

    public function tambah_pinjaman() {
        $anggotamodel = new AnggotaModel;
        $pinjamanmodel = new PinjamanModel;
        $nominalpinjaman = new NominalPinjamanModel;
        $durasitempo = new DurasiTempoModel();
    
        $data['anggota'] = $anggotamodel->findAll();
        $data['nilai_pinjam'] = $nominalpinjaman->findAll();
        $data['tempo'] = $durasitempo->findAll();
    
        if ($this->request->getMethod() === 'post') {
            $idAnggota = $this->request->getPost('id_anggota');
    
            // Cek apakah anggota memiliki pinjaman yang belum lunas atau macet
            $existingLoan = $pinjamanmodel->where('id_anggota', $idAnggota)
                                          ->whereIn('status', ['belum lunas', 'macet'])
                                          ->first();
            
            if ($existingLoan) {
                // Anggota memiliki pinjaman yang belum lunas atau macet
                session()->setFlashdata('error', 'Anggota memiliki pinjaman yang belum lunas atau macet. Tidak dapat menambahkan pinjaman baru.');
                return redirect()->to('/ksp/tambah_pinjaman')->withInput();
            }
    
            $file = $this->request->getFile('bukti_disetujui');
            if ($file->isValid() && !$file->hasMoved()) {
                // Menyimpan file ke direktori writable/uploads/berkas/
                $filePath = $file->store('berkas');
                $fileName = $file->getName(); // Mendapatkan nama file saja
            }
    
            $nilaipinjaman = $this->request->getPost('nominal_pinjaman');
            $nilaiangsuran = $this->request->getPost('angsuran');
            $nilaibunga = $this->request->getPost('bunga');
            $tagihan = ($nilaipinjaman * $nilaibunga / 100) + ($nilaipinjaman / $nilaiangsuran);
    
            $data = [
                'id_anggota' => $this->request->getPost('id_anggota'),
                'nominal_pinjaman' => $this->request->getPost('nominal_pinjaman'),
                'tanggal_pinjaman' => date('Y-m-d'),
                'angsuran' => $this->request->getPost('angsuran'),
                'bunga' => $this->request->getPost('bunga'),
                'tagihan' => $tagihan,
                'status' => 'belum lunas',
                'bukti_disetujui' => $fileName
            ];
    
            $pinjamanmodel->insert($data);
            return redirect()->to('/ksp/pinjaman');
        }
    
        return view('ksp/tambahpinjaman', $data);
    }
    
}