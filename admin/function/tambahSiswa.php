<?php
    if (isset($_POST["tambahSiswa"])){
        $nama = $_POST["nama"];
        $nis = $_POST["nis"];
        $kelas = $_POST["id_kelas"];
        $username = $_POST["username"];
        $password = md5('123456');
        $jk = $_POST["jk"];
        $wa = $_POST["wa"];
        $alamat = $_POST["alamat"];
        $role = 'Siswa';
        $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE nis='$nis'");
        $row = mysqli_fetch_array($sql);
        if ($row["nis"] == $nis){
            echo "<script>alert('NIS sudah terdaftar!')</script>";
        } else {
            $insert = "INSERT INTO user VALUES (NULL, NULL, '$nis', '$kelas', '$username', '$password', '$nama', '$role', '$jk', '$wa', '$alamat')";
            $ins = mysqli_query($koneksi, $insert);
            if ($ins){
                echo "<script>alert('Data Siswa Berhasil Ditambahkan!')
                window.location.replace('siswa.php');</script>";
            }
        }
    } 
?>