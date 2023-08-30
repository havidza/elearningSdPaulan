<?php
    if (isset($_POST["uploadFile"])){
        $judulMateri = $_POST["judul"];
        
        $namaAsli = $_FILES['file']['name'];
        $x = explode('.',$namaAsli);
        $eks = strtolower(end($x));
        $asal = $_FILES['file']['tmp_name'];
        $dir = "../uploadMateri/";
        $nama = uniqid();
        $nama .= '.'.$eks;
        $targetFile = $dir.$nama;
        $uploadOk = 1;
        // $sql_guru = mysqli_query($koneksi, "SELECT id FROM user WHERE id='$id'");
        // $row_guru = mysqli_fetch_array($sql_guru);
        $id_guru = $_POST["id_guru"];
        // Cek apakah file sudah ada difolder ?
        if (file_exists($targetFile)){
            $uploadOk = 0;
        }
        // Cek Proses Upload
        if ($uploadOk == 0){
            echo '<script>alert("File sudah ada!");</script>';
        }
        else {
            if (move_uploaded_file($asal, $targetFile)){
                $insertFile = "INSERT INTO materi VALUES (NULL, '$id_guru', '$judulMateri', '$nama', NOW())";
                $ins = mysqli_query($koneksi, $insertFile);
                if ($ins){
                    echo "<script>alert('Proses Upload Berhasil!')
                    window.location.replace('materi.php');</script>";
                }
            } else {
                echo '<script>alert("Proses Upload GAGAL!");</script>';
            }
        }
    }
?>