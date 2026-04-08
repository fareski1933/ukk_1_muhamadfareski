<?php
include_once __DIR__ . '/m_koneksi.php';

class m_peminjaman {

    public $conn;

    public function __construct() {
        $db = new m_koneksi();
        $this->conn = $db->koneksi;
    }

    // ================= AMBIL SEMUA DATA =================
    public function getAllPeminjaman() {
        $query = "SELECT 
                    p.*,
                    u.nama AS nama_user,
                    a.nama_alat
                  FROM peminjaman p
                  JOIN users u ON p.id_user = u.id_user
                  JOIN alat a ON p.id_alat = a.id_alat
                  ORDER BY p.id_peminjaman DESC";

        $result = mysqli_query($this->conn, $query);

        if(!$result){
            die("Query Error: " . mysqli_error($this->conn));
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    // ================= AMBIL BY ID =================
    public function getPeminjamanById($id) {
        $id = intval($id);

        $query = "SELECT * FROM peminjaman WHERE id_peminjaman='$id'";
        $result = mysqli_query($this->conn, $query);

        if(!$result){
            die("Query Error: " . mysqli_error($this->conn));
        }

        return mysqli_fetch_assoc($result);
    }

    // ================= TAMBAH =================
    public function addPeminjaman($data) {

        $id_user = $data['id_user'];
        $id_alat = $data['id_alat'];
        $tgl_pinjam = $data['tgl_pinjam'];
        $tgl_kembali = $data['tgl_kembali'];
        $status = strtolower($data['status']);
        $tgl_persetujuan = isset($data['tgl_persetujuan']) 
            ? "'".$data['tgl_persetujuan']."'" 
            : "NULL";

        $query = "INSERT INTO peminjaman 
                  (id_user,id_alat,tgl_pinjam,tgl_kembali,status,tgl_persetujuan)
                  VALUES 
                  ('$id_user','$id_alat','$tgl_pinjam','$tgl_kembali','$status',$tgl_persetujuan)";

        $result = mysqli_query($this->conn,$query);

        if(!$result){
            die("Insert Error: " . mysqli_error($this->conn));
        }

        return $result;
    }

    // ================= UPDATE =================
    public function updatePeminjaman($id,$data){

        $id = intval($id);
        $status = strtolower($data['status']);

        // otomatis isi tanggal persetujuan
        $tgl_persetujuan = ($status == 'dipinjam') 
            ? ", tgl_persetujuan = NOW()" 
            : "";

        $query = "UPDATE peminjaman SET
                    id_user='{$data['id_user']}',
                    id_alat='{$data['id_alat']}',
                    tgl_pinjam='{$data['tgl_pinjam']}',
                    tgl_kembali='{$data['tgl_kembali']}',
                    status='{$status}'
                    $tgl_persetujuan
                  WHERE id_peminjaman='$id'";

        $result = mysqli_query($this->conn,$query);

        if(!$result){
            die("Update Error: " . mysqli_error($this->conn));
        }

        return $result;
    }

    // ================= HAPUS =================
    public function deletePeminjaman($id){
        $id = intval($id);

        $query = "DELETE FROM peminjaman WHERE id_peminjaman='$id'";
        $result = mysqli_query($this->conn, $query);

        if(!$result){
            die("Delete Error: " . mysqli_error($this->conn));
        }

        return $result;
    }
}
?>