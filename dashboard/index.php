<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    $_SESSION['toast_type'] = 'error';
    $_SESSION['toast_message'] = 'Silahkan login terlebih dahulu';
    header('location:../index.php');
    exit();
}
include '../koneksi.php';
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$query = $_SESSION['login_type'] == 'user' ? mysqli_query($koneksi, "SELECT*FROM user where username='$_SESSION[username]'") : mysqli_query($koneksi, "SELECT*FROM pegawai where nip='$_SESSION[nip]'");
$user = mysqli_fetch_assoc($query);
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RSU Khalishah</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- <style>
        .page-item.active .page-link {
            background-color: #5a5c69 !important;
            color: white !important;
            border-color: black !important;
        }
    </style> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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
    </script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

</head>

<body id="page-top">

    <?php
    if (isset($_SESSION['toast_type'])) {
        if ($_SESSION['toast_type'] == 'error') {


    ?>
            <script>
                toastr.error('<?= $_SESSION['toast_message'] ?>');
            </script>
        <?php
        } else if ($_SESSION['toast_type'] == 'success') {

        ?>
            <script>
                toastr.success('<?= $_SESSION['toast_message'] ?>');
            </script>
    <?php
        }
    }
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">
                    RSU Khalishah
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= $halaman == '' ? 'active' : '' ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php
            if ($_SESSION['login_type'] == 'user') {
            ?>

                <li class="nav-item <?= $halaman == 'pegawai' || $halaman == 'tambah-pegawai' || $halaman == 'ubah-pegawai' ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?halaman=pegawai">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Pegawai</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <!-- <li class="nav-item <?= $halaman == 'penilaian' || $halaman == 'tambah-penilaian' || $halaman == 'ubah-penilaian' ? 'active' : '' ?>">
                <a class="nav-link" href="index.php?halaman=penilaian">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Penilaian</span>
                </a>
            </li> -->

            <?php
            if ($user['level'] == 2 or $user['level'] == 3 or $_SESSION['login_type'] == 'nip') {
            ?>
                <li class="nav-item <?= $halaman == 'penilaian-pegawai' || $halaman == 'detail-penilaian-pegawai' || $halaman == 'tambah-penilaian-pegawai' || $halaman == 'ubah-penilaian-pegawai' ? 'active' : '' ?>">
                    <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#penilaian" aria-expanded="true" aria-controls="penilaian">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Penilaian</span>
                    </a>
                    <div id="penilaian" class="collapse <?= $halaman == 'penilaian-pegawai' || $halaman == 'tambah-penilaian-pegawai' || $halaman == 'detail-penilaian-pegawai' || $halaman == 'ubah-penilaian-pegawai' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Penilaian:</h6>
                            <a class="collapse-item <?= ($halaman == 'penilaian-pegawai' && $status == 'tetap') || ($halaman == 'tambah-penilaian-pegawai' && $status == 'tetap') || ($halaman == 'detail-penilaian-pegawai'  && $status == 'tetap') || ($halaman == 'ubah-penilaian-pegawai'  && $status == 'tetap') ? 'active' : '' ?>" href="index.php?halaman=penilaian-pegawai&status=tetap">Pegawai Tetap</a>
                            <a class="collapse-item  <?= ($halaman == 'penilaian-pegawai' && $status == 'kontrak') || ($halaman == 'tambah-penilaian-pegawai' && $status == 'kontrak') || ($halaman == 'detail-penilaian-pegawai'  && $status == 'kontrak') || ($halaman == 'ubah-penilaian-pegawai'  && $status == 'kontrak') ? 'active' : '' ?>" href="index.php?halaman=penilaian-pegawai&status=kontrak">Pegawai Kontrak</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item <?= $halaman == 'hasil-penilaian-pegawai' ? 'active' : '' ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hasilPenilaian" aria-expanded="true" aria-controls="hasilPenilaian">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Hasil Penilaian</span>
                    </a>
                    <div id="hasilPenilaian" class="collapse <?= $halaman == 'hasil-penilaian-pegawai' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Hasil Penilaian:</h6>
                            <a class="collapse-item <?= $halaman == 'hasil-penilaian-pegawai' && $status == 'tetap' ? 'active' : '' ?>" href="index.php?halaman=hasil-penilaian-pegawai&status=tetap">Pegawai Tetap</a>
                            <a class="collapse-item <?= $halaman == 'hasil-penilaian-pegawai' && $status == 'kontrak' ? 'active' : '' ?>" href="index.php?halaman=hasil-penilaian-pegawai&status=kontrak">Pegawai Kontrak</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#keputusan" aria-expanded="true" aria-controls="keputusan">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Keputusan</span>
                    </a>
                    <div id="keputusan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Keputusan:</h6>
                            <a class="collapse-item" href="index.php?halaman=keputusan-pegawai-tetap">Pegawai Tetap</a>
                            <a class="collapse-item" href="index.php?halaman=keputusan-pegawai-kontrak">Pegawai Kontrak</a>
                        </div>
                    </div>
                </li>
            <?php
            }
            ?>

            <?php
            if ($user['level'] == 1) {

            ?>
                <li class="nav-item <?= $halaman == 'kriteria' || $halaman == 'tambah-kriteria' || $halaman == 'ubah-kriteria' ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?halaman=kriteria">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Kriteria</span>
                    </a>
                </li>

                <li class="nav-item <?= $halaman == 'user' || $halaman == 'tambah-user' || $halaman == 'ubah-user' ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?halaman=user">
                        <i class="fas fa-fw fa-user-cog"></i>
                        <span>User</span>
                    </a>
                </li>
            <?php } ?>



            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a href="../proses_autentikasi.php?aksi=logout" class="nav-link">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['login_type'] == 'user' ?  $user['nama']  : $user['nama_pegawai'] ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php
                    if ($halaman == '') {
                        include './home.php';
                    } else if ($halaman == 'pegawai') {
                        include './pegawai.php';
                    } else if ($halaman == 'tambah-pegawai') {
                        include './tambah_pegawai.php';
                    } else if ($halaman == 'ubah-pegawai') {
                        include './ubah_pegawai.php';
                    } else if ($halaman == 'user') {
                        include './user.php';
                    } else if ($halaman == 'tambah-user') {
                        include './tambah_user.php';
                    } else if ($halaman == 'ubah-user') {
                        include './ubah_user.php';
                    } else if ($halaman == 'kriteria') {
                        include './kriteria.php';
                    } else if ($halaman == 'tambah-kriteria') {
                        include './tambah_kriteria.php';
                    } else if ($halaman == 'ubah-kriteria') {
                        include './ubah_kriteria.php';
                    } else if ($halaman == 'penilaian-pegawai') {
                        include './penilaian_pegawai.php';
                    } else if ($halaman == 'tambah-penilaian-pegawai') {
                        include './tambah_penilaian_pegawai.php';
                    } else if ($halaman == 'ubah-penilaian-pegawai') {
                        include './ubah_penilaian_pegawai.php';
                    } else if ($halaman == 'detail-penilaian-pegawai') {
                        include './detail_penilaian_pegawai.php';
                    } else if ($halaman == 'hasil-penilaian-pegawai') {
                        include './hasil_penilaian_pegawai.php';
                    }
                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RSU Khalishah 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php
    if (isset($_SESSION['toast_type'])) {
        unset($_SESSION['toast_type']);
        unset($_SESSION['toast_message']);
    }
    ?>


    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

</body>

</html>