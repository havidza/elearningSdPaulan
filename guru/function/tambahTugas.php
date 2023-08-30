<?php
    if (isset($_POST["tambahTugas"])){
        $judul = $_POST["judul"];
        $id_materi = $_POST["id_materi"];
        $sql_guru = mysqli_query($koneksi, "SELECT id FROM user WHERE id='$id'");
        $row_guru = mysqli_fetch_array($sql_guru);
        $id_guru = $row_guru['id'];
        // var_dump($id_materi);
        
        $insertTugas = "INSERT INTO tugas VALUES (NULL, '$id_guru', '$id_materi', '$judul')";
        $ins = mysqli_query($koneksi, $insertTugas);
        if ($ins){
            echo "<script>alert('Tugas berhasil ditambahkan!')
            window.location.replace('tugas.php');</script>";
        }
        else {
            echo "<script>alert('Tugas gagal ditambahkan!')
            window.location.replace('tugas.php');</script>";
        }

    }
?>