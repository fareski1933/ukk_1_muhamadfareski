<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Cek session admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    // Redirect ke halaman login (root proyek)
    header("Location: /ukk_1_muhamadfareski/views/index.php");
    exit;
}

include_once __DIR__ . '/../models/m_pengembalian.php';

class c_pengembalian {
    private $model;

    public function __construct(){
        $this->model = new m_pengembalian();
    }

    // Ambil semua data pengembalian + nama user
    public function index(){
        return $this->model->getAllWithNamaUser();
    }

    // Ambil data per ID
    public function getById($id){
        return $this->model->getById($id);
    }

    // Update data pengembalian
    public function update(){
        if(!isset($_POST['id_pengembalian'])){
            die("ID pengembalian tidak ditemukan!");
        }

        $id      = $_POST['id_pengembalian'];
        $tgl     = $_POST['tgl_dikembalikan'];
        $kondisi = $_POST['kondisi_kembali'];
        $denda   = $_POST['denda'];

        $this->model->update($id, $tgl, $kondisi, $denda);

        // Redirect ke halaman data pengembalian
        header("Location: /ukk_1_muhamadfareski/views/admin/pengembalian/data_pengembalian.php");
        exit;
    }

    // Hapus data pengembalian
    public function hapus($id){
        if(!is_numeric($id)){
            die("ID tidak valid!");
        }

        $this->model->delete($id);

        // Redirect ke halaman data pengembalian
        header("Location: /ukk_1_muhamadfareski/views/admin/pengembalian/data_pengembalian.php");
        exit;
    }
}

// 🔹 Proses Update
if (isset($_POST['update'])) {
    $controller = new c_pengembalian();
    $controller->update();
}

// 🔹 Proses Hapus
if (isset($_GET['hapus'])) {
    $controller = new c_pengembalian();
    $controller->hapus($_GET['hapus']);
}
?>