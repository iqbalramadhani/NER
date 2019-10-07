<?php
include('koneksi.php');

class Crud extends Koneksi
{
  function __construct()
  {
    parent::__construct();
  }

  public function read_data($table, $id, $id_value)
  {
    $query = "SELECT * FROM $table";
    if ($id != null) {
      $query .= " WHERE $id='" . $id_value . "'";
    }
    $hasil = $this->conn->query($query);
    if (!$hasil)
      return "Terjadi Kesalahan";

    $rows = array();
    while ($row = $hasil->fetch_assoc()) {
      $rows[] = $row;
    }
    return $rows;
  }

  public function simpan($tabel, $data)
  {
    $colomns = implode(", ", array_keys($data));
    // die(print_r($colomns));
    // $escape_value = mysql_real_escape_string(array_values($data));
    // die(print_r($escape_value));
    $isi = [];
    foreach (array_values($data) as $idx => $data) $isi[$idx] = "'" . $data . "'";
    $values = implode(", ", $isi);
    $query = "INSERT INTO $tabel ($colomns) VALUES ($values)";
    $hasil = $this->conn->query($query);
    if ($hasil)
      return true;
    else
      return false;
  }

  public function update($tabel, $data, $id, $id_value)
  {
    $query = "UPDATE $tabel SET ";
    $query .= implode(', ', $data);
    $query .= " WHERE $id = '" . $id_value . "'";

    $hasil = $this->conn->query($query);
    if ($hasil)
      return true;
    else
      return false;
  }

  public function delete($tabel, $id, $id_value)
  {
    $query = "DELETE FROM $tabel WHERE $id = '$id_value'";
    $hasil = $this->conn->query($query);
    if ($hasil)
      return true;
    else
      return false;
  }
}
