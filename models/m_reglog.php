<?php
include_once 'm_koneksi.php';

class m_reglog
{
    // ================= REGISTRASI =================
    function registrasi($nama, $email, $no_tlp, $password)
    {
        $conn = new m_koneksi();

        // 🔥 Set default role = 'peminjam'
        $role = 'peminjam';

        $sql = "INSERT INTO users 
                (nama, email, no_tlp, password, role)
                VALUES 
                ('$nama', '$email', '$no_tlp', '$password', '$role')";

        $query = mysqli_query($conn->koneksi, $sql);

        if (!$query) {
            die(mysqli_error($conn->koneksi));
        }

        return $query;
    }

    // ================= LOGIN =================
    function login($email, $password)
    {
        $conn = new m_koneksi();

        $sql   = "SELECT id_user, nama, email, password, role 
                  FROM users 
                  WHERE email = '$email'";

        $query = mysqli_query($conn->koneksi, $sql);

        if (!$query) {
            die(mysqli_error($conn->koneksi));
        }

        $data = mysqli_fetch_assoc($query);

        // cek password
        if ($data && password_verify($password, $data['password'])) {
            return $data;
        }

        return false;
    }
}