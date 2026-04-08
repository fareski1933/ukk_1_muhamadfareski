<?php
// Pastikan session hanya dijalankan sekali
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['role']) || $_SESSION['role'] != "peminjam"){
    header("Location: ../index.php");
    exit;
}

include_once __DIR__ . '/../../controllers/c_peminjam.php';
$controller = new c_peminjam();
$alat = $controller->getAlatPeminjam();

// ================= NOTIF =================
$notif = "";
if(isset($_SESSION['notif_pinjam'])){
    $notif = $_SESSION['notif_pinjam'];
    unset($_SESSION['notif_pinjam']);
}
?>

<?php include __DIR__ . '../../layouts/header.php'; ?>
<?php include __DIR__ . '../../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2>Daftar Alat Tersedia</h2>
</div>

<div class="container">
    <div class="alat-wrapper">

        <?php foreach($alat as $a): ?>
        <?php
            $namaFile = strtolower(str_replace(' ', '_', $a['nama_alat'])) . '.jpg';
            if(!file_exists(__DIR__ . '/../../assets/images/alat/' . $namaFile)){
                $namaFile = 'default.png';
            }

            $isTersedia = ($a['status'] == 'tersedia' && $a['stok'] > 0);
        ?>

        <div class="alat-card <?= !$isTersedia ? 'habis' : '' ?>">

            <div class="card-atas">
                <img src="../../assets/images/alat/<?= $namaFile ?>">
                <h3><?= $a['nama_alat'] ?></h3>
                <p>Stok: <?= $a['stok'] ?></p>
            </div>

            <div class="card-bawah">
                <button onclick="openModal(<?= $a['id_alat'] ?>)"
                    <?= !$isTersedia ? 'disabled' : '' ?>>
                    <?= $isTersedia ? 'Pinjam' : 'Tidak Tersedia' ?>
                </button>
            </div>

        </div>

        <?php endforeach; ?>

    </div>
</div>

<!-- ================= MODAL ================= -->
<div id="modalPinjam" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>

        <h3>Form Peminjaman</h3>

        <form action="../../controllers/c_peminjam.php?aksi=pinjam" method="POST">
            <input type="hidden" name="id_alat" id="id_alat">

            <label>Tanggal Pinjam</label>
            <input type="date" name="tgl_pinjam" required>

            <label>Tanggal Kembali</label>
            <input type="date" name="tgl_kembali" required>

            <!-- Tombol simpan diubah menjadi biru -->
            <button type="submit" class="btn-simpan">Pinjam</button>
        </form>
    </div>
</div>

<!-- ================= TOAST NOTIF ================= -->
<?php if($notif != ""): ?>
<div id="toastNotif" class="toast">
    <?= $notif ?>
</div>
<?php endif; ?>

<?php include __DIR__ . '../../layouts/footer.php'; ?>

<script>
// MODAL
function openModal(id){
    document.getElementById("modalPinjam").style.display = "flex";
    document.getElementById("id_alat").value = id;
}

function closeModal(){
    document.getElementById("modalPinjam").style.display = "none";
}

window.onclick = function(e){
    let modal = document.getElementById("modalPinjam");
    if(e.target == modal){
        modal.style.display = "none";
    }
}

// TOAST AUTO HILANG
setTimeout(() => {
    let toast = document.getElementById("toastNotif");
    if(toast){
        toast.style.opacity = "0";
        setTimeout(() => toast.remove(), 300);
    }
}, 3000);
</script>

<style>

/* HEADER */
.header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px 20px;
    background:#1e3c72;
    color:white;
    position:sticky;
    top:0;
    z-index:999;
}

/* GRID */
.alat-wrapper{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    padding:20px;
}

@media(max-width:768px){
    .alat-wrapper{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:500px){
    .alat-wrapper{
        grid-template-columns:1fr;
    }
}

/* CARD */
.alat-card{
    background:#fff;
    border-radius:15px;
    padding:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
    display:flex;
    flex-direction:column;
}

.card-bawah{
    margin-top:15px;
}

.alat-card img{
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:10px;
}

.alat-card button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:10px;
    background:linear-gradient(90deg,#1e3c72,#2a5298); /* tombol biru */
    color:white;
    cursor:pointer;
}

.alat-card button:disabled{
    background:#ccc;
    cursor:not-allowed;
}

.alat-card.habis{
    opacity:0.8;
    filter:grayscale(40%);
}

/* MODAL */
.modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.5);
    justify-content:center;
    align-items:center;
}

.modal-content{
    background:#fff;
    padding:25px;
    border-radius:20px;
    width:350px;
}

.modal-content input{
    width:100%;
    margin-top:10px;
    padding:10px;
    border-radius:10px;
    border:1px solid #ddd;
}

.close{
    float:right;
    cursor:pointer;
}

/* BUTTON SIMPAN FORM PINJAM */
.modal-content .btn-simpan{
    width:100%;
    margin-top:15px;
    padding:12px;
    border:none;
    border-radius:12px;
    background:linear-gradient(90deg,#1e3c72,#2a5298); /* biru */
    color:white;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.modal-content .btn-simpan:hover{
    opacity:0.9;
}

/* ================= TOAST ================= */
.toast{
    position:fixed;
    top:20px;
    right:20px;
    background:#28a745;
    color:white;
    padding:12px 20px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
    z-index:9999;
    font-weight:500;
    animation:slideIn 0.4s ease;
}

@keyframes slideIn{
    from{
        transform:translateX(100%);
        opacity:0;
    }
    to{
        transform:translateX(0);
        opacity:1;
    }
}

</style>