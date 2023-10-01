<?php
require '../koneksi.php';
require 'function/session.php';
require 'function/statusBox.php';
require 'function/tambahMateri.php';
require 'function/updateMateri.php';
$me = $_SESSION['id'];
$sql_id = "SELECT * FROM user WHERE id = '$me'";
$query_id = mysqli_query($koneksi, $sql_id);
$row_id = mysqli_fetch_assoc($query_id);
$id_kelas = $row_id['id_kelas'];
$nama_kelas = "SELECT * FROM kelas WHERE id = '$id_kelas'";
$query_kelas = mysqli_query($koneksi, $nama_kelas);
$row_kelas = mysqli_fetch_assoc($query_kelas);
$nama_kelass = $row_kelas['nama'];

$query = mysqli_query($koneksi, "SELECT *, user.nama as nama_siswa, user.role, kelas.nama as nama_kelas, user.id as id_user, nilai.id as id_nilai
FROM user
LEFT JOIN kelas ON user.id_kelas = kelas.id
LEFT JOIN nilai ON user.id = nilai.id_siswa
WHERE user.role = 'Siswa' AND kelas.nama = '$nama_kelass'");
// var_dump(mysqli_fetch_array($query));
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

    <title>Kelola Mapel</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="d-flex" id="wrapper">
        <div class="bg-3" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 warna-1 fs-4 fw-bold text-uppercase">
                <i class="fas fa-book me-2"></i>E-Learning
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="index.php" class="list-group-item list-group-item-action bg-transparent fw-bold warna-1">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="materi.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold active-bar">
                    <i class="fas fa-book-reader me-2"></i>Kelola Mapel</a>
                <a href="tugas.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-tasks me-2"></i>Kelola Tugas</a>
                <a href="nilai.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-chart-bar me-2"></i>Nilai Siswa</a>
                <a href="siswa.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-users-cog me-2"></i>Kelola Siswa</a>
                <a href="raport.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-book me-2"></i>Raport Siswa</a>
                <a href="setting.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-users-cog me-2"></i>Pengaturan Akun</a>
                <a href="../logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="return confirm('Keluar ?')">
                    <i class="fas fa-power-off me-2"></i>Keluar</a>
            </div>
        </div>
        <!-- Status Bar -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-2 py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left warna-1 fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 warna-1">Kelola Materi</h2>
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

                    <div class="col-md-4">
                        <div class="p-3 bg-1 shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $rowSiswa ?></h3>
                                <p class="fs-5 fw-bold">Siswa</p>
                            </div>
                            <i class="fas fa-users fs-1 warna-1 rounded-full bg-2 p-3"></i>
                        </div>
                    </div>
                </div>
                <hr class="bg-white hr">
                <!-- Upload -->
                <div class="row my-5">
                    <!-- Content -->
                    <div class="table-responsive-xxl">
                        <table id="myTable" class="table table-bordered border-primary align-middle text-center  mx-auto" style="min-width: 1000px;">
                            <thead class="table-dark border-light">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 20%;">Nama Siswa</th>
                                    <th style="width: 20%;">Nama Kelas</th>
                                    <th style="width: 35%;">Mata Pelajaran</th>
                                    <th style="width: 25%;">Tugas</th>
                                    <th style="width: 20%;">Nilai</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-dark">


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };

        // $('#myTable').DataTable();

        toastr.options = {

            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        $(function() {
            var table = $('#myTable').DataTable({
                "ajax": {
                    "url": "function/dataMenuRaport.php",
                    "method": "POST",
                    "data": {},
                    "dataSrc": 'result'
                },
                "responsive": true,
                "columns": [{
                    "data": "no"
                }, {
                    "data": "nama_siswa"
                }, {
                    "data": "nama_kelas"
                }, {
                    "data": "judul_materi"
                }, {
                    "data": "judul"
                }, {
                    "data": "nilai"
                }, {
                    "data": "aksi_rek"
                }, ]
            });
        })

        function printData(id_user) {
            // console.log(id_user);
            $.ajax({
                type: "POST",
                url: "function/printRaport.php",
                data: {
                    id: id_user
                },
                success: function(result) {
                    // var data = eval('(' + data + ')');
                    console.log(result)
                    if (result === 'not_found') {
                        toastr.error("Gagal cetak !", 'Error');
                    } else {
                        window.open('./../pdf/' + result + '.pdf', '_blink');
                    }

                }
            });
        }
    </script>
</body>

</html>