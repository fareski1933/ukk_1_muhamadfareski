<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../../controllers/c_alat.php';

$ctrl = new c_alat();
$data = $ctrl->index();
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>


<div class="header">
    <span class="menu-btn" onclick="taoggleMenu()">☰</span>
    <h2 style="display:inline;">Data Alat</h2>
</div>

<!-- ===== CONTAINER ===== -->
<div class="container">

    <a href="tambah_alat.php" class="btn-tambah">Tambah Alat</a>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Kondisi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($data)){ ?>
        <tr>
            <td><?= $row['id_alat'] ?></td>
            <td><?= $row['nama_alat'] ?></td>
            <td><?= $row['id_kategori'] ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= $row['kondisi'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="edit_alat.php?id=<?= $row['id_alat'] ?>">Edit</a>
                <a href="hapus_alat.php?id=<?= $row['id_alat'] ?>" class="hapus" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<br>
<a href="../dashboard.php" class="btn-kembali">Kembali</a>

</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>

<!-- ===== INLINE CSS KHUSUS TH ===== -->
<style>
/* Hanya th di tabel */
table thead th {
    background-color: #1E3A8A !important; /* biru gelap */
    color: #F3F4F6 !important; /* teks putih */
    padding:14px;
    text-align:left;
}
</style>
