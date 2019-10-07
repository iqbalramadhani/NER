<?php
include('../emiten.php');
$emiten = new Emiten();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tambah Emiten</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" media="screen" href="../assets/dataTable/dataTables.bootstrap4.min.css">
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col-8">
        <h1>Tambah Data Emiten</h1>
        <form method="post" enctype="multipart/form-data" action="upload_aksi.php">
          Pilih File:
          <input name="filepegawai" type="file" required="required">
          <input name="upload" type="submit" value="Import">
        </form>
      </div>
      <div class="col align-content-center">
        <a href="../" class="btn btn-primary">Kembali</a>
      </div>
    </div>


    <section class="mt-5">
      <h5>Data Emiten</h5>
      <table class="table" id="example">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Emiten</th>
            <th>Nama Emiten</th>
            <th>Sektor</th>
            <th>Sunsektor</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $data = $emiten->data_emiten('data_emiten', null);
          $no = 1;
          foreach ($data as $d) {
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $d['kode']; ?></td>
              <td><?= $d['nama_perusahaan']; ?></td>
              <td><?= $d['sektor']; ?></td>
              <td><?= $d['subsektor']; ?></td>
            </tr>
          <?php
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
      $('#example').DataTable();
    });
  </script>
</body>

</html>