<?php
include_once __DIR__ . '/m_koneksi.php';

class m_pengembalian {

    private $conn;

    public function __construct(){
        $koneksi = new m_koneksi();
        $this->conn = $koneksi->koneksi;
    }

    // ================= AMBIL DATA + NAMA PEMINJAM =================
     // ================= AMBIL DATA + NAMA PEMINJAM =================
public function getAllWithNamaUser(){
    $query = "
        SELECT k.id_pengembalian, k.id_peminjaman, k.tgl_dikembalikan, k.kondisi_kembali, k.denda,
               u.nama
        FROM pengembalian k
        JOIN peminjaman p ON k.id_peminjaman = p.id_peminjaman
        JOIN users u ON p.id_user = u.id_user
        ORDER BY k.id_pengembalian ASC
    ";
    $result = mysqli_query($this->conn, $query);
    if(!$result){
        die("Query Error: " . mysqli_error($this->conn));
    }
    return $result;
}

// ================= GET DATA BY ID =================
public function getById($id){
    $stmt = $this->conn->prepare("
        SELECT k.id_pengembalian, k.id_peminjaman, k.tgl_dikembalikan, k.kondisi_kembali, k.denda,
               u.nama
        FROM pengembalian k
        JOIN peminjaman p ON k.id_peminjaman = p.id_peminjaman
        JOIN users u ON p.id_user = u.id_user
        WHERE k.id_pengembalian=?
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

    // ================= INSERT =================
    public function insert($data){
        $stmt = $this->conn->prepare("
            INSERT INTO pengembalian (id_peminjaman, tgl_dikembalikan, kondisi_kembali, denda)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("issi",
            $data['id_peminjaman'],
            $data['tgl_dikembalikan'],
            $data['kondisi_kembali'],
            $data['denda']
        );
        return $stmt->execute();
    }

    // ================= UPDATE =================
    public function update($id, $tgl, $kondisi, $denda){
        $stmt = $this->conn->prepare("
            UPDATE pengembalian SET
                tgl_dikembalikan=?,
                kondisi_kembali=?,
                denda=?
            WHERE id_pengembalian=?
        ");
        $stmt->bind_param("ssii", $tgl, $kondisi, $denda, $id);
        return $stmt->execute();
    }

    // ================= DELETE =================
    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM pengembalian WHERE id_pengembalian=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>