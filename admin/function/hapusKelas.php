<?php
    require '../../koneksi.php';
    $id = $_GET['id'];
    $hapusSQL = mysqli_query($koneksi, "DELETE FROM kelas WHERE id = $id") or die(mysqli_error($koneksi));
    if ($hapusSQL){
        echo "
            <script>
                alert('kelas berhasil dihapus!');
                document.location.href = '../kelas.php';
            </script>
        ";
    }
    else {
        echo "
            <script>
                alert('kelas gagal dihapus!');
                document.location.href = '../kelas.php';
            </script>
        ";
    }
?>