<?php
include('Praproses.php');
$praproses = new Praproses();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NER dengan SVM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css">
  <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" media="screen" href="assets/dataTable/dataTables.bootstrap4.min.css">
  <script type="text/javascript" src="../assets/js/jquery.js"></script>

</head>

<body>
  <div class="container">
    <section class="tinggi mt-5">
      <h1 class="text-center pb-3">NER dengan SVM</h1>
      <h4>Data Class</h4>
      <div class="row">
        <div class="col-5">
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>No.</th>
                <th>Class</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>ORGANIZATION</td>
              </tr>
              <tr>
                <td>2</td>
                <td>PERSON</td>
              </tr>
              <tr>
                <td>3</td>
                <td>QUANTITY</td>
              </tr>
              <tr>
                <td>4</td>
                <td>LOCATION</td>
              </tr>
              <tr>
                <td>5</td>
                <td>TIME</td>
              </tr>
              <tr>
                <td>6</td>
                <td>OTHER</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <?php
      $fh = fopen("data_training.txt", "r");
      // $file = file_get_contents("data_training.txt");
      // echo $file;
      // print_r($init);
      $data = array();
      $isi = array();
      while (!feof($fh)) {
        $line = fgets($fh);
        // echo strlen($line);
        // echo $line . "<br>";
        // if ($line == "  ") {
        //   continue;
        // }
        $init = array_fill(0, 15, 0);
        $parts = explode(' ', $line);
        // echo $parts[2] . "<br>";
        $asci = unpack("C*", $parts[0]);
        if ($asci[1] == 13) {
          continue;
        }
        // array_pop($asci);
        $i = 0;
        foreach ($asci as $s) {
          $init[$i] = $s;
          $i++;
        }
        $isi['kata'] = $parts[0];
        $isi['asci'] = $init;
        $kelas = trim($parts[2]);
        $isi['kelas'] = $praproses->kelas($kelas);
        $isi['label'] = $kelas;
        array_push($data, $isi);
      }

      $positif = array();
      $negatif = array();
      $baru = array();           //nyimpen data
      $kelas = array();         //nyimpen class
      foreach ($data as $d) {
        if ($d['kelas'] == 1) {
          $d['kelas'] = -1;
          array_push($positif, $d);
          array_push($baru, $d['asci']);
          array_push($kelas, $d['kelas']);
        } else if ($d['kelas'] == 2) {
          $d['kelas'] = 1;
          array_push($negatif, $d);
          array_push($baru, $d['asci']);
          array_push($kelas, $d['kelas']);
        }
      }

      // echo "<pre>";
      // print_r($data);
      // echo "</pre>";


      include('Svm.php');   //memanggil class svm

      $uji = [
        [0, 74, 111, 107, 111, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 66, 97, 100, 97, 110, 0, 0, 0, 0, 0, 0, 0, 0, 0]
      ];

      $svm = new Svm();
      $svm->pelatihan($baru, $kelas);
      // $uji = $data[15]['asci'];
      // print_r($uji);
      // $uji = [-0.44, -0.42, 0.27, 1, 1];
      // print_r($uji);
      $prediksi = $svm->prediksi($uji);
      var_dump($prediksi);
      ?>
      <table class="table" id="example">
        <thead>
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kata</th>
            <th colspan="15">ASCI</th>
            <th rowspan="2">Kelas</th>
          </tr>
          <tr>
            <?php
            for ($i = 0; $i < 15; $i++) {
              ?>
              <th><?= $i + 1; ?></th>
            <?php
            } ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($data as $d) {
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $d['kata']; ?></td>
              <?php
                foreach ($d['asci'] as $a) {
                  ?>
                <td><?= $a; ?></td>
              <?php
                }
                ?>
              <td><?= $d['label']; ?></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </section>
  </div>
  <script type="text/javascript" src="assets/dataTable/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/dataTable/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="assets/js/vendor/popper.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
</body>

</html>