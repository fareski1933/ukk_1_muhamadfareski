<?php
include_once __DIR__ . '/../models/m_peminjaman.php';

class c_peminjaman {

    private $model;

    public function __construct(){
        $this->model = new m_peminjaman();
    }

    // ================= TAMPIL DATA =================
    public function index(){
        return $this->model->getAllPeminjaman();
    }

    // ================= DETAIL =================
    public function show($id){
        return $this->model->getPeminjamanById($id);
    }

    // ================= TAMBAH =================
    public function store($data){
        return $this->model->addPeminjaman($data);
    }

    // ================= UPDATE =================
    public function update($id,$data){
        return $this->model->updatePeminjaman($id,$data);
    }

    // ================= HAPUS =================
    public function delete($id){
        return $this->model->deletePeminjaman($id);
    }
}

// ================= ROUTING =================
$controller = new c_peminjaman();

// 🔥 FIX BAGIAN INI
if(isset($_GET['hapus'])){
    $controller->delete($_GET['hapus']);

    // WAJIB redirect balik
    header("Location: ../views/admin/peminjaman/data_peminjaman.php");
    exit;
}
?>