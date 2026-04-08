<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../index.php");
    exit;
}

include_once '../../../controllers/c_log_aktivitas.php';

$controller = new c_log_aktivitas();
$data = $controller->index();
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2 style="display:inline;">Log Aktivitas</h2>
</div>

<div class="container" style="min-height:80vh;">

<div class="table-wrapper">

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Aktivitas</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php
    $no = 1;
    while($row = $data->fetch_assoc()){
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama_user']) ?></td>
        <td><?= htmlspecialchars($row['aktivitas']) ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td>
            <a href="?hapus=<?= $row['id_log'] ?>" 
               class="hapus"
               onclick="return confirm('Yakin hapus?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php } ?>
    </tbody>

</table>

</div> <!-- table-wrapper -->

<a href="../dashboard.php" class="btn-kembali">Kembali</a>

</div> <!-- container -->

<?php include __DIR__ . '/../../layouts/footer.php'; ?>

<style>
.table-wrapper table thead th {
    background-color: #1E3A8A !important;
    color: #F3F4F6 !important;
    padding: 14px;
    text-align: left;
}
</style>