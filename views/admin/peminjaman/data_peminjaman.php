<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../../controllers/c_peminjaman.php';

$controller = new c_peminjaman();
$data = $controller->index();
?>

<?php include '../../layouts/header.php'; ?>
<?php include '../../layouts/sidebar.php'; ?>

<div class="header">
    <h2>Data Peminjaman</h2>
</div>

<div class="container">

<div class="table-wrapper">

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Alat</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php $no=1; foreach($data as $d): ?>
    <tr>
        <td><?= $no++ ?></td>

        <!-- ✅ NAMA USER -->
        <td><?= $d['nama_user'] ?></td>

        <td><?= $d['nama_alat'] ?></td>
        <td><?= $d['tgl_pinjam'] ?></td>
        <td><?= $d['tgl_kembali'] ?></td>

        <!-- STATUS -->
        <td>
            <?php
            $status = strtolower($d['status']);

            if($status == 'menunggu'){
                echo "<span style='color:orange;font-weight:bold;'>Menunggu</span>";
            }elseif($status == 'dipinjam'){
                echo "<span style='color:green;font-weight:bold;'>Dipinjam</span>";
            }elseif($status == 'dikembalikan'){
                echo "<span style='color:blue;font-weight:bold;'>Dikembalikan</span>";
            }elseif($status == 'ditolak'){
                echo "<span style='color:red;font-weight:bold;'>Ditolak</span>";
            }else{
                echo "-";
            }
            ?>
        </td>

        <!-- AKSI -->
        <td>
            <a href="edit_peminjaman.php?id=<?= $d['id_peminjaman'] ?>">
                <button style="background:#ffc107;">Edit</button>
            </a>

            <a href="../../../controllers/c_peminjaman.php?hapus=<?= $d['id_peminjaman'] ?>"
               onclick="return confirm('Yakin hapus data?')">
                <button style="background:red;">Hapus</button>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>
</div>

<?php include '../../layouts/footer.php'; ?>

<style>
.container{
    padding:20px;
}

.table-wrapper{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
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

button{
    padding:6px 12px;
    border:none;
    border-radius:6px;
    color:white;
    cursor:pointer;
}

button:hover{
    opacity:0.9;
}
</style>