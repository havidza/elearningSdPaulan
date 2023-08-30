<?php
    if (isset($_POST["updateGuru"])){
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $nip= $_POST["nip"];
        $username = $_POST["username"];
        $id_kelas = $_POST["id_kelas"];
        $jk = $_POST["jk"];
        $wa = $_POST["wa"];
        $alamat = $_POST["alamat"];
        $role = 'Guru';
        $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
        $row = mysqli_fetch_array($sql);
        

        if($row["id"] == $id){
          $update = "UPDATE user SET nip='$nip', username='$username', id_kelas='$id_kelas', nama='$nama', role='$role', jk='$jk', wa='$wa', alamat='$alamat' WHERE id='$id'";
          $ins = mysqli_query($koneksi, $update);
          if ($ins){
              echo "<script>alert('Data guru Berhasil Diupdate!')
              window.location.replace('guru.php');</script>";
          }
        } else {
          echo "<script>alert('Data guru Gagal Diupdate!')
          window.location.replace('guru.php');</script>";
        }
    } 
?>