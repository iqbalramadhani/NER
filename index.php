<?php
include('Praproses.php');
include('Svm.php');
$praproses = new Praproses();
$svm = new Svm();
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
      $kamus = array();
      $token = array();
      while (!feof($fh)) {
        $line = fgets($fh);
        $parts = explode(' ', $line);
        $asci = unpack("C*", $parts[0]);
        if ($asci[1] == 13)
          continue;
        if (!in_array($parts[0], $kamus))
          array_push($kamus, $parts[0]);
        $kelas = trim($parts[2]);
        array_push($token, [$parts[0], $kelas]);
      }
      ?>

      <h4>Kamus Yang Terbentuk</h4>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <th>No</th>
            <?php
            $no = 1;
            foreach ($kamus as $k) {
              ?>
              <td><?= $no++ ?></td>
            <?php
            }
            ?>
          </thead>
          <tbody>
            <tr>
              <th>Kata</th>
              <?php
              foreach ($kamus as $k) {
                ?>
                <td><?= $k ?></td>
              <?php
              }
              ?>
            </tr>
          </tbody>
        </table>
      </div>

      <h4 class="pt-5">One Hot</h4>
      <?php
      $i = 0;
      $token_baru = array();
      foreach ($token as $t) {
        $vektor = array();
        foreach ($kamus as $k) {
          if ($t[0] == $k)
            array_push($vektor, 1);
          else
            array_push($vektor, 0);
        }
        array_push($token_baru, [$t[0], $vektor, $t[1]]);
        $i++;
      }
      // echo '<pre>';
      // print_r($token_baru);
      // echo '</pre>';
      ?>
      <div class="table-responsive">
        <table class="table example">
          <thead>
            <th>No.</th>
            <th>Kata</th>
            <th>Vektor</th>
            <th>Class</th>
          </thead>
          <tbody>
            <?php
            $ORGANIZATION = array();
            $PERSON = array();
            $QUANTITY = array();
            $LOCATION = array();
            $TIME = array();
            $OTHER = array();
            $no = 1;
            foreach ($token_baru as $tb) {
              switch ($tb[2]) {
                case "ORGANIZATION":
                  array_push($ORGANIZATION, [$tb[1], $tb[2]]);
                  break;
                case 'PERSON':
                  array_push($PERSON, [$tb[1], $tb[2]]);
                  break;
                case 'QUANTITY':
                  array_push($QUANTITY, [$tb[1], $tb[2]]);
                  break;
                case 'LOCATION':
                  array_push($LOCATION, [$tb[1], $tb[2]]);
                  break;
                case 'TIME':
                  array_push($TIME, [$tb[1], $tb[2]]);
                  break;
                case "OTHER":
                  array_push($OTHER, [$tb[1], $tb[2]]);
                  break;
              }
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $tb[0]; ?></td>
                  <td>
                    <?php
                      foreach ($tb[1] as $o)
                        echo $o;
                      ?>
                  </td>
                  <td><?= $tb[2]; ?></td>
                </tr>
              <?php
              }
              ?>
          </tbody>
        </table>
        <?php
        $hasil = $praproses->formatSvm($ORGANIZATION, $PERSON);
        // $hasil = $praproses->formatSvm($LOCATION, $PERSON);
        $pelatihan = $svm->pelatihan($hasil[0], $hasil[1], 1, 0.00001, 5);
        // echo count($OTHER);
        print_r($pelatihan[0]);
        ?>

    </section>

  </div>
  <script type="text/javascript" src="assets/dataTable/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/dataTable/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="assets/js/vendor/popper.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.example').DataTable();
    });
  </script>
</body>

</html>