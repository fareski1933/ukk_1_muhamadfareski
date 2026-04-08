<?php
include_once __DIR__ . '/../models/m_koneksi.php';

class c_dashboard {
    private $conn;

    public function __construct() {
        $db = new m_koneksi();
        $this->conn = $db->koneksi;
    }

    public function countUser() {
        $result = mysqli_query($this->conn, "SELECT COUNT(*) AS total FROM users");
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    public function countAlat() {
        $result = mysqli_query($this->conn, "SELECT COUNT(*) AS total FROM alat");
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    public function countKategori() {
        $result = mysqli_query($this->conn, "SELECT COUNT(*) AS total FROM kategori");
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
}
