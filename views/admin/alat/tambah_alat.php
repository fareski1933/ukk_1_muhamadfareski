<?php
// tambah_alat.php - versi final aman AUTO_INCREMENT

include_once __DIR__ . '/../../../controllers/c_alat.php';

// Mulai session jika belum
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Buat instance controller
$controller = new c_alat();

// Jalankan store kalau form disubmit
$controller->store();
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2 style="display:inline;">Tambah Alat</h2>
</div>

<div class="container">

    <div class="form-card">

        <form method="POST">

            <h2>Tambah Alat</h2>

            <label>Nama Alat</label>
            <input type="text" name="nama_alat" required>

            <label>ID Kategori</label>
            <input type="number" name="id_kategori" required>

            <label>Stok</label>
            <input type="number" name="stok" required>

            <label>Kondisi</label>
            <select name="kondisi" required>
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
            </select>

            <label>Status</label>
            <select name="status" required>
                <option value="">-- Pilih Status --</option>
                <option value="Tersedia">Tersedia</option>
                <option value="Dipinjam">Dipinjam</option>
                <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>

            <div class="form-buttons">
                <button type="submit" name="simpan">Simpan</button>
                <a href="tampil_data_alat.php" class="btn-cancel">Batal</a>
            </div>

        </form>

    </div>

</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>

<style>

/* container biar gak ketiban sidebar */
.container{
    margin-left:250px;
    padding:20px;
}

/* card form */
.form-card{
    background:white;
    padding:30px;
    max-width:500px;
    margin:40px auto;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* label */
.form-card label{
    display:block;
    margin-top:15px;
    font-weight:600;
}

/* input */
.form-card input,
.form-card select{
    width:100%;
    padding:10px;
    margin-top:5px;
    border:1px solid #ccc;
    border-radius:6px;
}

/* tombol */
.form-buttons{
    margin-top:20px;
    display:flex;
    gap:10px;
}

.form-buttons button{
    flex:1;
    background:#1E3A8A;
    color:white;
    padding:10px;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.form-buttons button:hover{
    background:#162d6b;
}

.btn-cancel{
    flex:1;
    text-align:center;
    background:#6c757d;
    color:white;
    padding:10px;
    border-radius:6px;
    text-decoration:none;
}

/* responsive */
@media (max-width:768px){
    .container{
        margin-left:0;
    }
}

</style>