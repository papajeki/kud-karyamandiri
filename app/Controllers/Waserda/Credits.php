<?php

namespace App\Controllers\Waserda;
use App\Controllers\BaseController;
use App\Models\CreditsModel;
use App\Models\AnggotaModel;
use App\Models\PenjualanModel;

class Credits extends BaseController{
    public function __construct()
    {
        if (session()->get('role') !== "kasir" && session()->get('role') !== "admin") {
            echo 'Access denied';
            exit;
        }
    }
    public function credits(){
        $creditsModel = new CreditsModel();
        $creditstotal = $creditsModel->select('credits.status,anggota.id_anggota, anggota.surename, anggota.id_kelompok,kelompok_tani.*, SUM(penjualan.total_belanja) as total_credits')
                                    ->join('penjualan','credits.id_penjualan = penjualan.id_penjualan')
                                    ->join('anggota', 'anggota.id_anggota = credits.id_anggota')
                                    ->join('kelompok_tani','kelompok_tani.id_kelompoktani = anggota.id_kelompok')
                                    ->groupBy('credits.id_anggota')
                                    ->orderBy('id_kelompok')
                                    ->findAll();                                                                                                                                                                                    
        $data['credits'] =$creditstotal;
        return view('waserda/credits', $data);
    }
    public function detail($id_anggota)
    {
        $modelanggota = new AnggotaModel();
        $creditsModel = new CreditsModel();
    
        // Fetch the member data
        $data['anggota'] = $modelanggota->select('anggota.*, kelompok_tani.*')
                                        ->join('kelompok_tani', 'anggota.id_kelompok = kelompok_tani.id_kelompoktani')
                                        ->where('id_anggota', $id_anggota)->first();
    
        // Fetch the credits summary and details
        $data['creditsSummary'] = $creditsModel->select('SUM(penjualan.total_belanja) as hitung_akhir')
                                               ->join('penjualan', 'credits.id_penjualan = penjualan.id_penjualan')
                                               ->where('credits.id_anggota', $id_anggota)
                                               ->where('credits.status','belum lunas')
                                               ->groupBy('credits.id_anggota')
                                               ->first();
    
        // Fetch each individual row of credits for the specific member
        $data['creditsDetails'] = $creditsModel->select('credits.id_credits,credits.id_penjualan, credits.status,penjualan.tanggal, penjualan.total_belanja')
                                               ->join('penjualan', 'credits.id_penjualan = penjualan.id_penjualan')
                                               ->where('credits.id_anggota', $id_anggota)
                                               ->findAll();
    
        return view('waserda/credit_detail', $data);
    }
    
    public function pelunasan($id_anggota)
    {
        $creditsModel = new CreditsModel();
    
        // Update the status for all records with 'belum lunas' for the specific member
        $creditsModel->set('status', 'lunas')
                     ->where('id_anggota', $id_anggota)
                     ->where('status', 'belum lunas')  // Only update if status is 'belum lunas'
                     ->update();
        session()->setFlashdata('success', 'Pelunasan telah dilakukan');
        // Redirect back to the detail page after the update
        return redirect()->to('/waserda/credits/credits_detail/' .$id_anggota);
    }
      
}