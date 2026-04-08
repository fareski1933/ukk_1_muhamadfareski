<?php
include_once __DIR__ . "/m_koneksi.php";

class m_alat {

    private $koneksi;

    public function __construct(){
        $db = new m_koneksi();
        $this->koneksi = $db->koneksi;
    }

    // ================== TAMPIL SEMUA ==================
    public function getAll(){
        $sql = "SELECT * FROM alat ORDER BY id_alat ASC";
        return mysqli_query($this->koneksi, $sql);
    }

    // ================== BY ID ==================
    public function getById($id){
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $sql = "SELECT * FROM alat WHERE id_alat='$id'";
        return mysqli_query($this->koneksi, $sql);
    }

    // ================== INSERT ==================
    public function insert($nama, $kategori, $stok, $kondisi, $status){
        $nama = mysqli_real_escape_string($this->koneksi, $nama);
        $kategori = mysqli_real_escape_string($this->koneksi, $kategori);
        $stok = mysqli_real_escape_string($this->koneksi, $stok);
        $kondisi = mysqli_real_escape_string($this->koneksi, $kondisi);
        $status = mysqli_real_escape_string($this->koneksi, $status);

        $sql = "INSERT INTO alat
                (nama_alat, id_kategori, stok, kondisi, status)
                VALUES
                ('$nama', '$kategori', '$stok', '$kondisi', '$status')";

        $query = mysqli_query($this->koneksi, $sql);

        if(!$query){
            die("Error Insert: ".mysqli_error($this->koneksi));
        }

        return $query;
    }

    // ================== UPDATE ==================
    public function update($id, $nama, $kategori, $stok, $kondisi, $status){
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $nama = mysqli_real_escape_string($this->koneksi, $nama);
        $kategori = mysqli_real_escape_string($this->koneksi, $kategori);
        $stok = mysqli_real_escape_string($this->koneksi, $stok);
        $kondisi = mysqli_real_escape_string($this->koneksi, $kondisi);
        $status = mysqli_real_escape_string($this->koneksi, $status);

        $sql = "UPDATE alat SET
                nama_alat='$nama',
                id_kategori='$kategori',
                stok='$stok',
                kondisi='$kondisi',
                status='$status'
                WHERE id_alat='$id'";
        return mysqli_query($this->koneksi, $sql);
    }

    // ================== DELETE ==================
    public function delete($id){
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $sql = "DELETE FROM alat WHERE id_alat='$id'";
        return mysqli_query($this->koneksi, $sql);
    }
}