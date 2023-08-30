<?php
    if (isset($_POST["tambahKelas"])){
      $nama = $_POST["nama"];
      $insert = "INSERT INTO kelas VALUES (NULL, '$nama')";
      $ins = mysqli_query($koneksi, $insert);
      if ($ins){
          echo "<script>alert('Data Kelas Berhasil Ditambahkan!')
          window.location.replace('kelas.php');</script>";
      }
        
    } 
?>