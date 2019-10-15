<?php

class Svm
{

  function pelatihan($data, $kelas, $C, $tol, $max_pass)
  {
    $b = 0.0;
    $n = count($data);
    $alpha = array_fill(0, $n, 0);
    $pass = 0;
    while ($pass < $max_pass) {
      $ganti_alpha = 0;
      for ($i = 0; $i < $n; $i++) {
        $E1 = $this->f($alpha, $kelas, $b, $data, $data[$i]) - $kelas[$i];
        // echo $E1;
        if (($kelas[$i] * $E1 < -$tol && $alpha[$i] < $C) || ($kelas[$i] * $E1 > $tol && $alpha[$i] > 0)) {
          $j = $i;
          while ($j === $i)
            $j = rand(0, $n - 1);
          $E2 = $this->f($alpha, $kelas, $b, $data, $data[$j]) - $kelas[$j];
          $alphai_lama = $alpha[$i];
          $alphaj_lama = $alpha[$j];
          if ($kelas[$i] === $kelas[$j]) {
            $L = max(0, $alphai_lama + $alphaj_lama - $C);
            $H = min($C, $alphai_lama + $alphaj_lama);
          } else {
            $L = max(0, $alphaj_lama - $alphai_lama);
            $H = min($C, $C + $alphaj_lama - $alphai_lama);
          }
          if ($L == $H)
            continue;
          $eta = 2 * $this->kernelLinier($data[$i], $data[$j]) - $this->kernelLinier($data[$i], $data[$i]) - $this->kernelLinier($data[$j], $data[$j]);
          if ($eta >= 0)
            continue;
          $alphaj_baru = $alphaj_lama - (($kelas[$j] * ($E1 - $E2)) / $eta);
          if ($alphaj_baru > $H) {
            $alphaj_baru = $H;
          }
          if ($alphaj_baru < $L) {
            $alphaj_baru = $L;
          }
          if (abs($alphaj_baru - $alphaj_lama) < 1e-5) {
            continue;
          }
          $alpha[$j] = $alphaj_baru;
          $alphai_baru = $alphai_lama + $kelas[$i] * $kelas[$j] * ($alphaj_lama - $alphaj_baru);
          $alpha[$i] = $alphai_baru;
          // update the bias term
          $b1 = $b - $E1 - $kelas[$i] * ($alphai_baru - $alphai_lama) * $this->kernelLinier($data[$i], $data[$i]) - $kelas[$j] * ($alphaj_baru - $alphaj_lama) * $this->kernelLinier($data[$i], $data[$j]);
          $b2 = $b - $E2 - $kelas[$i] * ($alphai_baru - $alphai_lama) * $this->kernelLinier($data[$i], $data[$j]) - $kelas[$j] * ($alphaj_baru - $alphaj_lama) * $this->kernelLinier($data[$j], $data[$j]);
          $b = 0.5 * ($b1 + $b2);
          if ($alphai_baru > 0 && $alphai_baru < $C) {
            $b = $b1;
          }
          if ($alphaj_baru > 0 && $alphaj_baru < $C) {
            $b = $b2;
          }
          $ganti_alpha++;
        } //endif
      } //endfor
      $pass = ($ganti_alpha == 0) ? $pass + 1 : 0;
    } //endwhile
    return [$alpha, $b];
  }

  public function f($alpha, $kelas, $b, $data, $vektor)
  {
    $f = $b;
    for ($i = 0; $i < count($data); $i++) {
      $f += $alpha[$i] * $kelas[$i] * $this->kernelLinier($data[$i], $vektor);
    }
    return $f;
  }

  public function kernelLinier($v1, $v2)
  {
    $k = 0;
    for ($q = 0; $q < count($v1); $q++) {
      $k += $v1[$q] * $v2[$q];
    }
    return $k;
  }
}
