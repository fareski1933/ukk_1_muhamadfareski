<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "petugas"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../controllers/c_pengembalian_petugas.php';

$controller = new c_pengembalian_petugas();
$data = $controller->index();
?>

<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/sidebar.php'; ?>

<div class="header">
    <h2>Monitoring Pengembalian</h2>
</div>

<div class="container">
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
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php $no=1; foreach($data as $d): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama'] ?></td>
    <td><?= $d['nama_alat'] ?></td>
    <td><?= $d['tgl_pinjam'] ?></td>
    <td><?= $d['tgl_kembali'] ?></td>
    <td><?= $d['tgl_dikembalikan'] ?></td>

    <td>
        <?php
        if($d['kondisi_kembali'] == 'baik'){
            echo "<span style='color:green;'>Baik</span>";
        }else{
            echo "<span style='color:red;'>Rusak</span>";
        }
        ?>
    </td>

    <td>
        Rp <?= number_format($d['denda'],0,',','.') ?>
    </td>

    <td>
        <a href="../../controllers/c_pengembalian_petugas.php?hapus=<?= $d['id_peminjaman'] ?>"
           onclick="return confirm('Hapus data ini?')">
            <button style="background:#6c757d;">Selesai</button>
        </a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>

</table>

</div>
</div>

<style>
.container{padding:20px;}
.table-wrapper{background:#fff;padding:20px;border-radius:15px;}
table{width:100%;border-collapse:collapse;}
th,td{padding:10px;text-align:center;border-bottom:1px solid #ddd;}
th{background:#1e3c72;color:white;}
button{padding:6px 12px;border:none;border-radius:8px;color:white;}
</style>