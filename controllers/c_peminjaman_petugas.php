<?php

include_once __DIR__ . '/../models/m_peminjaman_petugas.php';
include_once __DIR__ . '/../models/m_log_aktivitas.php';

class c_peminjaman_petugas {

    private $model;
    private $log;

    function __construct(){
        $this->model = new m_peminjaman_petugas();
        $this->log = new m_log_aktivitas();
    }

    // ================= TAMPIL DATA =================
    public function index(){
        return $this->model->get_peminjaman();
    }

    // ================= AKSI =================
    public function aksi(){

        $id_user = $_SESSION['id_user']; // id petugas/admin

        // ================= SETUJUI =================
        if(isset($_GET['setujui'])){
            $id = $_GET['setujui'];

            $data = $this->model->get_by_id($id);

            $this->model->setujui($id);

            // 🔥 LOG
            $this->log->insert(
                $id_user,
                "Menyetujui peminjaman (ID: $id)"
            );

            $this->model->tambah_notifikasi(
                $data['id_user'],
                "Peminjaman kamu DISETUJUI"
            );

            header("Location: ../views/petugas/peminjaman.php");
            exit;
        }

        // ================= TOLAK =================
        if(isset($_GET['tolak'])){
            $id = $_GET['tolak'];

            $data = $this->model->get_by_id($id);

            $this->model->tolak($id);

            // 🔥 LOG
            $this->log->insert(
                $id_user,
                "Menolak peminjaman (ID: $id)"
            );

            $this->model->tambah_notifikasi(
                $data['id_user'],
                "Peminjaman kamu DITOLAK"
            );

            header("Location: ../views/petugas/peminjaman.php");
            exit;
        }

        // ================= ARSIP =================
        if(isset($_GET['arsip'])){
            $id = $_GET['arsip'];

            $this->model->hapus($id);

            // 🔥 LOG
            $this->log->insert(
                $id_user,
                "Mengarsipkan (menghapus) peminjaman (ID: $id)"
            );

            header("Location: ../views/petugas/peminjaman.php");
            exit;
        }

    }
}

// ================= JALANKAN =================
$controller = new c_peminjaman_petugas();

if(
    isset($_GET['setujui']) || 
    isset($_GET['tolak']) || 
    isset($_GET['arsip'])
){
    $controller->aksi();
}
?>