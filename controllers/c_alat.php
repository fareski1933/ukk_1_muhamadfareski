<?php
include_once __DIR__ . "/../models/m_alat.php";

class c_alat {

    public $model;

    public function __construct(){
        $this->model = new m_alat();
    }

    // Menampilkan semua data alat
    public function index(){
        return $this->model->getAll();
    }

    // Simpan alat baru
    public function store(){
        // Pastikan form disubmit
        if(isset($_POST['nama_alat']) && !empty($_POST['nama_alat'])){
            // Ambil data dari form
            $nama_alat = $_POST['nama_alat'];
            $id_kategori = $_POST['id_kategori'];
            $stok = $_POST['stok'];
            $kondisi = $_POST['kondisi'];
            $status = $_POST['status'];

            // Panggil model untuk insert
            // TIDAK PERLU id_alat karena AUTO_INCREMENT
            $this->model->insert($nama_alat, $id_kategori, $stok, $kondisi, $status);

            // Redirect ke halaman tampil data
            header("Location: tampil_data_alat.php");
            exit;
        }
    }

    // Update data alat
    public function update(){
        if(isset($_POST['id_alat']) && !empty($_POST['id_alat'])){
            $id_alat = $_POST['id_alat'];
            $nama_alat = $_POST['nama_alat'];
            $id_kategori = $_POST['id_kategori'];
            $stok = $_POST['stok'];
            $kondisi = $_POST['kondisi'];
            $status = $_POST['status'];

            $this->model->update($id_alat, $nama_alat, $id_kategori, $stok, $kondisi, $status);

            header("Location: tampil_data_alat.php");
            exit;
        }
    }

    // Hapus alat
    public function delete($id){
        return $this->model->delete($id);
    }

    // Ambil 1 data alat
    public function show($id){
        return $this->model->getById($id);
    }
}