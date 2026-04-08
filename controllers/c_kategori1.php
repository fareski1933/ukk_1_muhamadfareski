<?php
include_once __DIR__ . '/../models/m_kategori1.php';

class c_kategori1 {
  
  private $model;
  
  public function __construct() {
    $this->model = new m_kategori1();
  }
  
  public function index() {
    return $this->model->getAll();
  }
}