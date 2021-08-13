<?php
error_reporting(0);
  session_start();
  
  $koneksi = new mysqli("localhost","root","","db_perpustakaan");
  $tanggal = date("d-m-Y");
  $bulan = date('m');
  $tahun = date('Y');
  $tgltahun = date("Y-m-d");
  $jumlah_buku = $koneksi->query("SELECT * FROM tb_buku");
  
  $jumlah_transaksi = $koneksi->query("SELECT * FROM tb_transaksi WHERE month(tgl_input)='$bulan' AND year(tgl_input)='$tahun' ");

  
  $jumlah_pengunjung = $koneksi->query("SELECT * FROM tb_pengunjung where tanggal='$tgltahun'");
  $jumlah_anggota = $koneksi->query("SELECT * FROM tb_anggota");

  
  $jbuku = mysqli_num_rows($jumlah_buku);
  $jtransaksi = mysqli_num_rows($jumlah_transaksi);
  $jpengunjung = mysqli_num_rows($jumlah_pengunjung);
  $janggota = mysqli_num_rows($jumlah_anggota);

  include "function.php";

  if($_SESSION['admin'] || $_SESSION['petugas']){

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Perpustakaan SMPN 2 Suwawa- Dashboard</title>
        
        <!-- Custom fonts for this template-->
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      

        <!-- Custom styles for this template-->
         <link rel="stylesheet" href="assets/dist/css/select2.min.css">
        <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
               
        <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  

        

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <div class="sidebar-brand-text mx-3">Sisfo Perpustakaan</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Data
                </div>
                
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="?page=pengunjung">
                        <i class="fas fa-fw fa-address-book"></i>
                        <span>Pengunjung</span></a>
                </li>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Data Master</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="?page=buku">Data Buku</a>
                            <a class="collapse-item" href="?page=anggota">Data Anggota</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?page=transaksi">
                        <i class="fas fa-fw fa-clipboard-list"></i>
                        <span>Data Transaksi</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Laporan
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Laporan</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="?page=buku&aksi=cetak">Laporan Buku</a>
                            <a class="collapse-item" href="?page=anggota&aksi=cetak">Laporan Anggota</a>
                            <a class="collapse-item" href="?page=pengunjung&aksi=cetak">Laporan Pengunjung</a>
                            <a class="collapse-item" href="?page=transaksi&aksi=cetak">Laporan Transaksi</a>
                           
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

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

                        <!-- Topbar Search -->
                        
                        <div class="container">
                            <h4>Perpustakaan SMP Negeri 2 Suwawa</h4>
                        </div>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if ($_SESSION['petugas']) {?>
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Petugas</span>
                            <?php   } ?>
                            <?php if ($_SESSION['admin']) {?>
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                            <?php   } ?>

                                    <img class="img-profile rounded-circle"
                                        src="assets/img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <?php

            $page = $_GET['page'];
            $aksi = $_GET['aksi'];


            if ($page == "buku" && $_SESSION['admin']) {
                if ($aksi == "") {
                    include "page/buku/buku.php";
                      }elseif ($aksi== "tambah") {
                    include "page/buku/tambah.php";
                }elseif ($aksi== "ubah") {
                    include "page/buku/ubah.php";
                }elseif ($aksi== "hapus") {
                    include "page/buku/hapus.php";
                }elseif ($aksi== "cetak") {
                    include "page/buku/form_laporan_buku.php";
                }
            }elseif ($page == "buku" && $_SESSION['petugas']) {
                if ($aksi == "") {
                    include "page/buku/buku.php";
                }elseif ($aksi== "cetak") {
                    include "page/buku/form_laporan_buku.php";
                }

            }elseif ($page == "anggota" && $_SESSION['admin']) {
                if ($aksi == "") {
                    include "page/anggota/anggota.php";
                }elseif ($aksi == "tambah") {
                    include "page/anggota/tambah.php";
                }elseif ($aksi == "ubah") {
                    include "page/anggota/ubah.php";
                }elseif ($aksi == "hapus") {
                    include "page/anggota/hapus.php";
                }elseif ($aksi== "cetak") {
                    include "page/anggota/form_laporan_anggota.php";
                }
            }elseif ($page == "anggota" && $_SESSION['petugas']) {
                if ($aksi == "") {
                    include "page/anggota/anggota.php";
                }elseif ($aksi== "cetak") {
                    include "page/anggota/form_laporan_anggota.php";
                }

            }elseif ($page == "transaksi" && $_SESSION['admin']) {
                if ($aksi == "") {
                    include "page/transaksi/transaksi.php";
                }elseif ($aksi == "tambah") {
                    include "page/transaksi/tambah.php";
                }elseif ($aksi == "kembali") {
                    include "page/transaksi/kembali.php";
                }elseif ($aksi == "perpanjang") {
                    include "page/transaksi/perpanjang.php";
                }elseif ($aksi== "cetak") {
                    include "page/transaksi/form_laporan_transaksi.php";
                }
            }elseif ($page == "transaksi" && $_SESSION['petugas']) {
                if ($aksi == "") {
                    include "page/transaksi/transaksi.php";
                }elseif ($aksi== "cetak") {
                    include "page/transaksi/form_laporan_transaksi.php";
                }
            // }elseif ($page == "pengguna" ) {
       //          if ($aksi == "") {
       //              include "page/pengguna/pengguna.php";
       //          }elseif ($aksi == "tambah") {
       //              include "page/pengguna/tambah.php";
       //          }elseif ($aksi == "ubah") {
       //              include "page/pengguna/ubah.php";
       //          }elseif ($aksi == "hapus") {
       //              include "page/pengguna/hapus.php";
       //          }
            }elseif($page == "pengunjung" && $_SESSION['admin']){
                 if ($aksi == "") {
                    include "page/pengunjung/pengunjung.php";
                }elseif ($aksi == "tambah") {
                    include "page/pengunjung/tambah.php";
                }elseif ($aksi == "ubah") {
                    include "page/pengunjung/ubah.php";
                }elseif ($aksi == "hapus") {
                    include "page/pengunjung/hapus.php";
                }elseif ($aksi== "cetak") {
                    include "page/pengunjung/form_laporan_pengunjung.php";
                }
            }elseif($page == "pengunjung" && $_SESSION['petugas']){
                 if ($aksi == "") {
                    include "page/pengunjung/pengunjung.php";
                }elseif ($aksi== "cetak") {
                    include "page/pengunjung/form_laporan_pengunjung.php";
                }
            }

            elseif ($page=="") {
                include "home.php";
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
                            <span>Sistem Informasi Perpustakaan SMP Negeri 2 Suwawa</span>
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

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">LOG OUT ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Yakin ingin keluar ?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="logout.php">Keluar</a>
                    </div>      
                </div>
            </div>
        </div>

        

        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="assets/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="assets/js/demo/chart-area-demo.js"></script>
        <script src="assets/js/demo/chart-pie-demo.js"></script>

        <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="assets/js/demo/datatables-demo.js"></script>
        <script src="assets/dist/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.selek2').select2();
            }); 
        </script>

    </body>

    </html>

<?php
  }else{
      header("location:login.php");
  }
?>
