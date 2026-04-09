<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Gunakan URL lengkap hosting
$base_url = "https://muhamad-fareski-peminjaman-alat.free.nf/";

//  Cek session admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: " . $base_url . "index.php");
    exit;
}

include_once __DIR__ . '/../models/m_pengembalian.php';

class c_pengembalian {
    private $model;
    private $base_url_internal;

    public function __construct(){
        $this->model = new m_pengembalian();
        $this->base_url_internal = "https://muhamad-fareski-peminjaman-alat.free.nf/";
    }

    public function index(){
        return $this->model->getAllWithNamaUser();
    }

    public function getById($id){
        return $this->model->getById($id);
    }

    public function update(){
        if(!isset($_POST['id_pengembalian'])){
            die("ID pengembalian tidak ditemukan!");
        }

        $id      = $_POST['id_pengembalian'];
        $tgl     = $_POST['tgl_dikembalikan'];
        $kondisi = $_POST['kondisi_kembali'];
        $denda   = $_POST['denda'];

        $this->model->update($id, $tgl, $kondisi, $denda);

        //  Redirect diperbaiki ke URL hosting
        header("Location: " . $this->base_url_internal . "views/admin/pengembalian/data_pengembalian.php");
        exit;
    }

    public function hapus($id){
        if(!is_numeric($id)){
            die("ID tidak valid!");
        }

        $this->model->delete($id);

        // Redirect diperbaiki ke URL hosting
        header("Location: " . $this->base_url_internal . "views/admin/pengembalian/data_pengembalian.php");
        exit;
    }
}

// Proses Update
if (isset($_POST['update'])) {
    $controller = new c_pengembalian();
    $controller->update();
}

// Proses Hapus
if (isset($_GET['hapus'])) {
    $controller = new c_pengembalian();
    $controller->hapus($_GET['hapus']);
}
?>