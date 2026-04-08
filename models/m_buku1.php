<?php
include_once __DIR__ . '/m_koneksi1.php';

class m_buku1 {
  
  private $koneksi;
  
  public function __construct(){
    $db = new m_koneksi();
    $this->koneksi = $db->koneksi;
  }
  
  public function getAll() {
    $sql = "SELECT * FROM buku ORDER BY id_buku ASC";
    $result = mysqli_query($this->koneksi, $sql);

    if (!$result) {
        die("Query error: " . mysqli_error($this->koneksi));
    }

    return $result;
}
}