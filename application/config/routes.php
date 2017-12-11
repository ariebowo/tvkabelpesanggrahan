<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*LAPORAN KEUANGAN*/
$route['report-keuangan/cetak'] = "report_keuangan/cetak";
$route['report-keuangan'] = "report_keuangan/index";

$route['pengeluaran/delete/([0-9]+)'] = "pengeluaran/delete/$1";
$route['pengeluaran/save'] = "pengeluaran/save";
$route['pengeluaran/list-data'] = "pengeluaran/listData";
$route['pengeluaran'] = "pengeluaran/index";

/*LAPORAN PEMBAYARAN*/
#$route['pembayaran/list-data'] = "pembayaran/listData";
#$route['pembayaran/hitung'] = "pembayaran/hitung";
$route['report-pembayaran/detail-bayar/([0-9]+)'] = "report_pembayaran/detailBayar/$1";
$route['report-pembayaran/print/([0-9]+)'] = "report_pembayaran/cetak/$1";
$route['report-pembayaran/detail/([0-9]+)'] = "report_pembayaran/detail/$1";
$route['report-pembayaran/list-data'] = "report_pembayaran/listData";
$route['report-pembayaran'] = "report_pembayaran/index";

/*HUTANG*/
$route['data-hutang/print'] = "hutang/Cetak";
$route['data-hutang'] = "hutang/index";

/*PEMBAYARAN*/
$route['pembayaran/direct-print/([0-9]+)'] = "pembayaran/DirectPrint/$1";
$route['pembayaran/delete/([0-9]+)'] = "pembayaran/delete/$1";
$route['pembayaran/cari'] = "pembayaran/cari";
$route['pembayaran/save'] = "pembayaran/save";
$route['pembayaran/hitung'] = "pembayaran/hitung";
$route['pembayaran/add'] = "pembayaran/AddBayar";

/*HARGA*/
$route['harga/list-data'] = "harga/listData";
$route['harga/save'] = "harga/save";
$route['harga'] = "harga/index";

/*PELANGGAN*/
$route['pelanggan/list-data'] = "pelanggan/listData";
$route['pelanggan/save'] = "pelanggan/save";
$route['pelanggan/delete/([0-9]+)'] = "pelanggan/delete/$1";
$route['pelanggan/edit/([0-9]+)'] = "pelanggan/edit/$1";
$route['pelanggan/add'] = "pelanggan/add";
$route['pelanggan'] = "pelanggan/index";

$route['logout'] = "homepage/logout";
$route['login'] = "homepage/login";


$route['default_controller'] = "homepage";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */