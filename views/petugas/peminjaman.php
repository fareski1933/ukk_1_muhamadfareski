<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "petugas"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../controllers/c_peminjaman_petugas.php';

$controller = new c_peminjaman_petugas();
$data = $controller->index();
?>

<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2>Persetujuan Peminjaman</h2>
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
                    <th>Tgl Persetujuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if(empty($data)): ?>
                <tr>
                    <td colspan="8">Tidak ada data</td>
                </tr>
            <?php else: ?>

            <?php $no=1; foreach($data as $d): ?>

            <?php 
            $status = strtolower(trim($d['status'] ?? ''));
            ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama'] ?? '-' ?></td>
                <td><?= $d['nama_alat'] ?? '-' ?></td>
                <td><?= $d['tgl_pinjam'] ?? '-' ?></td>
                <td><?= $d['tgl_kembali'] ?? '-' ?></td>

                <!-- STATUS -->
                <td>
                    <?php
                    if($status == 'menunggu'){
                        echo "<span style='color:orange;font-weight:bold;'>Menunggu</span>";
                    }elseif($status == 'dipinjam'){
                        echo "<span style='color:green;font-weight:bold;'>Dipinjam</span>";
                    }elseif($status == 'ditolak'){
                        echo "<span style='color:red;font-weight:bold;'>Ditolak</span>";
                    }elseif($status == 'dikembalikan'){
                        echo "<span style='color:blue;font-weight:bold;'>Dikembalikan</span>";
                    }elseif($status == 'arsip'){
                        echo "<span style='color:purple;font-weight:bold;'>Arsip</span>";
                    }else{
                        echo "<span style='color:gray;'>-</span>";
                    }
                    ?>
                </td>

                <!-- TGL PERSETUJUAN -->
                <td>
                    <?php
                    if($status == 'dipinjam' && !empty($d['tgl_persetujuan'])){
                        echo date('d-m-Y', strtotime($d['tgl_persetujuan']));
                    }elseif($status == 'ditolak'){
                        echo "<span style='color:red;'>Ditolak</span>";
                    }else{
                        echo "-";
                    }
                    ?>
                </td>

                <!-- AKSI -->
                <td>

                    <?php if($status == 'menunggu'): ?>

                        <a href="../../controllers/c_peminjaman_petugas.php?setujui=<?= $d['id_peminjaman'] ?>">
                            <button style="background:green;">Setujui</button>
                        </a>

                        <a href="../../controllers/c_peminjaman_petugas.php?tolak=<?= $d['id_peminjaman'] ?>">
                            <button style="background:red;">Tolak</button>
                        </a>

                    <?php elseif($status == 'ditolak' || $status == 'dikembalikan' || $status == 'arsip'): ?>

                        <a href="../../controllers/c_peminjaman_petugas.php?arsip=<?= $d['id_peminjaman'] ?>"
                           onclick="return confirm('Yakin mau menghapus data ini?')">
                            <button style="background:#6c757d;">Selesai</button>
                        </a>

                    <?php else: ?>

                        <span style="color:gray;">-</span>

                    <?php endif; ?>

                </td>
            </tr>

            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>

        </table>

    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("active");
}
</script>

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

button{
    padding:6px 12px;
    border:none;
    border-radius:8px;
    color:white;
    cursor:pointer;
}

button:hover{
    opacity:0.9;
}

</style>