<?php
$base_url = "http://localhost/ukk_1_muhamadfareski/";
?>

<div class="sidebar active" id="sidebar">
<h3 style="text-align:center;">
    <i class="fa-solid fa-screwdriver-wrench"></i><br>
    Peminjaman Alat
</h3>

<ul>
    <?php if($_SESSION['role'] == "admin"): ?>
        <li><a href="<?= $base_url ?>views/admin/dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li><a href="<?= $base_url ?>views/admin/user/data_user.php"><i class="fa-solid fa-users"></i> Data User</a></li>
        <li><a href="<?= $base_url ?>views/admin/alat/tampil_data_alat.php"><i class="fa-solid fa-screwdriver-wrench"></i> Data Alat</a></li>
        <li><a href="<?= $base_url ?>views/admin/kategori/tampil_data_kategori.php"><i class="fa-solid fa-folder"></i> Data Kategori</a></li>
        <li><a href="<?= $base_url ?>views/admin/peminjaman/data_peminjaman.php"><i class="fa-solid fa-clipboard-list"></i> Data Peminjam</a></li>
        <li><a href="<?= $base_url ?>views/admin/pengembalian/data_pengembalian.php"><i class="fa-solid fa-rotate-left"></i> Pengembalian</a></li>
        <li><a href="<?= $base_url ?>views/admin/aktivitas/log_aktivitas.php"><i class="fa-solid fa-clock-rotate-left"></i> Log Aktivitas</a></li>

    <?php elseif($_SESSION['role'] == "petugas"): ?>
        <li><a href="../petugas/dashboard_petugas.php">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a></li>

        <li><a href="../petugas/peminjaman.php">
            <i class="fa-solid fa-clipboard-check"></i> Verifikasi Peminjaman
        </a></li>

        <li><a href="../petugas/pengembalian.php">
            <i class="fa-solid fa-rotate-left"></i> Monitoring Pengembalian
        </a></li>

        <li><a href="../petugas/laporan.php">
            <i class="fa-solid fa-file-lines"></i> Cetak Laporan
        </a></li>

    <?php elseif($_SESSION['role'] == "peminjam"): ?>
        <li><a href="../peminjam/dashboard_peminjam.php">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a></li>

        <li><a href="../peminjam/daftar_alat.php">
            <i class="fa-solid fa-screwdriver-wrench"></i> Daftar Alat & Pinjam
        </a></li>

        <li><a href="../peminjam/mengembalikan_alat.php">
            <i class="fa-solid fa-rotate-left"></i> Mengembalikan Alat
        </a></li>

    <?php endif; ?>

    <li><a href="<?= $base_url ?>views/index.php" class="logout">
        <i class="fa fa-sign-out-alt"></i> Logout
    </a></li>
</ul>
</div>