<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../../controllers/c_pengembalian.php';

$controller = new c_pengembalian();
$data = $controller->index();

if (isset($_GET['hapus'])) {
    $controller->hapus($_GET['hapus']);
    header("Location: tampil_data_pengembalian.php");
    exit;
}
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2 style="display:inline;">Data Pengembalian</h2>
</div>

<div class="container" style="min-height:80vh;">
<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Tanggal Kembali</th>
            <th>Kondisi</th>
            <th>Denda</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    if ($data && mysqli_num_rows($data) > 0) {
        while($row = mysqli_fetch_assoc($data)){
    ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['tgl_dikembalikan']) ?></td>
            <td><?= htmlspecialchars($row['kondisi_kembali']) ?></td>
            <td><?= htmlspecialchars($row['denda']) ?></td>
            <td>
                <!-- Tombol Edit merah -->
                <a href="edit_pengembalian.php?id=<?= $row['id_pengembalian'] ?>" class="edit-btn">Edit</a>
                <!-- Tombol Hapus default -->
                <a href="?hapus=<?= $row['id_pengembalian'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";
    }
    ?>
    </tbody>
</table>
</div>

<a href="../dashboard.php" class="btn-kembali">Kembali</a>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>

<style>
.table-wrapper table {
    width: 100%;
    border-collapse: collapse;
}

.table-wrapper table th,
.table-wrapper table td {
    padding: 12px;
    border: 1px solid #ddd;
}

.table-wrapper table thead th {
    background-color: #1E3A8A;
    color: #F3F4F6;
    text-align: left;
}

/* ===== FIX TOMBOL EDIT ===== */
.table-wrapper td a.edit-btn {
    display: inline-block;
    background-color: #dc3545 !important; /* merah */
    color: white !important;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    text-align: center;
    transition: 0.2s;
}

.table-wrapper td a.edit-btn:hover {
    background-color: #b02a37 !important; /* merah gelap */
}

/* ===== OPTIONAL: RAPIIKAN HAPUS ===== */
.table-wrapper td a:not(.edit-btn) {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
}

/* ===== TOMBOL KEMBALI ===== */
.btn-kembali {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 18px;
    background-color: #dc3545;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    transition: 0.2s;
}

.btn-kembali:hover {
    background-color: #b02a37;
}

/* ===== LINK DEFAULT ===== */
a {
    text-decoration: none;
    margin-right: 8px;
}

a:hover {
    text-decoration: underline;
}
</style>