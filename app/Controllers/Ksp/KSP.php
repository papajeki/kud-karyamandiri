<?php

namespace App\Controllers\Ksp;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KelompokTaniModel;

class KSP extends BaseController
{ 
    public function __construct()
    {
        if (session()->get('role') !== "ksp" && session()->get('role') !== "admin") {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {
        echo view('ksp/dashboard');
    }

    public function anggota() {
        $anggotamodel = new AnggotaModel();
        $kelompoktani = new KelompokTaniModel();
        $data ['kelompok'] = $kelompoktani->findAll();
    
        // Set the number of items per page
        $perPage = 10;
    
        // Get the current page number from the URL, default to 1
        $page = $this->request->getGet('page') ?? 1;
    
        // Get search query from URL
        $searchQuery = $this->request->getGet('q');
    
        // Initialize query builder
        $anggota = $anggotamodel;
    
        // Apply search filter if search query is present
        if ($searchQuery) {
            $anggota->like('surename', $searchQuery)
                    ->orLike('kelompok_tani', $searchQuery);
        }
    
        // Sort the results by 'kelompok_tani'
        $anggota->orderBy('kelompok_tani', 'ASC');
    
        // Fetch the paginated results
        $data['result'] = $anggota->paginate($perPage, 'default', $page);
    
        // Include the pager in the data array
        $data['pager'] = $anggotamodel->pager;
    
        return view('ksp/anggota', $data);
    }
    
 //umum sementara tidak dipakai
    public function umum(){
        $anggotamodel = new AnggotaModel;
    
        // Set the number of items per page
        $perPage = 10;
    
        // Get the current page number from the URL, default to 1
        $page = $this->request->getGet('page') ?? 1;
    
        // Get search query from URL
        $searchQuery = $this->request->getGet('q');
    
        // Initialize query builder
        $anggota = $anggotamodel->where('kelompok_tani', 'umum');
    
        // Apply search filter if search query is present
        if($searchQuery){
            $anggota->like('surename', $searchQuery)
                    ->orLike('kelompok_tani', $searchQuery);
        }
    
        // Fetch the paginated results
        $data['result'] = $anggota->paginate($perPage, 'default', $page);
    
        // Include the pager in the data array
        $data['pager'] = $anggotamodel->pager;
    
        return view('ksp/anggotaumum', $data);
    }

    public function tambahanggota()
    {
        $kelompoktani = new KelompokTaniModel();
        $data ['kelompok'] = $kelompoktani->findAll();
        if ($this->request->getMethod() === 'post') {
            $anggotamodel = new AnggotaModel;
            
            $data = [
                'nik' => $this->request->getPost('nik'),
                'surename' => $this->request->getPost('surename'),
                'username' => $this->request->getPost('username'),
                'kelompok_tani' => $this->request->getPost('kelompok_tani'),
                'handphone' => $this->request->getPost('handphone')
            ];
            
            $anggotamodel->insert($data);
            return redirect()->to(base_url("ksp/anggota"));
        }
    
        return view('ksp/tambahanggota',$data);
    }

    public function edit_anggota($id_anggota){
        $anggotamodel = new AnggotaModel;
        $sess = session();
        $data = [
            'surename' => $this->request->getPost('surename'),
            'nik' => $this->request->getPost('nik'),
            'kelompok_tani' => $this->request->getPost('kelompok_tani'),
            'handphone' => $this->request->getPost('handphone')
        ];
        if ($anggotamodel->update($id_anggota, $data)) {
            // Set success message and redirect
            $sess->setFlashdata('success', 'Harga jual updated successfully.');
        } else {
            // Set error message and redirect
            $sess->setFlashdata('error', 'Failed to update harga jual.');
        }
        return redirect('ksp/anggota');
    }
    
}
