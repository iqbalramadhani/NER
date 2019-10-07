<?php
include('../rasio.php');
$rasio = new Rasio();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rasio Keuangan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css">
  <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" media="screen" href="../assets/dataTable/dataTables.bootstrap4.min.css">
  <script type="text/javascript" src="../assets/js/jquery.js"></script>
  <script src="main.js"></script>
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col-10">
        <h1>Rasio Keuangan</h1>
        <form method="post" enctype="multipart/form-data" action="upload_aksi.php">
          Pilih File:
          <input name="filepegawai" type="file" required="required">
          <input name="upload" type="submit" value="Import">
        </form>
      </div>
      <div class="col">
        <a href="../" class="btn btn-primary">Kembali</a>
      </div>
    </div>
    <section class="mt-5">
      <h5>Data Emiten</h5>
      <div class="table-responsive">
        <table class="table" id="example">
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
          }
          ?>
          </tbody>
        </table>
      </div>

      <h5 class="mt-5 w-10">Keterangan</h5>
      <div class="row">
        <div class="col-md-5">
          <table class="table">
            <thead>
              <tr>
                <th>Simbol</th>
                <th>Nama Rasio</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>X1</td>
                <td>Current Ratio</td>
              </tr>
              <tr>
                <td>X2</td>
                <td>Quict Ratio</td>
              </tr>
              <tr>
                <td>X3</td>
                <td>Cash Ratio</td>
              </tr>
              <tr>
                <td>X4</td>
                <td>Debt Ratio</td>
              </tr>
              <tr>
                <td>X5</td>
                <td>Total Debt to Equity Ratio</td>
              </tr>
              <tr>
                <td>X6</td>
                <td>Long Term Debt to Equity Ratio</td>
              </tr>
              <tr>
                <td>X7</td>
                <td>Gross Profit Margin</td>
              </tr>
              <tr>
                <td>X8</td>
                <td>Net Profit Margin</td>
              </tr>
              <tr>
                <td>X9</td>
                <td>Earning Power of Total Invesment</td>
              </tr>
              <tr>
                <td>X10</td>
                <td>Return on Equity</td>
              </tr>
              <tr>
                <td>X11</td>
                <td>Return on Assets</td>
              </tr>
              <tr>
                <td>X12</td>
                <td>Return on Invesment</td>
              </tr>
              <tr>
                <td>X13</td>
                <td>Return on Capital Employed</td>
              </tr>
              <tr>
                <td>X14</td>
                <td>Operating Profit Margin</td>
              </tr>
              <tr>
                <td>X15</td>
                <td>Total Asset Turnover</td>
              </tr>
              <tr>
                <td>X16</td>
                <td>Receivable Turnover</td>
              </tr>
              <tr>
                <td>X17</td>
                <td>Fix Asset Turnover</td>
              </tr>
              <tr>
                <td>X18</td>
                <td>Inventory Turnover</td>
              </tr>
              <tr>
                <td>X19</td>
                <td>Average Days Outstanding</td>
              </tr>
              <tr>
                <td>X20</td>
                <td>Days Sales Outstanding</td>
              </tr>
              <tr>
                <td>X21</td>
                <td>Dividen Yield</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
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