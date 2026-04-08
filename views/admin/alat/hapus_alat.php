<?php
include_once __DIR__ . '/../../../controllers/c_alat.php';

$controller = new c_alat();

$controller->delete($_GET['id']);

header("Location: tampil_data_alat.php");
