<?php
	require 'koneksi.php';
	// Cek Session
 var_dump($_SESSION);
    if (isset($_SESSION["guru"])){
        header("Location : guru/index.php");
    }
    else if (isset($_SESSION["siswa"])){
        header("Location : siswa/index.php");
    }
    else if (isset($_SESSION["admin"])){
        header("Location : admin/index.php");
    }
    else{
        header("Location: gate.php");
        exit;
    }
?>
