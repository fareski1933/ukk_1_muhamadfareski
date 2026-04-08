<?php
include_once 'm_koneksi.php';

class m_pengembalian_user extends m_koneksi {

    // ================= AMBIL DATA PEMINJAMAN USER =================
    public function get_peminjaman_user($id_user){
        // pastikan mengambil id_peminjaman, nama_alat, tgl_pinjam, tgl_kembali, status
        $query = "
            SELECT 
                p.id_peminjaman, 
                p.id_user, 
                p.id_alat, 
                p.tgl_pinjam, 
                p.tgl_kembali, 
                p.tgl_persetujuan, 
                p.status,
                a.nama_alat
            FROM peminjaman p
            JOIN alat a ON p.id_alat = a.id_alat
            WHERE p.id_user = '".mysqli_real_escape_string($this->koneksi, $id_user)."'
            AND p.status IN ('menunggu','dipinjam','ditolak')
        ";
        
        $result = mysqli_query($this->koneksi, $query);

        if(!$result){
            die("Query Error (get_peminjaman_user): ".mysqli_error($this->koneksi));
        }

        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }

    // ================= PROSES KEMBALIKAN =================
    public function kembalikan($id_peminjaman, $kondisi = 'baik', $denda = 0){

        $id_peminjaman = mysqli_real_escape_string($this->koneksi, $id_peminjaman);
        $kondisi = mysqli_real_escape_string($this->koneksi, $kondisi);
        $denda = (int)$denda;

        // ambil data peminjaman
        $get = mysqli_query($this->koneksi, "
            SELECT * FROM peminjaman 
            WHERE id_peminjaman='$id_peminjaman'
        ");

        if(!$get || mysqli_num_rows($get) == 0){
            die("Data peminjaman tidak ditemukan");
        }

        $data = mysqli_fetch_assoc($get);
        $id_alat = $data['id_alat'];

        // ================= INSERT KE PENGEMBALIAN =================
        $insert = mysqli_query($this->koneksi, "
            INSERT INTO pengembalian 
            (id_peminjaman, tgl_dikembalikan, kondisi_kembali, denda)
            VALUES 
            ('$id_peminjaman', NOW(), '$kondisi', '$denda')
        ");

        if(!$insert){
            die("Gagal insert pengembalian: ".mysqli_error($this->koneksi));
        }

        // ================= UPDATE STATUS PEMINJAMAN =================
        $update1 = mysqli_query($this->koneksi, "
            UPDATE peminjaman 
            SET status='dikembalikan'
            WHERE id_peminjaman='$id_peminjaman'
        ");

        if(!$update1){
            die("Gagal update status peminjaman: ".mysqli_error($this->koneksi));
        }

        // ================= TAMBAH STOK ALAT =================
        $update2 = mysqli_query($this->koneksi, "
            UPDATE alat 
            SET stok = stok + 1 
            WHERE id_alat='$id_alat'
        ");

        if(!$update2){
            die("Gagal update stok alat: ".mysqli_error($this->koneksi));
        }

        return true;
    }

    // ================= ARSIP (HAPUS DARI PEMINJAMAN) =================
    public function arsipkan($id_peminjaman){
        $id_peminjaman = mysqli_real_escape_string($this->koneksi, $id_peminjaman);

        // opsional: bisa simpan ke tabel arsip sebelum delete
        $delete = mysqli_query($this->koneksi, "
            DELETE FROM peminjaman 
            WHERE id_peminjaman='$id_peminjaman'
        ");

        if(!$delete){
            die("Gagal hapus peminjaman: ".mysqli_error($this->koneksi));
        }

        return true;
    }
}
?>