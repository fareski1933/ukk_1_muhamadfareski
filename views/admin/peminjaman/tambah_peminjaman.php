<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../../models/m_peminjaman.php';
include_once __DIR__ . '/../../../models/m_user.php';
include_once __DIR__ . '/../../../models/m_alat.php';

$peminjamanModel = new m_peminjaman();
$userModel       = new m_user();
$alatModel       = new m_alat();

/* ================= FETCH USER ================= */
$resultUsers = $userModel->getAll();
$users = $resultUsers ? mysqli_fetch_all($resultUsers, MYSQLI_ASSOC) : [];

/* ================= FETCH ALAT ================= */
$resultAlats = $alatModel->getAll();
$alats = $resultAlats ? mysqli_fetch_all($resultAlats, MYSQLI_ASSOC) : [];

/* ================= HANDLE SUBMIT ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'id_user'     => $_POST['id_user'],
        'id_alat'     => $_POST['id_alat'],
        'tgl_pinjam'  => $_POST['tgl_pinjam'],
        'tgl_kembali' => $_POST['tgl_kembali'],
        'status'      => $_POST['status'],
        'tgl_persetujuan' => ($_POST['status'] == 'dipinjam') ? date('Y-m-d') : NULL
    ];

    // cek stok
    $cek = mysqli_query($peminjamanModel->conn, "
        SELECT stok FROM alat WHERE id_alat = '{$data['id_alat']}'
    ");
    $row = mysqli_fetch_assoc($cek);

    if($row['stok'] <= 0){
        echo "<script>alert('Stok alat habis!');</script>";
    } else {

        $insert = $peminjamanModel->addPeminjaman($data);

        if ($insert) {

            // kurangi stok
            mysqli_query($peminjamanModel->conn, "
                UPDATE alat SET stok = stok - 1 
                WHERE id_alat = '{$data['id_alat']}'
            ");

            echo "<script>
                    alert('Data peminjaman berhasil ditambahkan');
                    window.location='data_peminjaman.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Gagal menambahkan data');</script>";
        }
    }
}
?>

<?php include '../../layouts/header.php'; ?>
<?php include '../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2>Tambah Peminjaman</h2>
</div>

<div class="container">

<form method="POST" class="form-box">

    <!-- USER -->
    <label>User</label>
    <select name="id_user" required>
        <option value="">-- Pilih User --</option>
        <?php foreach($users as $u): ?>
            <option value="<?= $u['id_user'] ?>">
                <?= $u['nama'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- ALAT -->
    <label>Alat</label>
    <select name="id_alat" required>
        <option value="">-- Pilih Alat --</option>
        <?php foreach($alats as $a): ?>
            <option value="<?= $a['id_alat'] ?>" <?= $a['stok'] <= 0 ? 'disabled' : '' ?>>
                <?= $a['nama_alat'] ?> (Stok: <?= $a['stok'] ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <!-- TANGGAL -->
    <label>Tanggal Pinjam</label>
    <input type="date" name="tgl_pinjam" required>

    <label>Tanggal Kembali</label>
    <input type="date" name="tgl_kembali" required>

    <!-- STATUS -->
    <label>Status</label>
    <select name="status" required>
        <option value="dipinjam">Dipinjam</option>
        <option value="dikembalikan">Dikembalikan</option>
    </select>

    <!-- BUTTON -->
    <div class="btn-group">
        <button type="submit">Tambah</button>
        <a href="data_peminjaman.php">Batal</a>
    </div>

</form>

</div>

<?php include '../../layouts/footer.php'; ?>

<style>
.container{
    padding:20px;
}

.form-box{
    background:#fff;
    max-width:500px;
    margin:auto;
    padding:25px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.form-box label{
    font-weight:bold;
    display:block;
    margin-top:15px;
}

.form-box input,
.form-box select{
    width:100%;
    padding:10px;
    margin-top:5px;
    border:1px solid #ccc;
    border-radius:6px;
}

.btn-group{
    margin-top:20px;
    display:flex;
    gap:10px;
}

.btn-group button{
    flex:1;
    background:#1e3c72;
    color:white;
    padding:10px;
    border:none;
    border-radius:8px;
}

.btn-group a{
    flex:1;
    text-align:center;
    background:#6c757d;
    color:white;
    padding:10px;
    border-radius:8px;
    text-decoration:none;
}
</style>