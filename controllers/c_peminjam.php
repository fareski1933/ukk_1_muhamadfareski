<?php
// ✅ Pastikan session hanya dijalankan sekali
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../models/m_peminjam.php';
include_once __DIR__ . '/../models/m_log_aktivitas.php';

class c_peminjam {

    private $model;
    private $log;

    public function __construct(){
        $this->model = new m_peminjam();
        $this->log = new m_log_aktivitas();
    }

    // Ambil daftar alat untuk peminjam
    public function getAlatPeminjam(){
        return $this->model->getAlat();
    }

    // Proses peminjaman alat
    public function pinjam(){

        // cek login
        if(!isset($_SESSION['id_user'])){
            die("User belum login");
        }

        // cek input
        if(!isset($_POST['id_alat'], $_POST['tgl_pinjam'], $_POST['tgl_kembali'])){
            die("Data tidak lengkap");
        }

        $id_user = $_SESSION['id_user'];

        $data = [
            'id_user' => $id_user,
            'id_alat' => $_POST['id_alat'],
            'tgl_pinjam' => $_POST['tgl_pinjam'],
            'tgl_kembali' => $_POST['tgl_kembali']
        ];

        $result = $this->model->pinjamAlat($data);

        if($result){
            // Tambah log aktivitas
            $this->log->insert(
                $id_user, 
                "Mengajukan peminjaman alat (ID Alat: ".$_POST['id_alat'].")"
            );

            $_SESSION['notif_pinjam'] = "✅ Pengajuan berhasil, tunggu persetujuan!";
        } else {
            $_SESSION['notif_pinjam'] = "❌ Gagal melakukan peminjaman!";
        }

        // Redirect kembali ke daftar alat
        header("Location: ../views/peminjam/daftar_alat.php");
        exit;
    }
}

// Routing: cek aksi
if(isset($_GET['aksi'])){
    $controller = new c_peminjam();

    if($_GET['aksi'] == "pinjam"){
        $controller->pinjam();
    }
}
?>