<?php
// Ambil Jumlah Data Materi
    $queryMateri = mysqli_query($koneksi, "SELECT * FROM materi WHERE id_guru='$id'");
    $rowMateri = mysqli_num_rows($queryMateri);
// Ambil Jumlah Data Tugas
    $queryTugas = mysqli_query($koneksi, "SELECT * FROM tugas WHERE id_guru='$id'");
    $rowTugas = mysqli_num_rows($queryTugas);
// Ambil Jumlah Data Siswa
    $querySiswa = mysqli_query($koneksi, "SELECT * FROM user WHERE role='Siswa'");
    $rowSiswa = mysqli_num_rows($querySiswa);
?>