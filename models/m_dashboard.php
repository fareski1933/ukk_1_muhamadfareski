<?php
session_start();

if(!isset($_SESSION['role'])){
    header("Location: ../index.php");
    exit;
}

include_once __DIR__ . '/../models/m_dashboard.php';

class c_dashboard {
    private $model;

    public function __construct(){
        $this->model = new m_dashboard();
    }

    public function index(){
        $data = [
            'totalUser' => $this->model->totalUser(),
            'totalAlat' => $this->model->totalAlat(),
            'totalKategori' => $this->model->totalKategori(),
            'peminjaman' => $this->model->peminjamanTerbaru()
        ];

        include __DIR__ . '/../views/admin/dashboard.php';
    }
}

// Jalankan dashboard
$dashboard = new c_dashboard();
$dashboard->index();
