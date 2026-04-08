<?php 
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "petugas"){
    header("Location: ../../index.php");
    exit;
}

include_once __DIR__ . '/../../models/m_koneksi.php';
$conn = new m_koneksi();

// ================= DATA DASHBOARD =================
$total = mysqli_fetch_assoc(mysqli_query($conn->koneksi, "SELECT COUNT(*) as total FROM peminjaman"))['total'];

$menunggu = mysqli_fetch_assoc(mysqli_query($conn->koneksi, "SELECT COUNT(*) as total FROM peminjaman WHERE status='menunggu'"))['total'];

$dipinjam = mysqli_fetch_assoc(mysqli_query($conn->koneksi, "SELECT COUNT(*) as total FROM peminjaman WHERE status='dipinjam'"))['total'];

$ditolak = mysqli_fetch_assoc(mysqli_query($conn->koneksi, "SELECT COUNT(*) as total FROM peminjaman WHERE status='ditolak'"))['total'];
?>

<?php include __DIR__ . '../../layouts/header.php'; ?>
<?php include __DIR__ . '../../layouts/sidebar.php'; ?>

<!-- HEADER -->
<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2>Dashboard Petugas</h2>
    <span class="user-text">
        Halo <?= htmlspecialchars($_SESSION['nama']); ?> (<?= htmlspecialchars($_SESSION['role']); ?>)
    </span>
</div>

<!-- DASHBOARD -->
<div class="dashboard-wrapper">
    <div class="card-container">
        <div class="card">
            <h4>Total Peminjaman</h4>
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
    </div>
</div>

<?php include __DIR__ . '../../layouts/footer.php'; ?>

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

/* DASHBOARD WRAPPER */
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
    background:#fff;
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
</style>

<!-- ================= JS ================= -->
<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("hide");
}
</script>