<?php
    require '../koneksi.php';
    require 'function/session.php';
    require 'function/statusBox.php';
    require 'function/tambahSiswa.php';
    require 'function/updateSiswa.php';
    $sqlUser = "SELECT * FROM user WHERE role = 'Siswa'";
    $query = mysqli_query($koneksi, $sqlUser);
    $query_kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
    $kelas = array();
    while ($row = mysqli_fetch_assoc($query_kelas)){
        array_push($kelas, $row);
    }
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
    <title>Kelola Siswa</title>
</head>

<body>
<!-- Sidebar -->
<div class="d-flex" id="wrapper">
        <div class="bg-3" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 warna-1 fs-4 fw-bold text-uppercase">
            <i class="fas fa-book me-2"></i>E-Learning</div>
            <div class="list-group list-group-flush my-3">
                <a href="index.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>Beranda</a>
                <a href="materi.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-book-reader me-2"></i>Kelola Mapel</a>
                    <a href="kelas.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-tasks me-2"></i>Kelola Kelas</a>
                <!-- <a href="tugas.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-tasks me-2"></i>Kelola Tugas</a>
                <a href="nilai.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-chart-bar me-2"></i>Nilai Siswa</a> -->
                <a href="siswa.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold active-bar">
                    <i class="fas fa-users-cog me-2"></i>Kelola Siswa</a>
                <a href="guru.php" class="list-group-item list-group-item-action bg-transparent warna-1 fw-bold">
                    <i class="fas fa-users-cog me-2"></i>Kelola Guru</a>
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
                    <h2 class="fs-2 m-0 warna-1">Kelola Siswa</h2>
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
                            <i
                                class="fas fa-tasks fs-1 warna-1 rounded-full bg-2 p-3"></i>
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
                    <div class="col-md-4">
                        <div class="p-3 bg-1 shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $rowGuru ?></h3>
                                <p class="fs-5 fw-bold">Guru</p>
                            </div>
                            <i class="fas fa-users fs-1 warna-1 rounded-full bg-2 p-3"></i>
                        </div>
                    </div>
                </div>
                <hr class="bg-white hr">
