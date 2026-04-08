<?php
include_once 'm_koneksi.php';

class m_pengembalian_petugas extends m_koneksi {

    // ambil data pengembalian + relasi
    public function get_pengembalian(){

        $query = "SELECT 
                    p.id_peminjaman,
                    u.nama,
                    a.nama_alat,
                    p.tgl_pinjam,
                    p.tgl_kembali,
                    pg.tgl_dikembalikan,
                    pg.kondisi_kembali,
                    pg.denda
                  FROM pengembalian pg
                  JOIN peminjaman p ON pg.id_peminjaman = p.id_peminjaman
                  JOIN alat a ON p.id_alat = a.id_alat
                  JOIN users u ON p.id_user = u.id_user
                  ORDER BY pg.id_pengembalian DESC";

        $result = mysqli_query($this->koneksi, $query);

        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }

    // hapus data (selesai)
    public function hapus($id){
        return mysqli_query($this->koneksi, "
            DELETE FROM pengembalian 
            WHERE id_peminjaman = '$id'
        ");
    }
}
?>