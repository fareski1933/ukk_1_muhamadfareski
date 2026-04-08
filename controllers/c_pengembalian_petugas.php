<?php
include_once __DIR__ . '/../models/m_pengembalian_petugas.php';

class c_pengembalian_petugas {

    private $model;

    function __construct(){
        $this->model = new m_pengembalian_petugas();
    }

    public function index(){
        return $this->model->get_pengembalian();
    }

    public function aksi(){

        if(isset($_GET['hapus'])){
            $id = $_GET['hapus'];

            $this->model->hapus($id);

            header("Location: ../views/petugas/pengembalian.php");
            exit;
        }

    }
}

// jalankan
$controller = new c_pengembalian_petugas();

if(isset($_GET['hapus'])){
    $controller->aksi();
}
?>