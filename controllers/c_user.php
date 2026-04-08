<?php
include_once __DIR__ . "/../models/m_user.php";

class c_user {

    public $model;

    public function __construct(){
        $this->model = new m_user();
    }

    // =========================
    // TAMPIL DATA USER
    // =========================
    public function index(){
        return $this->model->getAll();
    }

    // =========================
    // SIMPAN USER BARU
    // =========================
    public function store(){
        $nama     = $_POST['nama'] ?? '';
        $email    = $_POST['email'] ?? '';
        $no_tlp   = $_POST['no_tlp'] ?? '';
        $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
        $role     = 'peminjam'; // 🔥 DEFAULT ROLE UNTUK USER BARU

        $this->model->insert($nama, $email, $no_tlp, $password, $role);

        header("Location: http://localhost/ukk_1_muhamadfareski/views/admin/user/data_user.php");
        exit;
    }

    // =========================
    // HANDLE AKSI (UPDATE ROLE / DELETE)
    // =========================
    public function handleAksi(){
        if(!empty($_GET['aksi'])){
            $aksi = $_GET['aksi'];

            // =====================
            // UPDATE ROLE USER
            // =====================
            if($aksi == "edit_role"){
                $id   = $_POST['id_user'] ?? null;
                $role = $_POST['role'] ?? null;

                if($id && $role){
                    $this->model->updateRole($id, $role);
                }

                header("Location: http://localhost/ukk_1_muhamadfareski/views/admin/user/data_user.php");
                exit;
            }

            // =====================
            // HAPUS USER
            // =====================
            elseif($aksi == "hapus"){
                $id = $_GET['id'] ?? null;

                if($id){
                    $this->model->delete($id);
                }

                header("Location: http://localhost/ukk_1_muhamadfareski/views/admin/user/data_user.php");
                exit;
            }
        }
    }
}

// =========================
// PANGGIL CONTROLLER
// =========================
$controller = new c_user();
$controller->handleAksi();