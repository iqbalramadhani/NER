<?php

class Praproses
{
  function kelas($label)
  {
    $isi = '';
    switch ($label) {
      case "ORGANIZATION":
        $isi = 1;
        break;
      case 'PERSON':
        $isi = 2;
        break;
      case 'QUANTITY':
        $isi = 3;
        break;
      case 'LOCATION':
        $isi = 4;
        break;
      case 'TIME':
        $isi = 5;
        break;
      case "OTHER":
        $isi = 6;
        break;
    }
    return $isi;
  }

  function token()
  {
    return;
  }

  function formatSvm($data1, $data2)
  {
    $kelas = array();
    $data = array();
    // echo '<br>';
    // echo '<br>';
    // print_r($kelas);
    // print_r($data);
    foreach ($data1 as $d1) {
      $d1[1] = -1;
      array_push($data, $d1[0]);
      array_push($kelas, $d1[1]);
    }
    foreach ($data2 as $d2) {
      $d2[1] = 1;
      array_push($data, $d2[0]);
      array_push($kelas, $d2[1]);
    }
    // echo '<br>';
    // echo '<br>';
    // print_r($kelas);
    // print_r($data);
    return [$data, $kelas];
  }

  function asci()
  { }
}
