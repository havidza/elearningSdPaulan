<?php

require '../../koneksi.php';
include_once "../../assets/mpdf7/vendor/autoload.php";
// require '../../css/raport.css';
$id_user = $_POST['id'];

$query = mysqli_query($koneksi, "SELECT *, user.nama as nama_siswa, user.role, kelas.nama as nama_kelas, user.id as id_user, 
nilai.id as id_nilai FROM user
LEFT JOIN kelas ON user.id_kelas = kelas.id
LEFT JOIN nilai ON user.id = nilai.id_siswa
WHERE user.role = 'Siswa' AND user.id = '$id_user'");

$no = 1;
$result = array();
$items = array();

while ($row = mysqli_fetch_array($query)) {
  $q1 = mysqli_query($koneksi, "SELECT judul, id_materi FROM TUGAS where id='$row[id_tugas]'");
  $row1 = mysqli_fetch_assoc($q1);

  $q2 = mysqli_query($koneksi, "SELECT judul_materi FROM materi where id='$row1[id_materi]'");
  $row2 = mysqli_fetch_assoc($q2);

  $q3 = mysqli_query($koneksi, "SELECT nama,nip FROM user WHERE role = 'Guru' AND id_kelas = '$row[id_kelas]'");
  $row3 = mysqli_fetch_assoc($q3);

  $row['judul_materi'] = $row2['judul_materi'];
  $row['judul'] = $row1['judul'];

  if ($row['nilai'] <= 70) {
    $ket = 'Tidak Lulus';
    $saran = 'Nilai belum lulus KKM nih, yuk lebih semangatt dan di tingkatkan belajarnya';
  } else {
    $ket = 'Lulus';
    $saran = 'Nilai sudah diatas KKM nih. Mantapp, kerja bagus.';
  }

  $html = "<table style='width:100%;'>
    <tr>
      <td align='center'>
        <h4>HASIL PEMBELAJARAN E-LEARNING <br>
        SD NEGERI PAULAN </h4>
      </td>
     </tr>
  </table><br>";

  $html .= " <table style='width:100%;'>
    <tr>
      <td> Nama </td>
      <td> : </td>
      <td> <b>" . $row['nama_siswa'] . "</b> </td>
    </tr>
    <tr>
      <td>NIS</td>
      <td>: </td>
      <td><b>" . $row['nis'] . "</b></td>
    </tr>
    <tr>
      <td>Kelas </td>
      <td> : </td>
      <td> <b>" . $row['nama_kelas'] . "</b> </td>
    </tr>
    <tr>
      <td>Sekolah </td>
      <td>:</td>
      <td> <b>SD NEGERI PAULAN</b> </td>
  </table>
  <br><br>";

  $html .= "<table style='width:100%;'>
             <tr>
               <td align='center'>
                 <h4>KEMAMPUAN MATA PELAJARAN</h4>
               </td>
              </tr>
           </table><br>";

  $html .= "<table style='border-collapse: collapse;width: 100%;' border=1>
    <tr>
        <th>No</th>
        <th>Mata Pelajaran</th>
        <th>Tugas</th>
        <th>KKM</th>
        <th>Nilai</th>
        <th>KET</th>
    </tr>
    <tr>
        <td>" . $no . "</td>
        <td>" . $row['judul_materi'] . "</td>
        <td>" . $row['judul'] . "</td>
        <td>70</td>
        <td>" . $row['nilai'] . "</td>
        <td>" . $ket . "</td>
    </tr>
     
  </table><br>";

  $html .= "<table style='width:100%;'>
  <tr>
    <td align='center'>
      <h4>SARAN - SARAN</h4>
    </td>
   </tr>
</table>
<br>
<table style='border-collapse: collapse;width: 100%;' border=1>
    <tr>
        <td>" . $saran . "</td>
    </tr>
     
  </table><br><br>";

  $html .= "<table style='width:100%;'>
  <tr>
    <td>
      " . $row3['nama'] . "
    </td>
   </tr>
   <tr>
      <td>NIP: " . $row3['nip'] . "</td>
   </tr>

</table><br>";


  // $row['no'] = $no;
  // $row['nama_siswa'];
  // $row['nama_kelas'];

  // $row['nilai'];
  // $row['id_user'];


  $no++;
  // array_push($items, $row);
}

$tglcetak = date('Ymdhis');
$result = "raport_" . $tglcetak;
$mpdf = new Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'P']);
$mpdf->simpleTables = true;
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;
// $stylesheet = file_get_contents('../config/mpdf/examples/mpdfstyletables.css');
// $mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html);
$mpdf->Output('../../pdf/' . $result . '.pdf', 'F');
echo $result;
