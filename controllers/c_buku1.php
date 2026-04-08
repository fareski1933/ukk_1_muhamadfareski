<?php
include_once __DIR__ . '/../models/m_buku1.php';

class c_buku1 {
  
  public $model;
  
  public function __construct(){
    $this->model = new m_buku1();
  }
  
  public function index() {
    return $this->model->getAll();
  }
}