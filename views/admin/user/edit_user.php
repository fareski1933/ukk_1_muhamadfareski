<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

include_once __DIR__ . '/../../../controllers/c_user.php';

$controller = new c_user();

// === HANDLE AKSI TERLEBIH DAHULU ===
$controller->handleAksi();

// === AMBIL DATA USER BERDASARKAN ID ===
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $data = $controller->model->getById($id);
    $user = mysqli_fetch_assoc($data);
    if(!$user){
        // jika ID tidak ditemukan
        header("Location: http://localhost/ukk_1_muhamadfareski/views/admin/user/data_user.php");
        exit;
    }
}else{
    header("Location: http://localhost/ukk_1_muhamadfareski/views/admin/user/data_user.php");
    exit;
}

// === BASE URL UNTUK LINK ===
$base_url = "http://localhost/ukk_1_muhamadfareski/";
?>

<?php include '../../layouts/header.php'; ?>
<?php include '../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2 style="display:inline;">Edit User</h2>
</div>

<div class="container" style="min-height:80vh;">
    <div class="form-card">
        <!-- FORM MENGIRIM POST KE ?aksi=edit_role -->
        <form method="POST" action="?aksi=edit_role">
            <input type="hidden" name="id_user" value="<?= htmlspecialchars($user['id_user']) ?>">

            <label>Role</label>
            <select name="role" required>
                <option value="admin" <?= $user['role']=="admin"?'selected':'' ?>>Admin</option>
                <option value="petugas" <?= $user['role']=="petugas"?'selected':'' ?>>Petugas</option>
                <option value="peminjam" <?= $user['role']=="peminjam"?'selected':'' ?>>Peminjam</option>
            </select>

            <div class="form-buttons">
                <button type="submit" class="btn-simpan">Update Role</button>
                <a href="<?= $base_url ?>views/admin/user/data_user.php" class="btn-batal">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include '../../layouts/footer.php'; ?>

<style>
/* CSS sama seperti semula */
.container{ padding-top:30px; }
.form-card{ max-width:400px; margin:auto; background:white; padding:30px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.15); }
.form-card label{ font-weight:bold; display:block; margin-bottom:8px; }
.form-card select{ width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; margin-bottom:20px; }
.form-card select:focus{ border-color:#1E3A8A; outline:none; }
.form-buttons{ display:flex; gap:10px; }
.btn-simpan{ flex:1; padding:10px; background:#1E3A8A; color:white; border:none; border-radius:6px; font-weight:bold; cursor:pointer; }
.btn-simpan:hover{ background:#162d6b; }
.btn-batal{ flex:1; text-align:center; padding:10px; background:#6c757d; color:white; border-radius:6px; text-decoration:none; font-weight:bold; }
.btn-batal:hover{ background:#545b62; }
</style>