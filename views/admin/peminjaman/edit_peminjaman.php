<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../../controllers/c_peminjaman.php';
include_once __DIR__ . '/../../../models/m_user.php';
include_once __DIR__ . '/../../../models/m_alat.php';

$controller = new c_peminjaman();
$userModel  = new m_user();
$alatModel  = new m_alat();

// ================= AMBIL ID =================
if (!isset($_GET['id'])) {
    header("Location: data_peminjaman.php");
    exit;
}

$id = $_GET['id'];
$data = $controller->show($id);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// ================= AMBIL DATA DROPDOWN =================
$users = mysqli_fetch_all($userModel->getAll(), MYSQLI_ASSOC);
$alats = mysqli_fetch_all($alatModel->getAll(), MYSQLI_ASSOC);

// ================= HANDLE UPDATE =================
if (isset($_POST['submit'])) {

    $status = strtolower($_POST['status']);

    $updateData = [
        'id_user' => $_POST['id_user'],
        'id_alat' => $_POST['id_alat'],
        'tgl_pinjam' => $_POST['tgl_pinjam'],
        'tgl_kembali' => $_POST['tgl_kembali'],
        'status' => $status
    ];

    // 👉 jika status dipinjam → isi tanggal persetujuan
    if($status == 'dipinjam'){
        $updateData['tgl_persetujuan'] = date('Y-m-d');
    }

    $controller->update($id, $updateData);

    header("Location: data_peminjaman.php");
    exit;
}
?>

<?php include '../../layouts/header.php'; ?>
<?php include '../../layouts/sidebar.php'; ?>

<div class="header">
    <h2>Edit Peminjaman</h2>
</div>

<div class="container">

<div class="form-box">

<form method="POST">

    <!-- USER -->
    <label>User</label>
    <select name="id_user" required>
        <?php foreach($users as $u): ?>
            <option value="<?= $u['id_user'] ?>" 
                <?= $u['id_user'] == $data['id_user'] ? 'selected' : '' ?>>
                <?= $u['nama'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- ALAT -->
    <label>Alat</label>
    <select name="id_alat" required>
        <?php foreach($alats as $a): ?>
            <option value="<?= $a['id_alat'] ?>"
                <?= $a['id_alat'] == $data['id_alat'] ? 'selected' : '' ?>>
                <?= $a['nama_alat'] ?> (Stok: <?= $a['stok'] ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <!-- TANGGAL -->
    <label>Tanggal Pinjam</label>
    <input type="date" name="tgl_pinjam" value="<?= $data['tgl_pinjam'] ?>" required>

    <label>Tanggal Kembali</label>
    <input type="date" name="tgl_kembali" value="<?= $data['tgl_kembali'] ?>" required>

    <!-- STATUS -->
    <label>Status</label>
    <select name="status" required>
        <option value="menunggu" <?= $data['status']=='menunggu'?'selected':'' ?>>Menunggu</option>
        <option value="dipinjam" <?= $data['status']=='dipinjam'?'selected':'' ?>>Dipinjam</option>
        <option value="ditolak" <?= $data['status']=='ditolak'?'selected':'' ?>>Ditolak</option>
        <option value="dikembalikan" <?= $data['status']=='dikembalikan'?'selected':'' ?>>Dikembalikan</option>
    </select>

    <!-- BUTTON -->
    <div class="btn-group">
        <button type="submit" name="submit">Simpan</button>
        <a href="data_peminjaman.php">Kembali</a>
    </div>

</form>

</div>
</div>

<?php include '../../layouts/footer.php'; ?>

<style>
.container{
    padding:20px;
}

.form-box{
    background:#fff;
    padding:25px;
    border-radius:10px;
    max-width:500px;
    margin:40px auto;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.form-box label{
    font-weight:bold;
    margin-top:10px;
    display:block;
}

.form-box input,
.form-box select{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:6px;
}

.btn-group{
    display:flex;
    gap:10px;
}

.btn-group button{
    flex:1;
    background:#1e3c72;
    color:white;
    border:none;
    padding:10px;
    border-radius:6px;
}

.btn-group a{
    flex:1;
    text-align:center;
    background:#6c757d;
    color:white;
    padding:10px;
    border-radius:6px;
    text-decoration:none;
}
</style>