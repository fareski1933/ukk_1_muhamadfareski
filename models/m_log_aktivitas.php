<?php
include_once __DIR__.'/m_koneksi.php';

class m_log_aktivitas {

    public $conn;

    public function __construct(){
        $koneksi = new m_koneksi();
        $this->conn = $koneksi->koneksi;
    }

    // Ambil semua data log dengan nama user
    public function getAll(){
        $sql = "
            SELECT l.id_log, u.nama AS nama_user, l.aktivitas, l.tanggal
            FROM log_aktivitas l
            JOIN users u ON l.id_user = u.id_user
            ORDER BY l.tanggal DESC
        ";
        return mysqli_query($this->conn, $sql);
    }

    // Tambah log
    public function insert($id_user, $aktivitas){
        $stmt = mysqli_prepare($this->conn,
            "INSERT INTO log_aktivitas (id_user, aktivitas, tanggal) 
             VALUES (?, ?, NOW())"
        );
        mysqli_stmt_bind_param($stmt,"is",$id_user,$aktivitas);
        return mysqli_stmt_execute($stmt);
    }

    // Hapus log
    public function delete($id_log){
        $sql = "DELETE FROM log_aktivitas WHERE id_log=?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_log);
        return mysqli_stmt_execute($stmt);
    }

}
?>