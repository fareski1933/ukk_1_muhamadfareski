<?php
include_once __DIR__ . "/../models/m_kategori.php";

class c_kategori {

    public $model;

    public function __construct(){
        $this->model = new m_kategori();
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }


    // TAMPIL DATA
    public function index(){
        return $this->model->getAll();
    }


    // SIMPAN DATA
    public function store(){
        if(isset($_POST['nama_kategori']) && !empty(trim($_POST['nama_kategori']))){
            $nama = trim($_POST['nama_kategori']);
            $insert = $this->model->insert($nama);

            if($insert){
                $_SESSION['success'] = "Kategori berhasil ditambahkan!";
            } else {
                $_SESSION['error'] = "Gagal menambahkan kategori!";
            }

            header("Location: tampil_data_kategori.php");
            exit;
        } else {
            $_SESSION['error'] = "Nama kategori wajib diisi!";
            header("Location: tambah_kategori.php");
            exit;
        }
    }

    // TAMPIL EDIT
    public function show($id){
        if(!is_numeric($id)) return false;
        return $this->model->getById($id);
    }

    // UPDATE
    public function update(){
        if(isset($_POST['id_kategori']) && isset($_POST['nama_kategori'])){
            $id   = $_POST['id_kategori'];
            $nama = trim($_POST['nama_kategori']);

            if(!is_numeric($id) || empty($nama)){
                $_SESSION['error'] = "ID atau Nama kategori tidak valid!";
                return false;
            }

            $update = $this->model->update($id, $nama);

            if($update){
                $_SESSION['success'] = "Kategori berhasil diupdate!";
            } else {
                $_SESSION['error'] = "Gagal mengupdate kategori!";
            }

            header("Location: tampil_data_kategori.php");
            exit;
        }
    }

    // DELETE
    public function destroy($id){
        if(!is_numeric($id)) return false;

        $delete = $this->model->delete($id);

        if($delete){
            $_SESSION['success'] = "Kategori berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus kategori!";
        }

        header("Location: tampil_data_kategori.php");
        exit;
    }
}