<?php
class m_koneksi {
  private $host = "127.0.0.1",
  $username = "root",
  $pass ="root",
  $db = "perpustakaan";
  
  public $koneksi;
  
  function __construct() {
    $this->koneksi = mysqli_connect($this->host, $this->username, $this->pass, $this->db,3306);
    
    if ($this->koneksi) {
      $this->koneksi;
    } else{
      die ("koneksi ke database gagal" . mysqli_connect_error());
    }
  }
}

$conn = new m_koneksi();
?>