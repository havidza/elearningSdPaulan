<?php
    if (isset($_POST["updateKelas"])){
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $sql = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id='$id'");
        $row = mysqli_fetch_array($sql);

        if($row["id"] == $id){
          $update = "UPDATE kelas SET nama='$nama' WHERE id='$id'";
          $ins = mysqli_query($koneksi, $update);
          if ($ins){
              echo "<script>alert('Data kelas Berhasil Diupdate!')
              window.location.replace('kelas.php');</script>";
          }
        } else {
          echo "<script>alert('Data kelas Gagal Diupdate!')
          window.location.replace('kelas.php');</script>";
        }
    } 
?>