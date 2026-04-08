<?php
// Mulai session
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// Hanya admin
if(!isset($_SESSION['role']) || $_SESSION['role'] !== "admin"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../../controllers/c_kategori.php';
$controller = new c_kategori();

if(isset($_POST['simpan'])){
    $controller->store();
    exit;
}
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2 style="display:inline;">Tambah Kategori</h2>
</div>

<div class="form-wrapper">
    <div class="form-box">

        <h2>Tambah Kategori</h2>

        <!-- Tampilkan pesan error -->
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert error"><?= $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form method="POST">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" required>
            <button type="submit" name="simpan">Simpan</button>
        </form>

        <a href="tampil_data_kategori.php" class="btn-kembali">Kembali</a>

    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>

<style>
.form-wrapper{margin-left:220px; padding:30px;}
.form-box{background:white;padding:30px;width:400px;border-radius:14px;margin:auto;margin-top:30px;box-shadow:0 6px 20px rgba(0,0,0,0.1);}
.form-box h2{text-align:center;margin-bottom:20px;color:#1e3c72;}
label{font-weight:500;}
input[type="text"]{width:100%;padding:12px;border-radius:8px;border:1px solid #ddd;margin-top:6px;margin-bottom:16px;font-size:14px;}
input:focus{outline:none;border-color:#1e3c72;box-shadow:0 0 5px rgba(30,60,114,.3);}
button{width:100%;padding:12px;border:none;border-radius:8px;background:linear-gradient(90deg,#1e3c72,#2a5298);color:white;font-weight:600;cursor:pointer;transition:.3s;}
button:hover{transform:scale(1.03);opacity:.9;}
.btn-kembali{display:block;text-align:center;margin-top:18px;text-decoration:none;font-weight:500;color:white;background:#e74c3c;padding:10px;border-radius:8px;}
.btn-kembali:hover{background:#c0392b;}
.alert.error{background:#e74c3c;color:white;padding:10px;margin-bottom:10px;border-radius:6px;}
</style>