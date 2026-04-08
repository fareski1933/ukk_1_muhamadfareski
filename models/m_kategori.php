<?php
include_once __DIR__ . "/m_koneksi.php";

class m_kategori {

    private $koneksi;

    public function __construct(){
        $db = new m_koneksi();
        $this->koneksi = $db->koneksi;
    }

    // ================== TAMPIL SEMUA ==================
    public function getAll(){
        $sql = "SELECT * FROM kategori ORDER BY id_kategori ASC";
        return mysqli_query($this->koneksi, $sql);
    }

    // ================== BY ID ==================
    public function getById($id){
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $sql = "SELECT * FROM kategori WHERE id_kategori='$id'";
        return mysqli_query($this->koneksi, $sql);
    }

    // ================== INSERT ==================
    public function insert($nama){
        $nama = mysqli_real_escape_string($this->koneksi, $nama);
        $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama')";
        $query = mysqli_query($this->koneksi, $sql);
        if(!$query){
            die("Error Insert: ".mysqli_error($this->koneksi));
        }
        return $query;
    }

    // ================== UPDATE ==================
    public function update($id, $nama){
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $nama = mysqli_real_escape_string($this->koneksi, $nama);
        $sql = "UPDATE kategori 
                SET nama_kategori='$nama'
                WHERE id_kategori='$id'";
        $query = mysqli_query($this->koneksi, $sql);
        if(!$query){
            die("Error Update: ".mysqli_error($this->koneksi));
        }
        return $query;
    }

    // ================== DELETE ==================
    public function delete($id){
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $sql = "DELETE FROM kategori WHERE id_kategori='$id'";
        $query = mysqli_query($this->koneksi, $sql);
        if(!$query){
            die("Error Delete: ".mysqli_error($this->koneksi));
        }
        return $query;
    }
}