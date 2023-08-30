<?php
    if (isset($_POST["tambahGuru"])){
        $nama = $_POST["nama"];
        $nip = $_POST["nip"];
        $id_kelas = $_POST["id_kelas"];
        $username = $_POST["username"];
        $password = md5('123456');
        $jk = $_POST["jk"];
        $wa = $_POST["wa"];
        $alamat = $_POST["alamat"];
        $role = 'Guru';
        $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE nip='$nip'");
        $row = mysqli_fetch_array($sql);
        if ($row["nip"] == $nip){
            echo "<script>alert('Nip sudah terdaftar!')</script>";
        } else {
            $insert = "INSERT INTO user VALUES (NULL, '$nip', NULL, '$id_kelas', '$username', '$password', '$nama', '$role', '$jk', '$wa', '$alamat')";
            $ins = mysqli_query($koneksi, $insert);
            if ($ins){
                echo "<script>alert('Data guru Berhasil Ditambahkan!')
                window.location.replace('guru.php');</script>";
            }
        }
    } 
?>