<?php
    require '../../koneksi.php';
    $id = $_GET['id'];
    $hapusSQL = mysqli_query($koneksi, "DELETE FROM user WHERE id = $id") or die(mysqli_error($koneksi));
    if ($hapusSQL){
        echo "
            <script>
                alert('guru berhasil dihapus!');
                document.location.href = '../guru.php';
            </script>
        ";
    }
    else {
        echo "
            <script>
                alert('guru gagal dihapus!');
                document.location.href = '../guru.php';
            </script>
        ";
    }
?>