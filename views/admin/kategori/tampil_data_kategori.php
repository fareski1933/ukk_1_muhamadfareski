<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../../controllers/c_kategori.php';

$controller = new c_kategori();
$data = $controller->index();

// HAPUS
if(isset($_GET['hapus'])){
    $controller->destroy($_GET['hapus']);
    header("Location: tampil_data_kategori.php");
    exit;
}
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2 style="display:inline;">Data Kategori</h2>
</div>

<div class="container" style="min-height:80vh;">

<a href="tambah_kategori.php" class="btn-tambah">+ Tambah Kategori</a>

<div class="table-wrapper">

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php while($row = mysqli_fetch_assoc($data)){ ?>
    <tr>
        <!-- ✅ Pakai ID dari database -->
        <td><?= $row['id_kategori'] ?></td>

        <td><?= $row['nama_kategori'] ?></td>
        <td>
            <a href="edit_kategori.php?id=<?= $row['id_kategori'] ?>">Edit</a>
            <a href="?hapus=<?= $row['id_kategori'] ?>" 
               class="hapus"
               onclick="return confirm('Yakin hapus?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

</div>

<a href="../dashboard.php" class="btn-kembali">Kembali</a>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>

<style>
.table-wrapper table thead th {
    background-color: #1E3A8A !important;
    color: #F3F4F6 !important;
    padding:14px;
    text-align:left;
}
</style>