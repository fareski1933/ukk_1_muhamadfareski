<?php
include_once __DIR__ . '/m_koneksi1.php';

class m_kategori1 {
  
  private $koneksi;
  
  public function __construct() {
    $db = new m_koneksi();
    $this->koneksi = $db->koneksi;
  }
  
  public function getAll() {
    $sql = "SELECT * FROM kategori ORDER BY id_kategori ASC";
    return mysqli_query($this->koneksi, $sql);
  }
}

