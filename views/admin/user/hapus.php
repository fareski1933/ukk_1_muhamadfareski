<?php
include_once __DIR__ . '/../../../controllers/c_user.php';

$controller = new c_user();

if(isset($_GET['id'])){
    $controller->destroy($_GET['id']);
}

<a href="hapus_user.php?id=<?= $row['id_user'] ?>" 
   onclick="return confirm('Yakin mau hapus?')">
   Hapus
</a>
