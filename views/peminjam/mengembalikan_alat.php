<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "peminjam"){
    header("Location: ../index.php");
    exit;
}

include_once __DIR__ . '/../../controllers/c_pengembalian_user.php';
$controller = new c_pengembalian_user();
$data = $controller->index();
?>

<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/sidebar.php'; ?>

<div class="header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h2>Pengembalian Alat</h2>
</div>

<div class="container">
    <div class="table-wrapper">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alat</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Harus Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if(empty($data)): ?>
                    <tr>
                        <td colspan="6">Tidak ada data</td>
                    </tr>
                <?php else: ?>
                    <?php $no=1; foreach($data as $d): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nama_alat'] ?></td>
                        <td><?= $d['tgl_pinjam'] ?></td>
                        <td><?= $d['tgl_kembali'] ?></td>

                        <!-- STATUS -->
                        <td>
                            <?php
                            if($d['status'] == 'dipinjam'){
                                echo "<span style='color:green;font-weight:bold;'>Dipinjam</span>";
                            } elseif($d['status'] == 'menunggu'){
                                echo "<span style='color:orange;font-weight:bold;'>Menunggu</span>";
                            } elseif($d['status'] == 'ditolak'){
                                echo "<span style='color:red;font-weight:bold;'>Ditolak</span>";
                            }
                            ?>
                        </td>

                        <!-- AKSI -->
                        <td>
                        <?php if($d['status'] == 'dipinjam'): ?>
                            <!-- tombol buka modal -->
                            <button type="button" onclick="openModal('<?= $d['id_peminjaman'] ?>')">
                                Kembalikan
                            </button>

                        <?php elseif($d['status'] == 'ditolak'): ?>
                            <!-- tombol selesai -->
                            <form action="../../controllers/c_pengembalian_user.php?aksi=arsip" method="POST">
                                <input type="hidden" name="id_peminjaman" value="<?= $d['id_peminjaman'] ?>">
                                <button style="background:#6c757d;" onclick="return confirm('Hapus dari daftar?')">
                                    Selesai
                                </button>
                            </form>

                        <?php elseif($d['status'] == 'menunggu'): ?>
                            <span style="color:orange;">Menunggu persetujuan</span>
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>

    </div>
</div>

<!-- ================= MODAL ================= -->
<div id="modalKembali" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>

        <h3>Pengembalian Alat</h3>

        <form action="/ukk_1_muhamadfareski/controllers/c_pengembalian_user.php?aksi=kembalikan" method="POST">
            
            <input type="hidden" name="id_peminjaman" id="id_peminjaman">

            <label>Kondisi Alat</label>
            <select name="kondisi_kembali" onchange="setDenda(this.value)" required>
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
            </select>

            <label>Denda</label>
            <input type="number" name="denda" id="denda" value="0" readonly>

            <button type="submit">Kembalikan</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<style>
.header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    background:#1e3c72;
    color:white;
    padding:10px 20px;
}

.container{
    padding:20px;
}

.table-wrapper{
    background:#fff;
    padding:20px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

th{
    background:#1e3c72;
    color:#fff;
}

button{
    padding:8px 15px;
    border:none;
    border-radius:8px;
    background:#28a745;
    color:#fff;
    cursor:pointer;
}

button:hover{
    opacity:0.9;
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
    border-radius:15px;
    width:350px;
}

.modal-content input,
.modal-content select{
    width:100%;
    margin-top:10px;
    padding:10px;
}

.close{
    float:right;
    cursor:pointer;
}
</style>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("active");
}

// buka modal
function openModal(id){
    console.log("ID dikirim ke modal:", id); // debug ID
    document.getElementById("modalKembali").style.display = "flex";
    document.getElementById("id_peminjaman").value = id;
}

// tutup modal
function closeModal(){
    document.getElementById("modalKembali").style.display = "none";
}

// set denda otomatis
function setDenda(kondisi){
    let denda = document.getElementById("denda");

    if(kondisi === 'rusak'){
        denda.value = 50000;
    } else {
        denda.value = 0;
    }
}

// klik luar modal = tutup
window.onclick = function(e){
    let modal = document.getElementById("modalKembali");
    if(e.target == modal){
        modal.style.display = "none";
    }
}
</script>