<?php
namespace App\Controllers\Kelompok;
use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\CreditsModel;
use App\Models\GajiAnggotaModel;
use App\Models\KelompokTaniModel;
use App\Models\PanenModel;
use App\Models\PotonganModel;

class Ketua extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') !== "petani" && session()->get('role') !== "admin") {
            echo 'Access denied';
            exit;
        }
    }

    public function dashboard(){
        echo view('kelompok/dashboard');
    }
    public function panen(){        
        $sess = session();
        $pengurus = $sess->get('id_kelompok');
        $modelanggota = new AnggotaModel;
        $kelompokmodel  = new KelompokTaniModel;
        $data['pengurus'] = $pengurus;
        $data['anggota'] = $modelanggota->where('id_kelompok',$pengurus)->findAll();
        //cek apakah ada request input
        if($this->request->getMethod() === 'post'){
            $modelpanen = new PanenModel();
            $data = [
                'id_anggota' => $this->request->getPost('anggota'),
                'tanggal_panen' => $this->request->getPost('tanggal_timbang'),
                'berat_panen' => $this->request->getPost('hasil'),
                'harga_tbs' => $this->request->getPost('harga'),
                'id_kelompok' => $pengurus
            ];
            $modelpanen->insert($data);
            session()->setFlashdata('success', 'Data Panen berhasil disimpan!');
            $id_anggota = $this->request->getPost('anggota');
            return redirect()->to("/kelompok/detail_anggota/".$id_anggota);
        }
        return view('kelompok/inputpanen',$data);
    }

    public function anggota(){
        $sess = session();
        $pengurus = $sess->get('id_kelompok');
        $modelanggota = new AnggotaModel;
        $data['pengurus'] = $pengurus;
        $data['anggota'] = $modelanggota->where('id_kelompok',$pengurus)->findAll();
        return view('kelompok/anggota',$data);
    }

    public function detail_anggota($id_anggota){
        $anggotamodel = new AnggotaModel;
        $panenmodel = new PanenModel;
        $kelompokmodel = new KelompokTaniModel();
        $data['anggota'] = $anggotamodel->select('anggota.*, kelompok_tani.*')
                    ->join('kelompok_tani', 'kelompok_tani.id_kelompoktani = anggota.id_kelompok')
                    ->where('anggota.id_anggota', $id_anggota)
                    ->first();

        
            $data['currentMonth'] = date('F');
            $data['previousMonth'] = date('F', strtotime('-1 month'));
            $currentmonth = date('m');
            $year = date('Y');
            $previousMonth = date('m', strtotime('-1 month'));
            $prevyear = date('Y',strtotime('-1 month'));
        $data['panen'] = $panenmodel->select('panen.*')
                                    ->where('id_anggota',$id_anggota)
                                    ->where('MONTH(tanggal_panen)',$currentmonth)
                                    ->where('YEAR(tanggal_panen)', $year)
                                    ->findAll();
        $data['panen_lalu'] = $panenmodel->select('panen.*')
                                    ->where('id_anggota',$id_anggota)
                                    ->where('MONTH(tanggal_panen)',$previousMonth)
                                    ->where('YEAR(tanggal_panen)', $prevyear)
                                    ->findAll();
                                    
        return view('kelompok/detail_anggota',$data);
    }
    public function gaji($id_anggota) {
        $anggotamodel = new AnggotaModel();
        $panenmodel = new PanenModel();
        $creditsmodel = new CreditsModel();
        $potonganmodel = new PotonganModel();
        $gajimodel = new GajiAnggotaModel();
        $sess = session();
        $kelompok = $sess->get('id_kelompok');
    
        $previousMonth = date('m', strtotime('-1 month'));
        $prevyear = date('Y', strtotime('-1 month'));
    
        // Mendapatkan informasi anggota
        $data['anggota'] = $anggotamodel->find($id_anggota);
    
        // Mendapatkan hasil panen bulan lalu
        $data['panen_lalu'] = $panenmodel->select('panen.*, (panen.berat_panen * panen.harga_tbs) as hasil_panen')
                                        ->where('id_anggota', $id_anggota)
                                        ->where('MONTH(tanggal_panen)', $previousMonth)
                                        ->where('YEAR(tanggal_panen)', $prevyear)
                                        ->groupBy('panen.id_panen')
                                        ->orderBy('panen.tanggal_panen', 'ASC')
                                        ->findAll();
    
        // Menghitung total hasil panen
        $totalHasilPanen = 0;
        foreach ($data['panen_lalu'] as $panen) {
            $totalHasilPanen += $panen['hasil_panen'];
        }
        $data['totalHasilPanen'] = $totalHasilPanen;
    
        // Mendapatkan summary credits (hutang) anggota
        $data['creditsSummary'] = $creditsmodel->select('SUM(penjualan.total_belanja) as hitung_akhir')
                                            ->join('penjualan', 'credits.id_penjualan = penjualan.id_penjualan')
                                            ->where('credits.id_anggota', $id_anggota)
                                            ->where('credits.status', 'belum lunas')
                                            ->groupBy('credits.id_anggota')
                                            ->first();
    
        // Mendapatkan potongan kelompok
        $data['potongan'] = $potonganmodel->where('id_kelompok', $kelompok)->findAll();
    
        // Menghitung total nominal potongan
        $totalNominal = $data['creditsSummary']['hitung_akhir'] ?? 0;
        foreach($data['potongan'] as $pot) {
            $totalNominal += $pot['nominal'];
        }
        $data['total_nominal'] = $totalNominal;
    
        // Jika form di-submit
        if ($this->request->getMethod() === 'post') {
            $gajiBersih = $totalHasilPanen - $totalNominal;
    
            // Simpan ke database
            $gajimodel->insert([
                'id_anggota' => $id_anggota,
                'total_hasil_panen' => $totalHasilPanen,
                'total_potongan' => $totalNominal,
                'total_credits' => $data['creditsSummary']['hitung_akhir'] ?? 0,
                'total_gaji_bersih' => $gajiBersih,
                'tanggal_penyaluran' => date('Y-m-d')
            ]);
    
            return redirect()->to('/kelompok/riwayat_gaji/'.$id_anggota)->with('success', 'Gaji berhasil disimpan.');
        }
    
        return view('kelompok/gaji', $data);
    }
    
    public function potongan(){
        $potonganmodel = new PotonganModel();
        $sess = session();
        $pengurus = $sess->get('id_kelompok');

        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;

        $data['potongan'] = $potonganmodel->where('id_kelompok', $pengurus)->paginate($perPage, 'default', $page);
        $pager =$potonganmodel->pager;
        $data['pager'] = $pager;
    return view('kelompok/potongan', $data);
    }
    
    public function tambah_potongan(){
        $potonganmodel = new PotonganModel();
        $sess = session();
        $pengurus = $sess->get('id_kelompok');
        $data = [
            'deskripsi' => $this->request->getPost('deskripsi'),
            'nominal' => $this->request->getPost('nominal'),
            'id_kelompok' => $pengurus
        ];
        $potonganmodel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('kelompok/potongan'));
    }

    public function edit_potongan(){
        $potonganmodel = new PotonganModel();
        $id = $this->request->getPost('id');
        $data =[
            'deskripsi' => $this->request->getPost('deskripsi'),
            'nominal' => $this->request->getPost('nominal')
        ];
        $potonganmodel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil diperbaharui');
        return redirect()->to(base_url('kelompok/potongan'));
    }

    public function hapus_potongan($id){
        $potonganmodel = new PotonganModel();
        $potonganmodel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('kelompok/potongan'));
    }
    public function riwayat_gaji($id_anggota) {
        $anggotamodel = new AnggotaModel();
        $gajimodel = new GajiAnggotaModel();
        $kelompokmodel = new KelompokTaniModel();
        $sess = session();
        $pengurus = $sess->get('id_kelompok');
    
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;
    
        // Ambil data anggota
        $data['anggota'] = $anggotamodel->where('id_anggota', $id_anggota)->first();
    
        // Ambil data kelompok tani
        $data['kelompok'] = $kelompokmodel->where('id_kelompoktani', $data['anggota']['id_kelompok'])->first();
    
        // Ambil data gaji
        $data['gaji'] = $gajimodel->where('id_anggota', $id_anggota)->paginate($perPage, 'default', $page);
    
        // Siapkan pagination
        $data['pager'] = $gajimodel->pager;
    
        return view('kelompok/riwayat_gaji', $data);
    }
    
}