<?php
session_start();
include_once '../models/m_reglog.php';

$login = new m_reglog();

if (!isset($_GET['aksi'])) {
    header("Location: ../index.php");
    exit;
}

$aksi = $_GET['aksi'];

// login
if ($aksi === 'login') {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    $data = $login->login($email, $password);

    if ($data) {

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama']    = $data['nama'];
        $_SESSION['role']    = $data['role'];

        // multi role
        if ($data['role'] == 'admin') {
            header("Location: ../views/admin/dashboard.php");
        } 
        elseif ($data['role'] == 'petugas') {
            header("Location: ../views/petugas/dashboard_petugas.php");
        } 
        elseif ($data['role'] == 'peminjam') {
            header("Location: ../views/peminjam/dashboard_peminjam.php");
        } 
        else {
            session_destroy();
            header("Location: ../index.php");
        }

        exit;

    } else {
        echo "<script>
                alert('Email atau password salah');
                window.location='../index.php';
              </script>";
    }
}

// registrasi
elseif ($aksi === 'registrasi') {

    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $no_tlp   = $_POST['no_tlp'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $result = $login->registrasi($nama, $email, $no_tlp, $password);

    if ($result) {
        echo "<script>
                alert('Registrasi berhasil');
                window.location='../index.php';
              </script>";
    } else {
        echo "<script>
                alert('Registrasi gagal');
                window.location='../registrasi.php';
              </script>";
    }
}