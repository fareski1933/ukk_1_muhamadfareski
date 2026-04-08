<?php
include_once __DIR__ . '/../models/m_koneksi.php';

class m_peminjam {

    private $conn;

    public function __construct(){

        $db = new m_koneksi();
        $this->conn = $db->koneksi;

    }

    // ambil daftar alat
    public function getAlat(){

        $query = mysqli_query($this->conn,"SELECT * FROM alat");

        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    // proses pinjam alat
    public function pinjamAlat($data){

    $id_user = $data['id_user'];
    $id_alat = $data['id_alat'];
    $tgl_pinjam = $data['tgl_pinjam'];
    $tgl_kembali = $data['tgl_kembali'];

    // cek stok dulu
    $cek = mysqli_query($this->conn, "SELECT stok FROM alat WHERE id_alat = '$id_alat'");
    $row = mysqli_fetch_assoc($cek);

    if($row['stok'] <= 0){
        return false; // stok habis
    }

    // insert peminjaman
    $query = "INSERT INTO peminjaman 
    (id_user,id_alat,tgl_pinjam,tgl_kembali,status)
    VALUES
    ('$id_user','$id_alat','$tgl_pinjam','$tgl_kembali','menunggu')";

    $insert = mysqli_query($this->conn,$query);

    if($insert){
        // kurangi stok
        mysqli_query($this->conn, "UPDATE alat SET stok = stok - 1 WHERE id_alat = '$id_alat'");
        return true;
    } else {
        return false;
    }
}
}