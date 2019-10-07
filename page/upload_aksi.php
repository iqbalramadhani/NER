<?php
// menghubungkan dengan library excel reader
include "../excel_reader2.php";
include('../crud.php');

$crud = new Crud;

// upload file xls
$target = basename($_FILES['filepegawai']['name']);
move_uploaded_file($_FILES['filepegawai']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filepegawai']['name'], 0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filepegawai']['name'], false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 2; $i <= $jumlah_baris; $i++) {

  // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing

  // $arrData = array(
  //   'kode'            => $data->val($i, 1),
  //   'nama_perusahaan' => $data->val($i, 2),
  //   'sektor'          => $data->val($i, 3),
  //   'subsektor'       => $data->val($i, 4)
  // );

  $arrData = array(
    'kode_emiten'                 => $data->val($i, 1),
    'tahun'                       => $data->val($i, 2),
    'current_ratio'              => $data->val($i, 3),
    'quict_ratio'                 => $data->val($i, 4),
    'cash_ratio'                 => $data->val($i, 5),
    'debt_ratio'                 => $data->val($i, 6),
    'debt_equity_ratio'          => $data->val($i, 7),
    'long_term_dept_equity_ratio' => $data->val($i, 8),
    'gross_profit'                => $data->val($i, 9),
    'net_profit_margin'         => $data->val($i, 10),
    'ep_total_investment'       => $data->val($i, 11),
    'roe'                         => $data->val($i, 12),
    'roa'                         => $data->val($i, 13),
    'roi'                         => $data->val($i, 14),
    'roce'                        => $data->val($i, 15),
    'opm'                         => $data->val($i, 16),
    'asset_turnover'             => $data->val($i, 17),
    'receivable_turnover'        => $data->val($i, 18),
    'fix_asset_turnover'         => $data->val($i, 19),
    'inventory_turnover'         => $data->val($i, 20),
    'averange_days_inventory'    => $data->val($i, 21),
    'days_sales_outstanding'     => $data->val($i, 22),
    'dividen_yield'               => $data->val($i, 23),
    'status_tahun1'               => $data->val($i, 24),
    'status_tahun2'               => $data->val($i, 25),
  );
  // $hasil = $crud->simpan('data_emiten', $arrData);
  $hasil = $crud->simpan('data_rasio', $arrData);
  if ($hasil == false)
    echo "Terjadi kesalahan";

  $berhasil++;
  // }
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filepegawai']['name']);

// alihkan halaman ke index.php
// header("location:tambah_emiten.php?berhasil=$berhasil");
header("location:rasio_keuangan.php?berhasil=$berhasil");
