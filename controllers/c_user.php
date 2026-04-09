<?php
// Pastikan path ini benar (Case Sensitive di hosting!)
include_once __DIR__ . "/../models/m_user.php";

// 1. Definisikan Base URL di paling atas agar bisa dipakai di semua fungsi
$base_url = "http://muhamad-fareski-peminjaman-alat.free.nf/";

class c_user {

    public $model;

    public function __construct(){
        $this->model = new m_user();
    }

    public function index(){
        return $this->model->getAll();
    }

    public function store(){
        // 2. Tambahkan global agar fungsi bisa membaca variabel di luar class
        global $base_url;

        $nama     = $_POST['nama'] ?? '';
        $email    = $_POST['email'] ?? '';
        $no_tlp   = $_POST['no_tlp'] ?? '';
        $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
        $role     = 'peminjam';

        $this->model->insert($nama, $email, $no_tlp, $password, $role);

        header("Location: " . $base_url . "views/admin/user/data_user.php");
        exit;
    }

    public function handleAksi(){
        // 3. Tambahkan global di sini juga
        global $base_url;

        if(!empty($_GET['aksi'])){
            $aksi = $_GET['aksi'];

            if($aksi == "edit_role"){
                $id   = $_POST['id_user'] ?? null;
                $role = $_POST['role'] ?? null;

                if($id && $role){
                    $this->model->updateRole($id, $role);
                }
                header("Location: " . $base_url . "views/admin/user/data_user.php");
                exit;
            }
            elseif($aksi == "hapus"){
                $id = $_GET['id'] ?? null;

                if($id){
                    $this->model->delete($id);
                }
                header("Location: " . $base_url . "views/admin/user/data_user.php");
                exit;
            }
        }
    }
}

// PANGGIL CONTROLLER
$controller = new c_user();
$controller->handleAksi();