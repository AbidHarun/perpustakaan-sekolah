<?php
error_reporting(0);
  session_start();
  
  $koneksi = new mysqli("localhost","root","","db_perpustakaan");

  $jumlah_buku = $koneksi->query("SELECT * FROM tb_buku");
  $jumlah_transaksi = $koneksi->query("SELECT * FROM tb_transaksi");

  $tanggal = date("Y-m-d");
  $jumlah_pengunjung = $koneksi->query("SELECT * FROM tb_pengunjung where tanggal='$tanggal'");
  $jumlah_anggota = $koneksi->query("SELECT * FROM tb_anggota");

  $jbuku = mysqli_num_rows($jumlah_buku);
  $jtransaksi = mysqli_num_rows($jumlah_transaksi);
  $jpengunjung = mysqli_num_rows($jumlah_pengunjung);
  $janggota = mysqli_num_rows($jumlah_anggota);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan SMP Negeri 2 Suwawa</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style-landing-page.css">

</head>
<body id="home">

<section id="nav">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

          <a class="navbar-brand page-scroll" href="#home"><span class="tulisan-warna-biru">Sisfo</span><span class="tulisan-warna-pink"> Perpustakaan</span></a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link page-scroll" href="#home">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#tabel">KATALOG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#features">ABOUT</a>
              </li>
              <li class="nav-item">
                <a class="btn btn-info" href="/perpustakaansbadmin/login.php" tabindex="-1" aria-disabled="true">LOG IN</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
</section> 

<section id="banner">
    <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FFF" fill-opacity="1" d="M0,224L120,240C240,256,480,288,720,266.7C960,245,1200,171,1320,133.3L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="title">SMP Negeri 2 Suwawa</h4>
                    <p>Perpustakaan di Sekolah ini menjadi pusat literasi dari sekolah dengan memiliki koleksi sebanyak 2.228 buku yang terdiri dari buku pelajaran, fiksi dan non fiksi.</p>
                    <a class="btn btn-info page-scroll" href="#tabel">Lihat Buku</a>

                </div>

                <div class="col-md-6">
                    <img src="assets/img/awal.png" class="ban-img img-fluid">
                </div>
            </div>
        </div>        
    </div>
</section>

<!-- Tabel -->
<section id="tabel">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 gambar-katalog">
<!--                 <img src="assets/img/katalog.png" class="img-fluid"> -->    
            </div>

            <div class="col-md-4">
                <h2 class="text-center">Katalog Buku</h2>
            </div>

            <div class="col-md-4">
            </div>
        </div>
        <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Jenis Buku</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $no = 1;

                            $sql = $koneksi->query("SELECT * from tb_buku order by pinjam desc");

                            while ($data= $sql->fetch_assoc()) {

                        ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><img src="uploud/<?= $data['foto']; ?>" alt="gambar" width="100"></td>
                            <td><?php echo $data['judul'];?></td>
                            <td><?php echo $data['pengarang'];?></td>
                            <td><?php echo $data['penerbit'];?></td>
                            <td><?php echo $data['tahun_terbit'];?></td>
                            <td><?php echo $data['jenis'];?></td>
                        </tr>


                        <?php  } ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- tentang -->
<section id="features">
    <div class="container">
        <h4 class="text-center">Tentang SMP Negeri 2 Suwawa</h4>
        <div class="row text-center">
            <div class="col-md-4 features">
                <img src="assets/img/icon-sekolah.png" class="img-fluid">
                <p style="margin-top: 25px; color: #4188E4;">Beridiri sejak 2018, SMP Negeri 2 Suwawa saat ini merupakan sekolah dengan jumlah siswa terbanyak se-Kabupaten Bone Bolango dan memiliki akreditasi B.</p>    
            </div>

            <div class="col-md-4 features">
                <img src="assets/img/icon-buku.png" class="img-fluid">
                <p style="margin-top: 25px; color: #4188E4;">Memiliki koleksi buku sebanyak 2.228 buku yang terdiri dari buku pelajaran, fiksi, dan non fiksi.</p>    
            </div>

            <div class="col-md-4 features">
                <img src="assets/img/icon-maps.png" class="img-fluid">
                <p style="margin-top: 25px; color: #4188E4;">Bertempat di Jl. Makam Pahlawan H. Nani Waratabone, Desa Bube, Suwawa, Bone Bolango, Provinsi Gorontalo.</p>    
            </div>
        </div>
    </div>
</section>




<section id="footer">
    <div class="container">
        <p class="text-center">Copyright Perpustakaan SMP Negeri 2 Suwawa</p>        
    </div>
    
</section>

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
        <script src="assets/js/smooth-scrol.js"></script>

</body>