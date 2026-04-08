<?php
// ================= SESSION =================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ================= PROTEKSI =================
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../../controllers/c_pengembalian.php';

$controller = new c_pengembalian();
$id = intval($_GET['id'] ?? 0);

if(!$id){
    die("ID pengembalian tidak valid!");
}

$data = $controller->getById($id);

if(!$data){
    die("Data pengembalian tidak ditemukan!");
}
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2 style="display:inline;">Edit Pengembalian</h2>
</div>

<div class="container" style="min-height:80vh;">
<div class="form-card">

<form action="../../../controllers/c_pengembalian.php" method="POST">

<input type="hidden" name="id_pengembalian" value="<?= $data['id_pengembalian'] ?>">

<label>Tanggal Kembali</label>
<input type="date" name="tgl_dikembalikan" value="<?= $data['tgl_dikembalikan'] ?>" required>

<label>Kondisi</label>
<select name="kondisi_kembali" required>
    <option value="baik" <?= $data['kondisi_kembali']=='baik'?'selected':'' ?>>Baik</option>
    <option value="rusak" <?= $data['kondisi_kembali']=='rusak'?'selected':'' ?>>Rusak</option>
</select>

<label>Denda</label>
<input type="number" name="denda" value="<?= $data['denda'] ?>" required>

<div class="form-buttons">
    <button type="submit" name="update" class="btn-simpan">
        Update
    </button>

    <a href="data_pengembalian.php" class="btn-batal">
        Batal
    </a>
</div>

</form>
</div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>

<style>
.form-card{
    background:white;
    padding:30px;
    max-width:500px;
    margin:40px auto;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.form-card label{
    font-weight:600;
    display:block;
    margin-top:15px;
    margin-bottom:5px;
}

.form-card input, .form-card select{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:14px;
}

.form-card input:focus, .form-card select:focus{
    border-color:#1E3A8A;
    outline:none;
}

.form-buttons{
    margin-top:25px;
    display:flex;
    gap:10px;
}

.btn-simpan{
    background:#1E3A8A;
    color:white;
    padding:10px 18px;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.btn-simpan:hover{
    background:#162d6b;
}

.btn-batal{
    background:#6c757d;
    color:white;
    padding:10px 18px;
    border-radius:6px;
    text-decoration:none;
}

.btn-batal:hover{
    background:#545b62;
}
</style>