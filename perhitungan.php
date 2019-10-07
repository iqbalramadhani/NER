<?php

class Perhitungan
{
  private $baru = [];
  private $data;
  public function rata_rata($a, $no)
  {
    return $a / ($no - 1);
  }

  public function std($X, $c, $a, $no)
  {
    return sqrt(($no * $X[1][$c] - pow($a, 2)) / ($no * ($no - 1)));
  }

  public function smote($balance, $N)
  {
    // die(print_r(count($balance)));
    $jml = count($balance);
    for ($i = 0; $i < $jml; $i++) {
      $N1 = $N / 100;
      // die(print_r($N));
      $obser = array();
      $max = 0;

      for ($j = 0; $j < $jml; $j++) {
        if ($j == $i) {
          $obser[$j] = 0;
          continue;
        } else {
          $h = 0;
          for ($k = 2; $k < 22; $k++) {
            $h += pow($balance[$i][$k] - $balance[$j][$k], 2);
          }
          $obser[$j] = sqrt($h);
          if ($j > 0) {
            if ($obser[$j - 1] < $obser[$j])
              $max = $j;
          }
        }
      }

      while ($N1 <> 1) {
        $this->baru[0] = '-';
        $this->baru[1] = '-';
        for ($j = 2; $j <= 22; $j++) {
          $gap = mt_rand() / mt_getrandmax();
          $this->baru[$j] = $balance[$i][$j] + ($balance[$max][$j] - $balance[$i][$j]) * $gap;
        }
        $this->baru[23] = 1;
        array_push($balance, $this->baru);
        $N1--;
        // echo 'nilai' . $N1;
      }
    }

    return $balance;
  }

  public function person($xb)
  {
    for ($i = 0; $i < 21; $i++) {
      $this->data[$i] = $xb[4][$i] / sqrt($xb[3][$i] * $xb[3][21]);
    }
    return $this->data;
  }

  public function knn($k, $dl, $dt)
  {
    $kelas = array();
    for ($t = 0; $t < count($dt); $t++) {
      for ($i = 0; $i < count($dl); $i++) {
        $h = 0;
        for ($j = 0; $j < 17; $j++) {
          $h += pow($dl[$i][$j] - $dt[$t][$j], 2);
        }
        $this->data[$i] = sqrt($h);
      }

      // $kk = array();
      $br = 0;
      $tb = 0;
      asort($this->data);
      for ($l = 0; $l < $k; $l++) {
        $k1 =  array_search(reset($this->data), ($this->data));
        unset($this->data[$k1]);
        if ($dl[$k1][17] == '0')
          $tb++;
        else
          $br++;
      }
      if ($tb > $br)
        $kelas[$t] = 0;
      else
        $kelas[$t] = 1;

      // echo 'coba';
    }

    return $kelas;
  }

  public function sigmoid($e, $d, $X, $l, $f)
  {
    return (1 - pow($e, -(($d[$l[$f - 2]] - $X[2][0]) / $X[3][0]))) / (1 + pow($e, -(($d[$l[$f - 2]] - $X[2][0]) / $X[3][0])));
  }
}
