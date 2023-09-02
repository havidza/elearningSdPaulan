<?php
require '../koneksi.php';
require 'function/session.php';
require 'function/statusBox.php';
require 'function/tambahMateri.php';
require 'function/updateMateri.php';
$query = mysqli_query($koneksi, "SELECT *, user.nama AS nama_guru, materi.id AS id_materi 
    FROM materi JOIN user ON materi.id_guru = user.id WHERE materi.id_guru = $id ORDER BY materi.id DESC");
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
                    <!-- Button trigger modal Upload -->
                    <button type="button" class="btn btn-primary btnInput mx-auto mb-3" data-bs-toggle="modal" data-bs-target="#uploadMateri">
                        <i class="fas fa-upload mx-2"></i>Upload Materi
                    </button>
                    <!-- Modal Upload -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="uploadMateri" tabindex="-1" aria-labelledby="uploadMateri" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Upload Materi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul style="list-style-type: none;">
                                            <li>
                                                <label for="file" class="me-3 fw-bold">Pilih File Materi</label>
                                                <input type="file" name="file" id="file" class="mb-2 form-control w-75">
                                            </li>
                                            <li>
                                                <label for="judul" class="fw-bold">Judul Materi</label>
                                                <input type="text" name="judul" id="judul" class="w-75 form-control w-75">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="uploadFile">Upload Materi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Modal Edit -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="editMateri" tabindex="-1" aria-labelledby="editMateri" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Materi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul style="list-style-type: none;">
                                            <input type="hidden" name="id_materi" id="id_materi_edit">
                                            <li>
                                                <label for="file" class="me-3 fw-bold">Pilih File Materi</label>
                                                <input type="file" name="file" id="file" class="mb-2 form-control w-75" required>
                                            </li>
                                            <li>
                                                <label for="judul" class="fw-bold">Judul Materi</label>
                                                <input type="text" name="judul" id="judul_materi_edit" class="w-75 form-control w-75">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="editFileMateri">Edit Materi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Content -->
                    <div class="table-responsive-xxl">
                        <table id="myTable" class="table table-bordered border-primary align-middle text-center  mx-auto" style="min-width: 1000px;">
                            <thead class="table-dark border-light">
                                <tr>
                                    <th style="width: 5%;">Nomor</th>
                                    <th style="width: 20%;">Guru</th>
                                    <th style="width: 35%;">Judul</th>
                                    <th style="width: 25%;">Nama File</th>
                                    <th style="width: 20%;">Uploaded</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-dark">
                                <?php
                                $no = 1;

                                while ($row = mysqli_fetch_array($query)) {
                                    echo '
                                      <tr>
                                        <td>' . $no++ . '</td>
                                        <td>' . $row['nama_guru'] . '</td>
                                        <td>' . $row['judul_materi'] . '</td>
                                        <td>' . $row['file_materi'] . '</td>
                                        <td>' . $row['tgl_dibuat'] . '</td>
                                        <td>
                                          <div class="d-flex justify-content-around">
                                            <form action="function/lihatMateri.php?file_materi=' . $row['file_materi'] . '" method="post">
                                              <button type="submit" class="btn btn-success"><i class="fas fa-download"></i></button>
                                            </form>
                                            <a href="#" 
                                            data-id="' . $row['id_materi'] . '"
                                            data-judul="' . $row['judul_materi'] . '"
                                            onclick="openModalEdit(this);"
                                            class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="function/hapusMateri.php?id=' . $row['id_materi'] . '" method="post">
                                              ' ?><button type="submit" class="btn btn-danger" onclick="return confirm('Hapus materi?')"><i class="fas fa-trash"></i></button><?php echo '
                                            </form> 
                                          </div>  
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

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };

        $('#myTable').DataTable();

        function openModalEdit(e) {
            var id = e.getAttribute('data-id');
            var judul = e.getAttribute('data-judul');
            console.log(id);
            $('#editMateri').modal('show');
            $('#id_materi_edit').val(id);
            $('#judul_materi_edit').val(judul);
        }
    </script>
</body>

</html>