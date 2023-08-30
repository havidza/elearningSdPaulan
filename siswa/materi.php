<?php
    require '../koneksi.php';
    require 'function/session.php';
    require 'function/statusBox.php';
    $me = $_SESSION['id'];
    $sql_id = "SELECT * FROM user WHERE id = '$me'";
    $query_id = mysqli_query($koneksi, $sql_id);
    $row_id = mysqli_fetch_assoc($query_id);
    $id_kelas = $row_id['id_kelas'];
    $query = mysqli_query($koneksi, "SELECT *, user.nama AS nama_guru , kelas.nama AS nama_kelas
    FROM materi JOIN user ON materi.id_guru=user.id
    JOIN kelas ON user.id_kelas=kelas.id
    WHERE kelas.id = '$id_kelas' ORDER BY materi.id DESC");
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css" />
    <title>Dashboard</title>
</head>

<body>
<!-- Sidebar -->
    <div class="d-flex" id="wrapper">
        <div class="bg-3" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 warna-1 fs-4 fw-bold text-uppercase">
            <i class="fas fa-book me-2"></i>E-Learning</div>
            <div class="list-group list-group-flush my-3">
                <a href="index.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="materi.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold active-bar">
                    <i class="fas fa-book-reader me-2"></i>Materi</a>
                <a href="tugas.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-tasks me-2"></i>Tugas</a>
                <a href="nilai.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-chart-bar me-2"></i>Nilai</a>
                <a href="setting.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-users-cog me-2"></i>Pengaturan Akun</a>
                <a href="../logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"
                onclick="return confirm('Keluar ?')">
                    <i class="fas fa-power-off me-2"></i>Keluar</a>
            </div>
        </div>
<!-- Status Bar -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-2 py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left warna-1 fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 warna-1">Materi</h2>
                </div>
            </nav>
            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-4">
                        <div class="p-3 bg-1 shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $rowMateri ?></h3>
                                <p class="fs-5 fw-bold" name>Materi</p>
                            </div>
                            <i class="fas fa-book-reader fs-1 warna-1 rounded-full bg-2 p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-1 shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $rowTugas ?></h3>
                                <p class="fs-5 fw-bold">Tugas</p>
                            </div>
                            <i class="fas fa-tasks fs-1 warna-1 rounded-full bg-2 p-3"></i>
                        </div>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="p-3 bg-1 shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $rowSiswa ?></h3>
                                <p class="fs-5 fw-bold">Siswa</p>
                            </div>
                            <i class="fas fa-users fs-1 warna-1 rounded-full bg-2 p-3"></i>
                        </div>
                    </div> -->
                </div>
                <hr class="bg-white hr">
<!-- Content -->
                <div class="row my-5">
                    <div class="table-responsive-xxl">
                        <table id="myTable" class="table table-bordered border-primary align-middle text-center  mx-auto" style="min-width: 1000px;">
                            <thead class="table-dark border-light">
                                <tr>
                                    <th style="width: 10%;">Guru</th>
                                    <th style="width: 35%;">Kelas</th>
                                    <th style="width: 35%;">Mata Pelajaran</th>
                                    <th style="width: 35%;">Nama File</th>
                                    <th style="width: 10%;">Uploaded</th>
                                    <th style="width: 10%;">Download</th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-dark">
                                <?php
                                    while ($row = mysqli_fetch_array($query)){
                                        echo '
                                        <tr>
                                        <td>'.$row['nama_guru'].'</td>
                                        <td>'.$row['nama_kelas'].'</td>
                                        <td>'.$row['judul_materi'].'</td>
                                        <td>'.$row['file_materi'].'</td>
                                        <td>'.$row['tgl_dibuat'].'</td>
                                        <td>
                                        <form action="function/downloadMateri.php?file_materi='.$row['file_materi'].'" method="post">
                                            '?><button type="submit" class="btn btn-primary" ><i class="fas fa-download"></i></button><?php echo '
                                        </form>
                                        </td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<!-- Footer -->
      <footer class="footer mt-auto pb-4 bg-transparant fixed-bottom">   
          <div class="container-fluid">
              <span class="text-muted">NUSA MANDIRI &copy 2023</span>
          </div>
      </footer>
        </div>
    </div>
<!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        $('#myTable').DataTable();
    </script>
</body>
</html>