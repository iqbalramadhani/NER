<?php
use function GuzzleHttp\json_encode;

// include('../emiten.php');
include('../rasio.php');
include('../perhitungan.php');
$rasio = new Rasio();
$uji = new Perhitungan();
// $emiten = new Emiten();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perhitungan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" media="screen" href="../assets/dataTable/dataTables.bootstrap4.min.css">
</head>

<body>
  <div class="container">

    <section class="mt-5 p-5">
      <h3 class="text-center">Proses Normalisasi dengan SIGMOID</h3>
      <h5 class="mt-5">Data Awal</h5>
      <div class="table-responsive">
        <table class="table example table-hover table-bordered">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Kode Emiten</th>
              <th>Tahun</th>
              <th>X1</th>
              <th>X2</th>
              <th>X3</th>
              <th>X4</th>
              <th>X5</th>
              <th>X6</th>
              <th>X7</th>
              <th>X8</th>
              <th>X9</th>
              <th>X10</th>
              <th>X11</th>
              <th>X12</th>
              <th>X13</th>
              <th>X14</th>
              <th>X15</th>
              <th>X16</th>
              <th>X17</th>
              <th>X18</th>
              <th>X19</th>
              <th>X20</th>
              <th>X21</th>
              <th>Y1</th>
              <th>Y2</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $l = [
              'current_ratio',
              'quict_ratio',
              'cash_ratio',
              'debt_ratio',
              'debt_equity_ratio',
              'long_term_dept_equity_ratio',
              'gross_profit',
              'net_profit_margin',
              'ep_total_investment',
              'roe',
              'roa',
              'roi',
              'roce',
              'opm',
              'asset_turnover',
              'receivable_turnover',
              'fix_asset_turnover',
              'inventory_turnover',
              'averange_days_inventory',
              'days_sales_outstanding',
              'dividen_yield'
            ];
            $X = array(array());
            $m = 0;
            foreach ($l as $a) {
              $X[0][$m] = 0;
              $X[1][$m] = 0;
              // $X[1][$m] = 0;
              $m++;
            }
            $data = $rasio->data_rasio('data_rasio', null);
            $no = 1;
            foreach ($data as $d) {
              ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['kode_emiten']; ?></td>
                <td><?= $d['tahun']; ?></td>
                <td><?= $d['current_ratio']; ?></td>
                <td><?= $d['quict_ratio']; ?></td>
                <td><?= $d['cash_ratio']; ?></td>
                <td><?= $d['debt_ratio']; ?></td>
                <td><?= $d['debt_equity_ratio']; ?></td>
                <td><?= $d['long_term_dept_equity_ratio']; ?></td>
                <td><?= $d['gross_profit']; ?></td>
                <td><?= $d['net_profit_margin']; ?></td>
                <td><?= $d['ep_total_investment']; ?></td>
                <td><?= $d['roe']; ?></td>
                <td><?= $d['roa']; ?></td>
                <td><?= $d['roi']; ?></td>
                <td><?= $d['roce']; ?></td>
                <td><?= $d['opm']; ?></td>
                <td><?= $d['asset_turnover']; ?></td>
                <td><?= $d['receivable_turnover']; ?></td>
                <td><?= $d['fix_asset_turnover']; ?></td>
                <td><?= $d['inventory_turnover']; ?></td>
                <td><?= $d['averange_days_inventory']; ?></td>
                <td><?= $d['days_sales_outstanding']; ?></td>
                <td><?= $d['dividen_yield']; ?></td>
                <td><?= $d['status_tahun1']; ?></td>
                <td><?= $d['status_tahun2']; ?></td>
              </tr>
              <?php
              $j = 0;
              foreach ($l as $a) {
                $X[0][$j] += $d[$a];
                $X[1][$j] += $d[$a] * $d[$a];
                $j++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="table-responsive mt-5">
        <table class="table table-hover table-bordered">
          <tr>
            <th>Fitur</th>
            <th>X1</th>
            <th>X2</th>
            <th>X3</th>
            <th>X4</th>
            <th>X5</th>
            <th>X6</th>
            <th>X7</th>
            <th>X8</th>
            <th>X9</th>
            <th>X10</th>
            <th>X11</th>
            <th>X12</th>
            <th>X13</th>
            <th>X14</th>
            <th>X15</th>
            <th>X16</th>
            <th>X17</th>
            <th>X18</th>
            <th>X19</th>
            <th>X20</th>
            <th>X21</th>
          </tr>
          <tr>
            <th>Jumlah</th>
            <?php
            $c = 0;
            foreach ($X[0] as $a) {
              ?>
              <td>
                <?= $X[0][$c]; ?>
              </td>
              <?php
              $c++;
            }
            ?>
          </tr>
          <th>Jumlah Pangkat 2</th>
          <?php
          foreach ($X[1] as $a) {
            ?>
            <td>
              <?= $a; ?>
            </td>
          <?php
        }
        ?>
          </tr>
          <tr>
            <th>Rata-rata</th>
            <?php
            $c = 0;
            foreach ($X[0] as $a) {
              ?>
              <td>
                <?= number_format($X[2][$c] = $uji->rata_rata($a, $no), 4); ?>
              </td>
              <?php
              $c++;
            }
            ?>
          </tr>
          <tr>
            <th>Nilai Standar Deviasi</th>
            <?php
            $c = 0;
            foreach ($X[0] as $a) {
              ?>
              <td>
                <?= number_format($X[3][$c] = $uji->std($X, $c, $a, $no), 4); ?>
              </td>
              <?php
              $c++;
            }
            ?>
          </tr>
        </table>
      </div>

      <h4 class="mt-5">Hasil Normalisasi</h4>
      <div class="table-responsive">
        <table class="table example table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Emiten</th>
              <th>Tahun</th>
              <th>X1</th>
              <th>X2</th>
              <th>X3</th>
              <th>X4</th>
              <th>X5</th>
              <th>X6</th>
              <th>X7</th>
              <th>X8</th>
              <th>X9</th>
              <th>X10</th>
              <th>X11</th>
              <th>X12</th>
              <th>X13</th>
              <th>X14</th>
              <th>X15</th>
              <th>X16</th>
              <th>X17</th>
              <th>X18</th>
              <th>X19</th>
              <th>X20</th>
              <th>X21</th>
              <th>Y1</th>
              <th>Y2</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $XBaru;
            $no = 0;
            foreach ($data as $d) {
              ?>
              <tr>
                <td><?= $no + 1; ?></td>
                <td><?= $XBaru[$no][0] = $d['kode_emiten']; ?></td>
                <td><?= $XBaru[$no][1] = $d['tahun']; ?></td>
                <?php
                for ($f = 2; $f < 23; $f++) {
                  ?>
                  <td>
                    <?php
                    // echo number_format($XBaru[$no][$f] = (1 - pow(2.718281828, -(($d[$l[$f - 2]] - $X[2][0]) / $X[3][0]))) / (1 + pow(2.718281828, -(($d[$l[$f - 2]] - $X[2][0]) / $X[3][0]))), 4);
                    echo number_format($XBaru[$no][$f] = $uji->sigmoid(2.718281828, $d, $X, $l, $f), 4);
                    ?>
                  </td>
                <?php
              }
              ?>
                </td>
                <td><?= $XBaru[$no][23] = $d['status_tahun1']; ?></td>
                <td><?= $XBaru[$no][24] = $d['status_tahun2']; ?></td>
              </tr>
              <?php
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
      // pisah data bagkrut dan tidak bangkrut
      $ma = 0;
      $mi = 0;
      $balance = array();
      $aman = array();
      foreach ($XBaru as $b) {
        unset($b[24]);
        if ($b[23] == 0) {
          $ma++;
          array_push($aman, $b);
        } else {
          $mi++;
          array_push($balance, $b);
        }
      }
      ?>
    </section>

    <section class="smote p-5">
      <h3 class="mt-5 mb-5 text-center">Synthetic Minority Oversampling Technique (SMOTE) untuk 1 Tahun Sebelum Kebangkurtan</h3>
      <h6>Percentage Oversampling N % = <?= '(' . $ma . '/' . $mi . ') x 100%' . "=" . ($ma / $mi) * 100 . '% =  ' . $hasil = ($ma / $mi) * $mi; ?></h6>
      <?php
      // die(print_r(($ma / $mi)*100 . ' '));
      // $uji->smote($balance, ($ma / $mi)*100);
      // for ($i = 0; $i < $hasil - $mi; $i++) {
      //   $k1 = rand(0, count($balance) - 1);
      //   $k2 = rand(0, count($balance) - 1);
      //   $k3 = rand(0, count($balance) - 1);
      //   while (($k1 == $k2 || $k1 == $k3) && $k2 == $k3) {
      //     $k2 = rand(0, count($balance) - 1);
      //     $k3 = rand(0, count($balance) - 1);
      //   }
      //   $h1 = 0;
      //   $h2 = 0;
      //   for ($j = 2; $j < 22; $j++) {
      //     $h1 += pow($balance[$k1][$j] - $balance[$k2][$j], 2);
      //     $h2 += pow($balance[$k1][$j] - $balance[$k3][$j], 2);
      //   }
      //   $obaser1 = sqrt($h1);
      //   $obaser2 = sqrt($h2);
      //   // echo $obaser2;
      //   $xbaru = [];
      //   if ($obaser1 > $obaser2)
      //     $kb = $k2;
      //   else
      //     $kb = $k3;
      //   $xbaru[0] = '-';
      //   $xbaru[1] = '-';
      //   for ($j = 2; $j <= 22; $j++) {
      //     $xbaru[$j] = $balance[$k1][$j] + ($balance[$kb][$j] - $balance[$k1][$j]) * 0.3;
      //   }
      //   $xbaru[23] = 1;
      //   array_push($balance, $xbaru);
      // }
      $db = array_merge($aman, $uji->smote($balance, ($ma / $mi) * 100));
      // die(print_r($db));
      echo "<pre>";
      // print_r($db);
      echo "</pre>";
      ?>
      <h6>Hasil SMOTE</h6>
      <div class="table-responsive">
        <table class="table example table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Emiten</th>
              <th>Tahun</th>
              <th>X1</th>
              <th>X2</th>
              <th>X3</th>
              <th>X4</th>
              <th>X5</th>
              <th>X6</th>
              <th>X7</th>
              <th>X8</th>
              <th>X9</th>
              <th>X10</th>
              <th>X11</th>
              <th>X12</th>
              <th>X13</th>
              <th>X14</th>
              <th>X15</th>
              <th>X16</th>
              <th>X17</th>
              <th>X18</th>
              <th>X19</th>
              <th>X20</th>
              <th>X21</th>
              <th>Y1</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $xb = array(array());
            for ($i = 0; $i < 22; $i++) {
              $xb[0][$i] = 0;     //jumlah data
              $xb[1][$i] = 0;     //Rata-rata
              $xb[2][$i] = 0;     //data-rata
              $xb[3][$i] = 0;     //(data-rata)^2
              $xb[4][$i] = 0;     //(data-rata)x(datac class-rata)
            }
            foreach ($db as $b) {
              ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $b[0]; ?></td>
                <td><?= $b[1]; ?></td>
                <?php
                for ($i = 2; $i < 23; $i++) {
                  ?>
                  <td>
                    <?php
                    echo number_format($b[$i], 4);
                    $xb[0][$i - 2] += $b[$i];
                    ?>
                  </td>
                <?php
              }
              $xb[0][21] += $b[23];
              ?>
                <td><?= $b[23]; ?></td>
              </tr>
            <?php
          }
          ?>
          </tbody>
        </table>
      </div>
    </section>

    <section class="person p-5">
      <h3 class="mt-5 mb-5 text-center">Uji Kolerasi Person</h3>
      <?php
      $k = 0;
      foreach ($xb[0] as $g) {
        // $xb[1][$k] = $g / ($no - 1);
        $xb[1][$k] = $uji->rata_rata($g, $no);
        $k++;
      }

      foreach ($db as $b) {
        for ($i = 0; $i < 22; $i++) {
          $xb[2][$i] += $b[2 + $i] - $xb[1][$i];
          $xb[3][$i] += pow($b[2 + $i] - $xb[1][$i], 2);
          $xb[4][$i] += ($b[2 + $i] - $xb[1][$i]) * ($b[23] - $xb[1][21]);
        }
      }
      // $r = array();
      // for ($i = 0; $i < 21; $i++) {
      //   $r[$i] = $xb[4][$i] / sqrt($xb[3][$i] * $xb[3][21]);
      // }
      $r = $uji->person($xb);
      ?>

      <div class="table-responsive mt-5">
        <table class="table table-hover table-bordered">
          <tr>
            <th>Fitur</th>
            <th>X1</th>
            <th>X2</th>
            <th>X3</th>
            <th>X4</th>
            <th>X5</th>
            <th>X6</th>
            <th>X7</th>
            <th>X8</th>
            <th>X9</th>
            <th>X10</th>
            <th>X11</th>
            <th>X12</th>
            <th>X13</th>
            <th>X14</th>
            <th>X15</th>
            <th>X16</th>
            <th>X17</th>
            <th>X18</th>
            <th>X19</th>
            <th>X20</th>
            <th>X21</th>
            <th>Y</th>
          </tr>
          <tr>
            <th>Jumlah</th>
            <?php
            foreach ($xb[0] as $a) {
              ?>
              <td>
                <?= number_format($a, 2); ?>
              </td>
            <?php
          }
          ?>
          </tr>
          <tr>
            <th>Rata-rata (<img src="../assets/gambar/xbar.JPG" alt="">)</th>
            <?php
            foreach ($xb[1] as $a) {
              ?>
              <td>
                <?= number_format($a, 4); ?>
              </td>
            <?php
          }
          ?>
          </tr>
          <tr>
            <th>
              <img src="../assets/gambar/x-xbar.JPG" alt="">
            </th>
            <?php
            foreach ($xb[2] as $a) {
              ?>
              <td>
                <?= number_format($a, 4); ?>
              </td>
            <?php
          }
          ?>
          </tr>
          <tr>
            <th>
              <img src="../assets/gambar/xpangkat2.JPG" alt="">
            </th>
            <?php
            foreach ($xb[3] as $a) {
              ?>
              <td>
                <?= number_format($a, 4); ?>
              </td>
            <?php
          }
          ?>
          </tr>
          <tr>
            <th>
              <img src="../assets/gambar/x-kali-y.JPG" alt="">
            </th>
            <?php
            foreach ($xb[4] as $a) {
              ?>
              <td>
                <?= number_format($a, 4); ?>
              </td>
            <?php
          }
          ?>
          </tr>
          <tr>
            <th>
              NIlai Kolerasi <i>r</i>
            </th>
            <?php
            $no = 0;
            $fitur = array();
            foreach ($r as $a) {
              ?>
              <td>
                <?php if (abs($a) > 0.181) {
                  array_push($fitur, $no);
                  echo '<b>' . number_format($a, 4) . '</b>';
                } else
                  echo number_format($a, 4);
                ?>
              </td>
              <?php
              $no++;
            }
            ?>
          </tr>
        </table>
      </div>
      <?php
      // echo 'no : ' . $no;
      echo "<pre>";
      // print_r($xb[1]);
      // print_r($xb[2]);
      // print_r($xb[3]);
      // print_r($xb[3][21]);
      // print_r($xb[4]);
      // print_r($db);
      // print_r($r);
      echo "</pre>";
      ?>
    </section>

    <section class="evaluasi knn p-5">
      <?php


      $br = array();
      $tb = array();
      $abc = array();
      $no = 0;
      $u = 0;
      foreach ($db as $a) {
        $l = 0;
        foreach ($fitur as $f) {
          if ($a[23] == 0)
            $abc[$l] = $a[$f + 2];
          else
            $abc[$l] = $a[$f + 2];
          $l++;
        }
        $abc[$l] = $a[23];
        if ($a[23] == '0')
          array_push($tb, $abc);
        else
          array_push($br, $abc);
      }

      $uji_br = array();
      $uji_tb = array();
      for ($i = 0; $i < 10; $i++) {
        array_push($uji_br, $br[count($br) - $i - 1]);
        array_push($uji_tb, $tb[count($tb) - $i - 1]);
      }
      for ($i = 0; $i < 10; $i++) {
        array_pop($br);
        array_pop($tb);
      }

      $a = array();
      $datacek = array_merge($uji_tb, $uji_br);
      $dl = array_merge($tb, $br);

      $knn = $uji->knn(5, $dl, $datacek);

      // echo "<pre>";
      // // print_r($duji);
      // // print_r($tuji);
      // // print_r($tb);
      // print_r(($datacek));
      // // print_r(($uji1));
      // // var_dump(($labels));
      // // var_dump(($ab));
      // // print_r(($uji1));
      // echo "</pre>";
      // die();
      ?>

      <h3>Prediksi Dengan KNN</h3>
      <h6>Data Testing</h6>
      <div class="table-responsive">

        <table class="table table-hover table-bordered example">
          <thead>
            <tr>
              <th>No</th>
              <?php
              foreach ($fitur as $f) {
                ?>
                <th>X<?= $f + 1; ?></th>
              <?php
            }
            ?>
              <th>Kelas Data(Y)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($datacek as $d) {
              ?>
              <tr>
                <td><?= $no; ?></td>
                <?php
                foreach ($d as $e) {
                  ?>
                  <td>
                    <?php
                    if (($e == 0) || ($e == 1))
                      echo $e;
                    else
                      echo number_format($e, 4); ?>
                  </td>
                <?php
              }
              ?>
              </tr>
              <?php
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>

      <h5>Hasil Prediksi KNN</h5>
      <table class="table table-hover table-bordered example">
        <thead>
          <tr>
            <th>No</th>
            <th>Y</th>
            <th>Hasil Kelas KNN (Y)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 0;
          foreach ($datacek as $d) {
            ?>
            <tr>
              <td><?= $no + 1; ?></td>
              <td><?= $d[17]; ?></td>
              <td><?php
                  echo $knn[$no];
                  ?>
              </td>
            </tr>
            <?php
            $no++;
          }
          ?>
        </tbody>
      </table>
    </section>
  </div>


  <script type="text/javascript" src="../assets/js/jquery.js"></script>
  <script type="text/javascript" src="../assets/js/vendor/popper.min.js"></script>
  <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../assets/dataTable/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../assets/dataTable/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="../assets/js/vendor/popper.min.js"></script>
  <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.example').DataTable();
    });
  </script>
</body>

</html>