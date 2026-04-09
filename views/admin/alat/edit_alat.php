<?php
// edit_alat.php
include_once __DIR__ . '/../../../controllers/c_alat.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = new c_alat();

// 1. Jalankan update jika tombol ditekan
if (isset($_POST['update'])) {
    $controller->update();
}

// 2. Ambil data alat untuk ditampilkan di form (setelah kemungkinan update)
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$data = $controller->show($id);
$row = ($data) ? mysqli_fetch_assoc($data) : null;

if (!$row) {
    header("Location: tampil_data_alat.php");
    exit;
}
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2>Edit Alat</h2>
</div>

<div class="container">
    <div class="form-card">
        <form method="POST" action="">
            <h2>Edit Detail Alat</h2>

            <input type="hidden" name="id_alat" value="<?= htmlspecialchars($row['id_alat']); ?>">

            <label>Nama Alat</label>
            <input type="text" name="nama_alat" value="<?= htmlspecialchars($row['nama_alat']); ?>" required>

            <label>ID Kategori</label>
            <input type="number" name="id_kategori" value="<?= htmlspecialchars($row['id_kategori']); ?>" required>

            <label>Stok</label>
            <input type="number" name="stok" value="<?= htmlspecialchars($row['stok']); ?>" required>

            <label>Kondisi</label>
            <select name="kondisi">
                <option value="Baik" <?= ($row['kondisi']=='Baik') ? 'selected' : ''; ?>>Baik</option>
                <option value="Rusak" <?= ($row['kondisi']=='Rusak') ? 'selected' : ''; ?>>Rusak</option>
            </select>

            <label>Status</label>
            <select name="status">
                <option value="Tersedia" <?= ($row['status']=='Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                <option value="Dipinjam" <?= ($row['status']=='Dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
                <option value="Tidak Tersedia" <?= ($row['status']=='Tidak Tersedia') ? 'selected' : ''; ?>>Tidak Tersedia</option>
            </select>

            <div class="form-buttons">
                <button type="submit" name="update">Update</button>
                <a href="tampil_data_alat.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>

<style>
.container { margin-left: 250px; padding: 20px; }
.form-card { background: white; padding: 30px; max-width: 500px; margin: 40px auto; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.form-card label { display: block; margin-top: 15px; font-weight: 600; }
.form-card input, .form-card select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px; }
.form-buttons { margin-top: 20px; display: flex; gap: 10px; }
.form-buttons button { flex: 1; background: #1E3A8A; color: white; padding: 10px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
.form-buttons button:hover { background: #162d6b; }
.btn-cancel { flex: 1; text-align: center; background: #6c757d; color: white; padding: 10px; border-radius: 6px; text-decoration: none; font-weight: bold; }
@media (max-width: 768px) { .container { margin-left: 0; } }
</style>