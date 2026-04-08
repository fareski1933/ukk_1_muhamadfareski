<?php 
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "peminjam"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../models/m_koneksi.php';
$conn = new m_koneksi();

$id_user = $_SESSION['id_user'];

// ================= DATA DASHBOARD =================
$total = mysqli_fetch_assoc(mysqli_query($conn->koneksi, "
    SELECT COUNT(*) as total 
    FROM peminjaman 
    WHERE id_user = '$id_user'
"))['total'];

$menunggu = mysqli_fetch_assoc(mysqli_query($conn->koneksi, "
    SELECT COUNT(*) as total 
    FROM peminjaman 
    WHERE id_user = '$id_user' AND status='menunggu'
"))['total'];

$dipinjam = mysqli_fetch_assoc(mysqli_query($conn->koneksi, "
    SELECT COUNT(*) as total 
    FROM peminjaman 
    WHERE id_user = '$id_user' AND status='dipinjam'
"))['total'];

$ditolak = mysqli_fetch_assoc(mysqli_query($conn->koneksi, "
    SELECT COUNT(*) as total 
    FROM peminjaman 
    WHERE id_user = '$id_user' AND status='ditolak'
"))['total'];

$dikembalikan = mysqli_fetch_assoc(mysqli_query($conn->koneksi, "
    SELECT COUNT(*) as total 
    FROM peminjaman 
    WHERE id_user = '$id_user' AND status='dikembalikan'
"))['total'];

// ================= NOTIF =================
$notif = mysqli_query($conn->koneksi, "
    SELECT * FROM notifikasi 
    WHERE id_user='$id_user' AND status='baru'
    ORDER BY id_notif DESC
");
?>

<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/sidebar.php'; ?>

<!-- HEADER -->
<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2>Dashboard Peminjam</h2>
    <span class="user-text">
        Halo <?= htmlspecialchars($_SESSION['nama']); ?> (<?= htmlspecialchars($_SESSION['role']); ?>)
    </span>
</div>

<!-- ================= POPUP NOTIF ================= -->
<?php if(mysqli_num_rows($notif) > 0): ?>
<div id="notifPopup" class="notif-overlay">
    <div class="notif-popup">
        <div class="notif-icon">✔</div>
        <div class="notif-text">
            <?php while($n = mysqli_fetch_assoc($notif)): ?>
                <p><?= htmlspecialchars($n['pesan']); ?></p>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
// tandai notif sudah dibaca
mysqli_query($conn->koneksi, "
    UPDATE notifikasi 
    SET status='dibaca' 
    WHERE id_user='$id_user'
");
?>

<!-- DASHBOARD -->
<div class="dashboard-wrapper">
    <div class="card-container">
        <div class="card">
            <h4>Total</h4>
            <p><?= $total ?></p>
        </div>

        <div class="card">
            <h4>Menunggu</h4>
            <p><?= $menunggu ?></p>
        </div>

        <div class="card">
            <h4>Dipinjam</h4>
            <p><?= $dipinjam ?></p>
        </div>

        <div class="card">
            <h4>Ditolak</h4>
            <p><?= $ditolak ?></p>
        </div>

        <div class="card">
            <h4>Dikembalikan</h4>
            <p><?= $dikembalikan ?></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<!-- ================= CSS ================= -->
<style>
/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px;
    background:#1E3A8A;
    color:#fff;
}

.header h2{
    margin:0;
    flex-grow:1;
    text-align:center;
}

.user-text{
    font-size:14px;
}

.menu-btn{
    cursor:pointer;
    font-size:22px;
}

/* WRAPPER */
.dashboard-wrapper{
    margin-left:220px;
    padding:25px;
    display:flex;
    justify-content:center;
}

/* GRID */
.card-container{
    width:100%;
    max-width:1000px;
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap:20px;
}

/* CARD */
.card{
    background:white;
    padding:25px;
    border-radius:14px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    text-align:center;
    transition:.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h4{
    margin:0;
    font-size:15px;
    color:#666;
}

.card p{
    font-size:26px;
    font-weight:bold;
    color:#2a5298;
}

/* ================= NOTIF POPUP ================= */
.notif-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.4);
    display:flex;
    justify-content:center;
    align-items:center;
    z-index:9999;
}

.notif-popup{
    background:#fff;
    padding:25px 30px;
    border-radius:20px;
    text-align:center;
    width:300px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    animation:zoomIn 0.3s ease;
}

.notif-icon{
    width:50px;
    height:50px;
    background:#4CAF50;
    color:white;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    margin:0 auto 15px;
}

.notif-text p{
    margin:5px 0;
    font-size:14px;
}

/* ANIMASI */
@keyframes zoomIn{
    from{
        transform:scale(0.7);
        opacity:0;
    }
    to{
        transform:scale(1);
        opacity:1;
    }
}
</style>

<!-- ================= JS ================= -->
<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("hide");
}

setTimeout(()=>{
    let notif = document.getElementById("notifPopup");
    if(notif){
        notif.style.opacity = "0";
        setTimeout(()=>notif.remove(), 300);
    }
},3000);
</script>