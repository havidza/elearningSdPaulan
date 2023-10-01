<?php
require '../../koneksi.php';
require 'session2.php';
$me = $_SESSION['id'];
$sql_id = "SELECT * FROM user WHERE id = '$me'";
$query_id = mysqli_query($koneksi, $sql_id);
$row_id = mysqli_fetch_assoc($query_id);
$id_kelas = $row_id['id_kelas'];
$nama_kelas = "SELECT * FROM kelas WHERE id = '$id_kelas'";
$query_kelas = mysqli_query($koneksi, $nama_kelas);
$row_kelas = mysqli_fetch_assoc($query_kelas);
$nama_kelass = $row_kelas['nama'];

$query = mysqli_query($koneksi, "SELECT *, user.nama as nama_siswa, user.role, kelas.nama as nama_kelas, user.id as id_user, nilai.id as id_nilai
FROM user
LEFT JOIN kelas ON user.id_kelas = kelas.id
LEFT JOIN nilai ON user.id = nilai.id_siswa
WHERE user.role = 'Siswa' AND kelas.nama = '$nama_kelass'");

$no = 1;
$result = array();
$items = array();
while ($row = mysqli_fetch_array($query)) {
    $q1 = mysqli_query($koneksi, "SELECT judul, id_materi FROM TUGAS where id='$row[id_tugas]'");
    $row1 = mysqli_fetch_assoc($q1);

    $q2 = mysqli_query($koneksi, "SELECT judul_materi FROM materi where id='$row1[id_materi]'");
    $row2 = mysqli_fetch_assoc($q2);

    $row['no'] = $no;
    // $row['nama_siswa'];
    // $row['nama_kelas'];
    $row['judul_materi'] = $row2['judul_materi'];
    $row['judul'] = $row1['judul'];
    // $row['nilai'];
    // $row['id_user'];

    $row["aksi_rek"] = '
    <span onClick="printData(' . "'" . $row["id_user"] . "'" . ')" style="cursor:pointer" class="btn btn-warning" data-toggle="tooltip" title="Print">&nbsp;<i class="fa fa-book"></i>&nbsp;</span>
    &nbsp;';


    $no++;
    array_push($items, $row);
}

$result['result'] = $items;

echo json_encode($result);
