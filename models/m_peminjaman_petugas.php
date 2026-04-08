<?php
include_once 'm_koneksi.php';

class m_peminjaman_petugas extends m_koneksi {

    // ================= AMBIL DATA =================
    public function get_peminjaman(){
        $query = "SELECT p.*, a.nama_alat, u.nama 
                  FROM peminjaman p
                  JOIN alat a ON p.id_alat = a.id_alat
                  JOIN users u ON p.id_user = u.id_user
                  ORDER BY p.id_peminjaman DESC";

        $result = mysqli_query($this->koneksi, $query);

        if(!$result){
            die("Query Error: " . mysqli_error($this->koneksi));
        }

        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }

    // ================= AMBIL BY ID =================
    public function get_by_id($id){
        $query = "SELECT * FROM peminjaman WHERE id_peminjaman = '$id'";
        $result = mysqli_query($this->koneksi, $query);

        if(!$result){
            die("Query Error: " . mysqli_error($this->koneksi));
        }

        return mysqli_fetch_assoc($result);
    }

    // ================= SETUJUI =================
    public function setujui($id){
        $query = "UPDATE peminjaman 
                  SET status = 'dipinjam',
                      tgl_persetujuan = CURDATE()
                  WHERE id_peminjaman = '$id'";

        return mysqli_query($this->koneksi, $query);
    }

    // ================= TOLAK =================
    public function tolak($id){
        $query = "UPDATE peminjaman 
                  SET status = 'ditolak',
                      tgl_persetujuan = NULL
                  WHERE id_peminjaman = '$id'";

        return mysqli_query($this->koneksi, $query);
    }

    // ================= NOTIFIKASI =================
    public function tambah_notifikasi($id_user, $pesan){
        $query = "INSERT INTO notifikasi (id_user, pesan) 
                  VALUES ('$id_user', '$pesan')";

        return mysqli_query($this->koneksi, $query);
    }

    // ================= HAPUS (SELESAI) =================
    public function hapus($id){

        // 🔥 hapus dulu dari tabel pengembalian (biar tidak error FK)
        mysqli_query($this->koneksi, "
            DELETE FROM pengembalian 
            WHERE id_peminjaman = '$id'
        ");

        // 🔥 baru hapus dari peminjaman
        $query = "DELETE FROM peminjaman 
                  WHERE id_peminjaman = '$id'";

        $result = mysqli_query($this->koneksi, $query);

        // debug kalau gagal
        if(!$result){
            die("ERROR HAPUS: " . mysqli_error($this->koneksi));
        }

        return $result;
    }
}
?>