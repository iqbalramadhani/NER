<?php
include('koneksi.php');

class Emiten extends Koneksi
{
  function __construct()
  {
    parent::__construct();
  }

  public function data_emiten($table)
  {
    $query = "SELECT * FROM $table";
    $hasil = $this->conn->query($query);
    if (!$hasil)
      return "Terjadi Kesalahan";

    $rows = array();
    while ($row = $hasil->fetch_assoc()) {
      $rows[] = $row;
    }
    return $rows;
  }
}
