<?php
    if (isset($_POST["updateSiswa"])){
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $nis = $_POST["nis"];
        $id_kelas = $_POST["id_kelas"];
        $username = $_POST["username"];
        $jk = $_POST["jk"];
        $wa = $_POST["wa"];
        $alamat = $_POST["alamat"];
        $role = 'Siswa';
        $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
        $row = mysqli_fetch_array($sql);
        

        if($row["id"] == $id){
          $update = "UPDATE user SET nis='$nis', id_kelas='$id_kelas', username='$username', nama='$nama', role='$role', jk='$jk', wa='$wa', alamat='$alamat' WHERE id='$id'";
          $ins = mysqli_query($koneksi, $update);
          if ($ins){
              echo "<script>alert('Data Siswa Berhasil Diupdate!')
              window.location.replace('siswa.php');</script>";
          }
        } else {
          echo "<script>alert('Data Siswa Gagal Diupdate!')
          window.location.replace('siswa.php');</script>";
        }
    } 
?>