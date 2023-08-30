<?php
    require '../../koneksi.php';
    session_start();
    $id = $_SESSION['id'];
    $id_tugas = $_GET['id_tugas'];
    var_dump($id_tugas);
    $cekId = mysqli_query($koneksi, "SELECT * FROM tugas WHERE id = $id_tugas");
    $rowId = mysqli_fetch_array($cekId);
    $cekSoal = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_tugas = $id_tugas");
    $rowSoal = mysqli_fetch_array($cekSoal);
    if($rowId>0){
        $hapusSQL = mysqli_query($koneksi, "DELETE FROM tugas WHERE id = $id_tugas") or die(mysqli_error($koneksi));
        $hapusSoal = mysqli_query($koneksi, "DELETE FROM soal WHERE id_tugas = $id_tugas") or die(mysqli_error($koneksi));
        if ($hapusSQL && $hapusSoal){
            echo "
                <script>
                    alert('Tugas berhasil dihapus!');
                    document.location.href = '../tugas.php';
                </script>
            ";
        }
        else {
            echo "
                <script>
                    alert('Tugas gagal dihapus!');
                    document.location.href = '../tugas.php';
                </script>
            ";
        }
    }
    else {
        echo "
                <script>
                    alert('Tugas tidak bisa dihapus!');
                    document.location.href = '../tugas.php';
                </script>
            ";
    }
?>