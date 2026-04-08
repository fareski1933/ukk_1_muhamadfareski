<?php
class m_koneksi{



    // membuat variable / properti

    // jenis jenis modifier / konsep enkapsulasi pada OOP
    // private
    // public
    // protected

    private $host = "localhost",
        $username = "root",
        $pass = "",
        $db = "ukk_1_muhamadfareski";

    public $koneksi;

    // membuat konstrak yang dimana fungsi ini akan dijalankan otomatis ketika membuat objek dari kelas koneksi
    function __construct() {
        // variable $this adalah sebuah variable khusus dalam oop php yang digunakan sebagai penunjuk kepada objek, ketika kita mengaksesnya dari dalam class
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->pass, $this->db);
        
        if ($this->koneksi) {
          $this->koneksi;
        } else {
            die("koneksi kedatabase gagal" . mysqli_connect_error());
        }
    }
}
// cara membuat variable objek
$conn = new m_koneksi();
?>