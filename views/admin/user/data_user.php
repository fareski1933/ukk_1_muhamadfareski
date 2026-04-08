<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../../controllers/c_user.php';

$controller = new c_user();
$data = $controller->index();
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>

<style>
/* ===== TABLE WRAPPER ===== */
.table-wrapper{
    margin-top:20px;
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

/* ===== TH DARK FIX ===== */
.table-wrapper table thead th {
    background-color: #1E3A8A !important; /* Biru Gelap */
    color: #F3F4F6 !important; /* Teks Putih */
    padding:14px;
    text-align:left;
}

/* TD NORMAL */
td{
    padding:12px;
    border-bottom:1px solid #eee;
    vertical-align:middle;
}

/* HOVER TR */
tr:hover{
    background:#f5f9ff;
}

/* KOLOM AKSI */
td:last-child{
    min-width:160px;
    white-space:nowrap;
}

td:last-child a{
    display:inline-block;
    text-decoration:none;
    padding:6px 12px;
    border-radius:6px;
    font-size:14px;
    font-weight:500;
    margin-right:6px;
}

/* Edit */
td:last-child a:first-child{
    background:#4facfe;
    color:white;
}

/* Hapus */
td:last-child a.hapus{
    background:#ff4d4d;
    color:white;
}

/* ===== TOMBOL ===== */
.btn-kembali{
    display:inline-block;
    margin-top:20px;
    background:#e74c3c;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight:500;
    transition:.3s;
}

.btn-kembali:hover{
    background:#c0392b;
    transform:translateY(-2px);
}

.btn-tambah{
    display:inline-block;
    background:#28a745;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
    margin-bottom:15px;
    transition:.3s;
}

.btn-tambah:hover{
    background:#218838;
    transform:translateY(-2px);
}
</style>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2 style="display:inline;">Data User</h2>
</div>

<div class="container">


    <!-- WRAPPER TABLE -->
    <div class="table-wrapper">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $no = 1;
            while($row = mysqli_fetch_assoc($data)){
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['no_tlp'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $row['id_user'] ?>">Edit</a>
                        <a class="hapus"
                           href="../../../controllers/c_user.php?aksi=hapus&id=<?= $row['id_user'] ?>"
                           onclick="return confirm('Yakin hapus?')">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>

    </div>

    <br>

    <a href="../dashboard.php" class="btn-kembali">Kembali</a>

</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>