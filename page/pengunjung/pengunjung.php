<div class="row">
                <div class="col-md-12">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if ($_SESSION['admin']) {?>
                                <div>
                                    <a href="?page=pengunjung&aksi=tambah" class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-plus"></i> Tambah Data</a>
                                </div><br>
                                <?php   } ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                    <!-- Advanced Tables -->
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi->query("SELECT * FROM tb_pengunjung ORDER BY tanggal DESC");

                                            while ($data= $sql->fetch_assoc()) {
                                        ?>

                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>
                                                
                                                <?php
                                                $nis = $data['nis'];
                                                $result_query = "SELECT * FROM tb_anggota WHERE nis = '$nis'";
                                                $result_queryy = $koneksi->query($result_query);
                                                $row = mysqli_fetch_assoc($result_queryy);
                                                echo $row['nama'];
                                                ?>

                                            </td>
                                            <td><?php echo $data['tanggal'];?></td>
                                           
                                           
                                        </tr>


                                        <?php  } ?>
                                    </tbody>

                                    </table>

                                  </div>
                        </div>
                     </div>
                   </div>
     </div>                           