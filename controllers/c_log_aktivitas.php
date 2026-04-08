<?php
include_once __DIR__.'/../models/m_log_aktivitas.php';

class c_log_aktivitas {

    private $model;

    public function __construct(){
        $this->model = new m_log_aktivitas();
    }

    // Tampilkan data log
    public function index(){
        return $this->model->getAll();
    }

    // Tambah log
    public function tambahLog($id_user, $aktivitas){
        return $this->model->insert($id_user, $aktivitas);
    }

    // Hapus log
    public function hapus($id_log){
        return $this->model->delete($id_log);
    }

}

// PROSES HAPUS
if(isset($_GET['hapus'])){
    $controller = new c_log_aktivitas();
    $controller->hapus($_GET['hapus']);
    header("Location: /views/admin/aktivitas/log_aktivitas.php");
    exit;
}
?>