<?php
include_once __DIR__ . "/m_koneksi.php";

class m_user {

    private $koneksi;

    public function __construct(){
        $db = new m_koneksi();
        $this->koneksi = $db->koneksi;
    }

    // TAMPIL SEMUA USER
    public function getAll(){
        $sql = "SELECT * FROM users ORDER BY id_user ASC";
        return mysqli_query($this->koneksi, $sql);
    }

    // AMBIL 1 USER BERDASARKAN ID
    public function getById($id){
        $sql = "SELECT * FROM users WHERE id_user=?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // TAMBAH USER

    public function insert($nama, $email, $no_tlp, $password, $role='peminjam'){
        $sql = "INSERT INTO users (nama, email, no_tlp, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("sssss", $nama, $email, $no_tlp, $password, $role);
        return $stmt->execute();
    }

    // UPDATE ROLE USER
    public function updateRole($id, $role){
        $sql = "UPDATE users SET role=? WHERE id_user=?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("si", $role, $id);
        return $stmt->execute();
    }

    // HAPUS USER
    public function delete($id){
        $sql = "DELETE FROM users WHERE id_user=?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>