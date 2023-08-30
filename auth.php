<?php
require 'koneksi.php';
// SIGN UP
if (isset($_POST["signUp"])) {
    $id = $_POST["id"];
    $status = $_POST["user"];
    $pass = $_POST["password"];
    $nama = $_POST["nama"];
    $jk = $_POST["jk"];
    $wa = $_POST["wa"];
    $alamat = $_POST["alamat"];

    $signup = "INSERT INTO user VALUES ('$id',md5('$pass'),'$nama','$jk','$wa','$alamat','$status')";
    mysqli_query($koneksi, $signup);
}

// SIGN IN
if (isset($_POST["signIn"])) {
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $signin = "SELECT * FROM user WHERE username='$username' AND password=md5('$pass')";
    $result = mysqli_query($koneksi, $signin);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_array($result);
        var_dump($row);
        if ($row > 0) {
            // Set Session
            session_start();
            $_SESSION['id'] = $row['id'];
            if ($row["role"] == "Siswa") {
                $_SESSION["siswa"] = true;
                header("Location:siswa/index.php");
            } else if ($row["role"] == "Guru") {
                $_SESSION["guru"] = true;
                header("Location:guru/index.php");
            } else {
                $_SESSION["admin"] = true;
                header("Location:admin/index.php");
            }
            exit;
        }
    }
    $error = true;
    if (isset($error)) {
?>
        <script>
            alert("Username/Password salah!");
        </script>
<?php
    }
}
?>