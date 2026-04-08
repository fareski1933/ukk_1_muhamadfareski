<?php
session_start();

if(!isset($_SESSION['role'])){
    header("Location: ../index.php");
    exit;
}

// include controller dashboard
include_once __DIR__ . '/../../controllers/c_dashboard.php';
$dashboard = new c_dashboard();

// ambil data untuk card
$totalUser     = $dashboard->countUser();
$totalAlat     = $dashboard->countAlat();
$totalKategori = $dashboard->countKategori();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard | Peminjaman Alat</title>
<?php include __DIR__ . '../../layouts/header.php'; ?>
</head>

<body>

<!-- SIDEBAR -->
<?php include __DIR__ . '../../layouts/sidebar.php'; ?>

<!-- HEADER -->
<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2>Sistem Peminjaman Alat</h2>
    <span class="admin-text">
        Halo <?= $_SESSION['nama']; ?> (<?= $_SESSION['role']; ?>)
    </span>
</div>

<div class="content-wrapper">

<!-- ===== MENU SESUAI ROLE ===== -->
<?php if($_SESSION['role']=="admin"): ?>
    <h3>Menu Admin</h3>
    <a href="../admin/user/data_user.php" class="btn-tambah">Kelola Data User</a>
    <a href="../admin/alat/tampil_data_alat.php" class="btn-tambah">Kelola Data Alat</a>
    <a href="../admin/kategori/tampil_data_kategori.php" class="btn-tambah">Kelola Kategori</a>
    <a href="../admin/peminjaman/data_peminjaman.php" class="btn-tambah">Kelola Peminjaman</a>
    <a href="../admin/pengembalian/data_pengembalian.php" class="btn-tambah">Kelola Pengembalian</a>
    <a href="../admin/aktivitas/log_aktivitas.php" class="btn-tambah">Kelola Aktivitas</a>

<?php elseif($_SESSION['role']=="petugas"): ?>
    <h3>Menu Petugas</h3>
    <a href="../petugas/verifikasi.php" class="btn-tambah">Verifikasi Peminjaman</a>

<?php elseif($_SESSION['role']=="peminjam"): ?>
    <h3>Menu Peminjam</h3>
    <a href="../peminjam/pinjam.php" class="btn-tambah">Pinjam Alat</a>
<?php endif; ?>

<!-- ===== CARD ===== -->
<div class="card-container">
    <div class="card">
        <h4>Total User</h4>
        <p><?= $totalUser ?></p>
    </div>

    <div class="card">
        <h4>Total Alat</h4>
        <p><?= $totalAlat ?></p>
    </div>

    <div class="card">
        <h4>Total Kategori</h4>
        <p><?= $totalKategori ?></p>
    </div>
</div>

</div> <!-- content-wrapper -->

<?php include __DIR__ . '../../layouts/footer.php'; ?>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("hide");
}
</script>

</body>
</html>