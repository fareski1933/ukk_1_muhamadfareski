<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "petugas"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../models/m_koneksi.php';
$conn = new m_koneksi();

// ambil data
$query = mysqli_query($conn->koneksi, "
    SELECT 
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
    ORDER BY pg.id_pengembalian DESC
");
?>

<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2>Laporan Pengembalian</h2>
</div>

<div class="container">

    <!-- tombol print -->
    <button onclick="window.print()" class="btn-print">
        🖨️ Cetak Laporan
    </button>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Tgl Dikembalikan</th>
                    <th>Kondisi</th>
                    <th>Denda</th>
                </tr>
            </thead>

            <tbody>
                <?php $no=1; while($d = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['nama_alat'] ?></td>
                    <td><?= $d['tgl_pinjam'] ?></td>
                    <td><?= $d['tgl_kembali'] ?></td>
                    <td><?= $d['tgl_dikembalikan'] ?></td>

                    <td>
                        <?= $d['kondisi_kembali'] == 'baik' ? 
                        "<span style='color:green'>Baik</span>" : 
                        "<span style='color:red'>Rusak</span>" ?>
                    </td>

                    <td>
                        Rp <?= number_format($d['denda'],0,',','.') ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<style>
.container{
    padding:20px;
}

.table-wrapper{
    background:#fff;
    padding:20px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

th{
    background:#1e3c72;
    color:white;
}

.btn-print{
    margin-bottom:15px;
    padding:10px 15px;
    border:none;
    border-radius:8px;
    background:#28a745;
    color:white;
    cursor:pointer;
}

/* 🔥 biar sidebar hilang saat print */
@media print{
    .sidebar, .header, .btn-print{
        display:none !important;
    }

    body{
        margin:0;
    }
}
</style>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("active");
}
</script>