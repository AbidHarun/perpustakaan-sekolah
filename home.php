<!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-start mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                            <?php if ($_SESSION['admin']) {?>
                              <span class="mr-2 d-none d-lg-inline text-gray-600"> &nbsp;&nbsp;|&nbsp;&nbsp; Selamat Datang Admin</span>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Tanggal</a> -->
                            <?php   } ?>
                            <?php if ($_SESSION['petugas']) {?>
                              <span class="mr-2 d-none d-lg-inline text-gray-600"> &nbsp;&nbsp;|&nbsp;&nbsp; Selamat Datang Petugas</span>
                            <?php   } ?>
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total Buku</div>
                                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?php print_r($jbuku); ?> Buku</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-book fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Peminjaman & Pengembalian Bulan Ini</div>
                                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?php print_r($jtransaksi); ?> Transaksi</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Pengunjung Hari Ini</div>
                                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?php print_r($jpengunjung) ?> Siswa</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-address-book fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="sidebar-divider">
                        <br>
                        <!-- Content Row -->
                        <div class="row">

                            <!-- Area Chart -->
                            <div class="col-xl-7 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Buku Yang Sering Dipinjam</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="?page=buku">Lihat Semua</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                      <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                          <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Judul</th>
                                              <th>Pengarang</th>
                                              <th>Penerbit</th>
                                              <th>Peminat</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php

                                                $no = 1;

                                                $sql = $koneksi->query("SELECT * from tb_buku ORDER BY pinjam DESC LIMIT 0,3");

                                                while ($data= $sql->fetch_assoc()) {

                                            ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $data['judul'];?></td>
                                                    <td><?php echo $data['pengarang'];?></td>
                                                    <td><?php echo $data['penerbit'];?></td>
                                                    <td><?php echo $data['pinjam'];?></td>
                                                </tr>
                                            <?php  } ?>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pie Chart -->
                            <div class="col-xl-5 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Pengunjung Hari Ini</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="?page=pengunjung">Lihat Semua</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                      <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                          <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Tanggal</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                                
                                            <?php
                                              $no=1;

                                              $sql = $koneksi->query("SELECT * from tb_pengunjung WHERE tanggal='$tgltahun'");
                                              while ($tampil=$sql->fetch_assoc()) {
                                              $nama = $tampil['nis'];
                                              $namaq = $koneksi->query("SELECT * FROM tb_anggota WHERE nis = '$nama'");
                                              // echo "<pre>";
                                              // print_r($nama);
                                              // echo "</pre>";
                                              $tampil_nama = mysqli_fetch_assoc($namaq);
                                            ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $tampil_nama['nama']?></td>
                                                <td><?php echo $tampil['tanggal']?></td>
                                            </tr>
                                            <?php } ?>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>