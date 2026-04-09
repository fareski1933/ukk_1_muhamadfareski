<?php
include_once __DIR__ . "/../models/m_alat.php";

class c_alat {
    public $model;
    // Definisikan base_url di dalam class agar mudah dipanggil
    private $base_url = "https://muhamad-fareski-peminjaman-alat.free.nf/";

    public function __construct(){
        $this->model = new m_alat();
    }

    public function index(){
        return $this->model->getAll();
    }

    public function store(){
        if(isset($_POST['nama_alat']) && !empty($_POST['nama_alat'])){
            $nama_alat = $_POST['nama_alat'];
            $id_kategori = $_POST['id_kategori'];
            $stok = $_POST['stok'];
            $kondisi = $_POST['kondisi'];
            $status = $_POST['status'];

            $this->model->insert($nama_alat, $id_kategori, $stok, $kondisi, $status);

            header("Location: " . $this->base_url . "views/admin/alat/tampil_data_alat.php");
            exit;
        }
    }

    public function update(){
        if(isset($_POST['id_alat']) && !empty($_POST['id_alat'])){
            $id_alat = $_POST['id_alat'];
            $nama_alat = $_POST['nama_alat'];
            $id_kategori = $_POST['id_kategori'];
            $stok = $_POST['stok'];
            $kondisi = $_POST['kondisi'];
            $status = $_POST['status'];

            $this->model->update($id_alat, $nama_alat, $id_kategori, $stok, $kondisi, $status);

            header("Location: " . $this->base_url . "views/admin/alat/tampil_data_alat.php");
            exit;
        }
    }

    public function delete($id){
        $this->model->delete($id);
        header("Location: " . $this->base_url . "views/admin/alat/tampil_data_alat.php");
        exit;
    }

    public function show($id){
        return $this->model->getById($id);
    }
}