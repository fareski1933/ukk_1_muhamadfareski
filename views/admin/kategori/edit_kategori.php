<?php
include_once __DIR__ . '/../../../controllers/c_kategori.php';

$controller = new c_kategori();

$data = $controller->show($_GET['id']);
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){
    $controller->update();
    header("Location: tampil_data_kategori.php");
}
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>
<?php include __DIR__ . '/../../layouts/sidebar.php'; ?>

<style>

/* WRAPPER KONTEN */
.form-wrapper{
    margin-left:220px;
    padding:30px;
}

/* BOX FORM */
.form-box{
    background:white;
    padding:30px;
    width:400px;
    border-radius:14px;
    box-shadow:0 6px 20px rgba(0,0,0,0.1);
    margin:auto;
    margin-top:30px;
    animation:fadeIn .4s ease-in-out;
}

/* JUDUL */
.form-box h2{
    text-align:center;
    margin-bottom:20px;
    color:#1e3c72;
}

/* LABEL */
label{
    font-weight:500;
}

/* INPUT */
input[type="text"]{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ddd;
    margin-top:6px;
    margin-bottom:16px;
    font-size:14px;
}

input:focus{
    outline:none;
    border-color:#1e3c72;
    box-shadow:0 0 5px rgba(30,60,114,.3);
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:linear-gradient(90deg,#1e3c72,#2a5298);
    color:white;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    transform:scale(1.03);
    opacity:.9;
}

/* LINK KEMBALI */
.btn-kembali{
    display:block;
    text-align:center;
    margin-top:18px;
    text-decoration:none;
    font-weight:500;
    color:white;
    background:#e74c3c;
    padding:10px;
    border-radius:8px;
}

.btn-kembali:hover{
    background:#c0392b;
}

/* ANIMASI */
@keyframes fadeIn{
    from{opacity:0; transform:translateY(10px);}
    to{opacity:1; transform:translateY(0);}
}

</style>

<!-- HEADER PAGE -->
<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2 style="display:inline;">Edit Kategori</h2>
</div>

<!-- FORM -->
<div class="form-wrapper">
    <div class="form-box">

        <h2>Edit Kategori</h2>

        <form method="POST">
            <input type="hidden" name="id_kategori" 
                   value="<?= $row['id_kategori'] ?>">

            <label>Nama Kategori</label>
            <input type="text" 
                   name="nama_kategori" 
                   value="<?= $row['nama_kategori'] ?>" 
                   required>

            <button type="submit" name="update">Update</button>
        </form>

        <a href="tampil_data_kategori.php" class="btn-kembali">Kembali</a>

    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
