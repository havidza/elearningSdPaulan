<?php

require '../../koneksi.php';

include_once "../../assets/mpdf7/vendor/autoload.php";

$id_user = $_GET['id'];

$html = "Cekkas";

$tglcetak = date('Ymdhis');
$namapdf = "sk_pelaksanaan_" . $tglcetak;
$mpdf = new Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'P']);
$mpdf->simpleTables = true;
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;
// $stylesheet = file_get_contents('../config/mpdf/examples/mpdfstyletables.css');
// $mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html);
$mpdf->Output('../pdf/' . $namapdf . '.pdf', 'F');
