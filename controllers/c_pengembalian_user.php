<?php
include_once __DIR__ . '/../models/m_pengembalian_user.php';

// Pastikan base_url menggunakan HTTPS
$base_url = "https://muhamad-fareski-peminjaman-alat.free.nf/";

class c_pengembalian_user {

    private $model;

    function __construct(){
        $this->model = new m_pengembalian_user();
    }

    // ================= TAMPIL DATA =================
    public function index(){
        // Pastikan session sudah start di file view yang memanggil ini
        $id_user = $_SESSION['id_user'];
        return $this->model->get_peminjaman_user($id_user);
    }

    // ================= KEMBALIKAN =================
    public function kembalikan(){
        global $base_url; // Panggil variabel global

        // VALIDASI POST
        if(!isset($_POST['id_peminjaman'], $_POST['kondisi_kembali'], $_POST['denda'])){
            die("Data tidak lengkap");
        }

        $id = $_POST['id_peminjaman'];
        $kondisi = $_POST['kondisi_kembali'];
        $denda = $_POST['denda'];

        if(!$id){
            die("ID tidak ditemukan");
        }

        // proses ke model
        $this->model->kembalikan($id, $kondisi, $denda);

        $_SESSION['notif_kembali'] = "Alat berhasil dikembalikan";

        // Redirect menggunakan URL Lengkap
        header("Location: " . $base_url . "views/peminjam/mengembalikan_alat.php");
        exit;
    }

    // ================= ARSIP =================
    public function arsip(){
        global $base_url; // Panggil variabel global

        if(!isset($_POST['id_peminjaman'])){
            die("ID tidak ditemukan");
        }

        $id = $_POST['id_peminjaman'];

        $this->model->arsipkan($id);

        $_SESSION['notif_arsip'] = "Data berhasil dihapus";

        // Redirect menggunakan URL Lengkap
        header("Location: " . $base_url . "views/peminjam/mengembalikan_alat.php");
        exit;
    }
}

// ================= ROUTING =================
$controller = new c_pengembalian_user();

if(isset($_GET['aksi'])){
    // Pastikan session_start sudah ada jika butuh session di sini
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if($_GET['aksi'] == 'kembalikan' && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $controller->kembalikan();
    }

    if($_GET['aksi'] == 'arsip' && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $controller->arsip();
    }
}
?>