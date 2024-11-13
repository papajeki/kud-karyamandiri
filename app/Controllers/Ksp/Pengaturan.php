<?php
namespace App\Controllers\Ksp;

Use App\Controllers\BaseController;
use App\Models\DurasiTempoModel;
use App\Models\KelompokTaniModel;
use App\Models\NominalPinjamanModel;
use App\Models\UserModel;
use Config\Pager;

Class Pengaturan extends BaseController{
    public function __construct()
    {
        if (session()->get('role') !== "ksp" && session()->get('role') !== "admin") {
            echo 'Access denied';
            exit;
        }
    }
    public function nominal(){
        $nominalmodel = new NominalPinjamanModel;

        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;
        $data['nominal'] = $nominalmodel->orderBy('nilai_pinjaman', 'ASC')->paginate($perPage, 'default', $page);
        $pager =$nominalmodel->pager;
        $data['pager'] = $pager;

        return view('ksp/nominal',$data);
    }
    public function tambah_nominal(){
        $nominalmodel = new NominalPinjamanModel();
        $data = [
            'nilai_pinjaman' => $this->request->getPost('nilai_pinjaman')
        ];
        $nominalmodel->insert($data);
        return redirect()->to(base_url('ksp/pengaturan-nominal'));
    }

    public function edit_nominal(){
        $nominalmodel = new NominalPinjamanModel();
        $id = $this->request->getPost('id');
        $data = [
            'nilai_pinjaman' => $this->request->getPost('nilai_pinjaman')
        ];
        $nominalmodel->update($id, $data);
        return redirect()->to(base_url('ksp/pengaturan-nominal'));
    }

    public function hapus_nominal($id){
        $nominalmodel = new NominalPinjamanModel();
        $nominalmodel->delete($id);
        return redirect()->to(base_url('ksp/pengaturan-nominal'));
    }

    public function tempo(){
        $tempomodel = new DurasiTempoModel();

        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;
        $data['tempo'] = $tempomodel->orderBy('tempo', 'ASC')->paginate($perPage, 'default', $page);
        $pager = $tempomodel->pager;
        $data['pager'] = $pager;
        return view('ksp/tempo', $data);
    }
    public function tambah_tempo(){
        $nominalmodel = new DurasiTempoModel();
        $data = [
            'tempo' => $this->request->getPost('tempo')
        ];
        $nominalmodel->insert($data);
        return redirect()->to(base_url('ksp/pengaturan-tempo'));
    }
    public function edit_tempo(){
        $nominalmodel = new DurasiTempoModel();
        $id = $this->request->getPost('id');
        $data = [
            'tempo' => $this->request->getPost('tempo')
        ];
        $nominalmodel->update($id, $data);
        return redirect()->to(base_url('ksp/pengaturan-tempo'));
    }
    public function hapus_tempo($id){
        $nominalmodel = new DurasiTempoModel;
        $nominalmodel->delete($id);
        return redirect()->to(base_url('ksp/pengaturan-tempo'));
    }

    public function kelompok(){
        $kelompokmodel = new KelompokTaniModel();
        $usersmodel = new UserModel();
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;
    
        $data['kelompok'] = $kelompokmodel->select('kelompok_tani.id_kelompoktani, kelompok_tani.kelompok_tani, kelompok_tani.id_ketua, users.id, users.surename')
                                           ->join('users', 'users.id = kelompok_tani.id_ketua','left')
                                           ->paginate($perPage, 'default', $page);
    
        $data['users'] = $usersmodel->where('roles', 'petani')->findAll(); // Retrieve all 'petani' users
        $data['pager'] = $kelompokmodel->pager;
        return view('ksp/kelompok', $data);
    }
    
    public function tambah_kelompok()
    {
        $kelompokmodel = new KelompokTaniModel();
        $id_ketua = $this->request->getPost('id_ketua');
        $kelompok_tani = $this->request->getPost('kelompok_tani');
    
        // Check if the selected ketua (leader) is already assigned to a group
        $existingKelompok = $kelompokmodel->where('id_ketua', $id_ketua)->first();
    
        if ($existingKelompok) {
            return redirect()->back()->with('error', 'User is already assigned as a leader in another group.');
        }
    
        // If not assigned, proceed to insert the new group
        $data = [
            'id_ketua' => $id_ketua,
            'kelompok_tani' => $kelompok_tani
        ];
        $kelompokmodel->insert($data);
    
        return redirect()->to(base_url('ksp/pengaturan-kelompok'))->with('success', 'Group successfully added.');
    }
    
    public function edit_kelompok()
    {
        $kelompokmodel = new KelompokTaniModel();
        $id = $this->request->getPost('id');
        $id_ketua = $this->request->getPost('id_ketua');
        $kelompok_tani = $this->request->getPost('kelompok_tani');
    
        // Check if the selected ketua (leader) is already assigned to a different group
        $existingKelompok = $kelompokmodel->where('id_ketua', $id_ketua)->where('id_kelompoktani !=', $id)->first();
    
        if ($existingKelompok) {
            return redirect()->back()->with('error', 'User is already assigned as a leader in another group.');
        }
    
        // Proceed to update the group if no conflicts
        $data = [
            'id_ketua' => $id_ketua,
            'kelompok_tani' => $kelompok_tani
        ];
    
        $kelompokmodel->update($id, $data);
    
        return redirect()->to(base_url('ksp/pengaturan-kelompok'))->with('success', 'Group updated successfully.');
    } 
    public function hapus_kelompok($id)
{
    $kelompokmodel = new KelompokTaniModel();
    
    // Cek apakah data kelompok dengan ID ini ada
    $kelompok = $kelompokmodel->find($id);
    if (!$kelompok) {
        return redirect()->to(base_url('ksp/pengaturan-kelompok'))->with('error', 'Group not found.');
    }

    // Hapus kelompok dari database
    $kelompokmodel->delete($id);
    
    return redirect()->to(base_url('ksp/pengaturan-kelompok'))->with('success', 'Group successfully deleted.');
}
}