<!-- Content -->
                <div class="row my-5">
                  <!-- Button trigger modal tambah Siswa -->
                  <button type="button" class="btn btn-primary btnInput mx-auto mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
                        <i class="fas fa-plus mx-2"></i>Tambah Siswa
                  </button>
                  <!-- Modal tambah -->
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-labelledby="modalTambahSiswa" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul style="list-style-type: none;">
                                        <li>
                                            <label for="nama" class="me-3 fw-bold">Nama Siswa</label>
                                            <input type="nama" name="nama" id="nama" class="mb-2 form-control w-75" required>
                                        </li>
                                        <li>
                                            <label for="nis" class="fw-bold">NIS</label>
                                            <input type="text" name="nis" id="nis" class="w-75 form-control w-75" required>
                                        </li>
                                        <li>
                                            <label for="judul" class="me-5 fw-bold d-block">Pilih kelas</label>
                                            <select class="form-select w-75" name="id_kelas" id="kelas" required>
                                                <option selected disabled value="">Pilih kelas</option>
                                                <?php foreach ($kelas as $row) : ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </li>
                                        <li>
                                            <label for="username" class="fw-bold">username<br><small class="text-warning text-sm">(untuk login & password otomasis generate 123456)</small></label>
                                            <input type="text" name="username" id="username" class="w-75 form-control w-75" required>
                                        </li>
                                        <li>
                                            <label for="jk" class="fw-bold">Jenis Kelamin</label>
                                            <select name="jk" id="jk" class="w-75 form-select w-75" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </li>
                                        <li>
                                            <label for="wa" class="fw-bold">Nomor Wa</label>
                                            <input type="number" name="wa" id="wa" class="w-75 form-control w-75" required>
                                        </li>
                                        <li>
                                            <label for="alamat" class="fw-bold">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="w-75 form-control w-75" required></textarea>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="tambahSiswa">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </form>
                  <!-- Modal edit -->
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal fade" id="modalEditSiswa" tabindex="-1" aria-labelledby="modalEditSiswa" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul style="list-style-type: none;">
                                        
                                            <input type="hidden" name="id" id="id_edit" class="mb-2 form-control w-75" required>
                                       
                                        <li>
                                            <label for="nama" class="me-3 fw-bold">Nama Siswa</label>
                                            <input type="nama" name="nama" id="nama_edit" class="mb-2 form-control w-75" required>
                                        </li>
                                        <li>
                                            <label for="nis" class="fw-bold">NIS</label>
                                            <input type="text" name="nis" id="nis_edit" class="w-75 form-control w-75" required>
                                        </li>
                                        <li>
                                            <label for="judul" class="me-5 fw-bold d-block">Pilih kelas</label>
                                            <select class="form-select w-75" name="id_kelas" id="kelas_edit" required>
                                                <option selected disabled value="">Pilih kelas</option>
                                                <?php foreach ($kelas as $row) : ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </li>
                                        <li>
                                            <label for="username" class="fw-bold">username<br><small class="text-warning text-sm">(untuk login & password tidak berubah)</small></label>
                                            <input type="text" name="username" id="username_edit" class="w-75 form-control w-75" required>
                                        </li>
                                        <li>
                                            <label for="jk" class="fw-bold">Jenis Kelamin</label>
                                            <select name="jk" id="jk_edit" class="w-75 form-select w-75" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </li>
                                        <li>
                                            <label for="wa" class="fw-bold">Nomor Wa</label>
                                            <input type="number" name="wa" id="wa_edit" class="w-75 form-control w-75" required>
                                        </li>
                                        <li>
                                            <label for="alamat" class="fw-bold">Alamat</label>
                                            <textarea name="alamat" id="alamat_edit" cols="30" rows="5" class="w-75 form-control w-75" required></textarea>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="updateSiswa">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </form>
                    <div class="table-responsive-xxl">
                        <table id="myTable" class="table table-bordered border-primary align-middle text-center  mx-auto" style="min-width: 1000px;">
                            <thead class="table-dark border-light">
                                <tr>
                                    <th style="width: 10%;">NIS</th>
                                    <th style="width: 25%;">Nama Siswa</th>
                                    <th style="width: 25%;">Kelas</th>
                                    <th style="width: 5%;">JK</th>
                                    <th style="width: 10%;">Nomer WA</th>
                                    <th style="width: 40%;">Alamat</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-dark">
                            <?php
                           

                                    while ($row = mysqli_fetch_array($query)){
                                      $row_kelas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * 
                                      FROM kelas WHERE id = '$row[id_kelas]'"));
                                      $row['nama_kelas'] = $row_kelas['nama'];
                                      $row['id_kelas'] = $row_kelas['id'];

                                        echo '
                                        <tr>
                                          <td>'.$row['nis'].'</td>
                                          <td>'.$row['nama'].'</td>
                                          <td>'.$row['nama_kelas'].'</td>
                                          <td>'.$row['jk'].'</td>
                                          <td>'.$row['wa'].'</td>
                                          <td>'.$row['alamat'].'</td>
                                          <td>
                                          <div class="d-flex justify-content-center">
                                            <a href="#" 
                                              data-id="'.$row['id'].'"
                                              data-nama="'.$row['nama'].'"
                                              data-nis="'.$row['nis'].'"
                                              data-kelas="'.$row['id_kelas'].'"
                                              data-username="'.$row['username'].'"
                                              data-jk="'.$row['jk'].'"
                                              data-wa="'.$row['wa'].'"
                                              data-alamat="'.$row['alamat'].'"
                                              onclick="openModalEdit(this);"
                                              class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                              <form action="function/hapusUser.php?id='.$row['id'].'" method="post">
                                                  '?><button type="submit" class="btn btn-danger" onclick="return confirm('Hapus siswa ?')"><i class="fas fa-trash me-2]"></i></button><?php echo '
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

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        $('#myTable').DataTable();

        function openModalEdit(e){
          var id = e.getAttribute('data-id');
          var nama = e.getAttribute('data-nama');
          var nis = e.getAttribute('data-nis');
          var kelas = e.getAttribute('data-kelas');
          var username = e.getAttribute('data-username');
          var jk = e.getAttribute('data-jk');
          var wa = e.getAttribute('data-wa');
          var alamat = e.getAttribute('data-alamat');

          $('#modalEditSiswa').modal('show');
          $('#id_edit').val(id);
          $('#nama_edit').val(nama);
          $('#nis_edit').val(nis);
          $('#kelas_edit').val(kelas);
          $('#username_edit').val(username);
          $('#jk_edit').val(jk);
          $('#wa_edit').val(wa);
          $('#alamat_edit').val(alamat);

        }
    </script>
</body>
</html>