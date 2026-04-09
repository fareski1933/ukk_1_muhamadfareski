<?php
// Gunakan path yang aman untuk memanggil model
include_once __DIR__ . '/../models/m_log_aktivitas.php';

class c_log_aktivitas {

    private $model;

    public function __construct(){
        $this->model = new m_log_aktivitas();
    }

    // Fungsi untuk mengambil semua data log
    public function index(){
        return $this->model->getAll();
    }

    // Fungsi untuk menambah log baru (jika dibutuhkan di fitur lain)
    public function tambahLog($id_user, $aktivitas){
        return $this->model->insert($id_user, $aktivitas);
    }

    // Fungsi untuk menghapus log berdasarkan ID
    public function hapus($id_log){
        // Fungsi ini cuma mengembalikan true/false (berhasil/gagal)
        // Urusan redirect halaman diserahkan ke file View yang memanggilnya
        return $this->model->delete($id_log);
    }

}

?>