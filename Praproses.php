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

  function asci()
  { }
}
