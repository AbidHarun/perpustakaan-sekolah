<div class="row">
<div class="col-md-12">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php if ($_SESSION['admin']) {?>
            <div>
                <a href="?page=transaksi&aksi=tambah" class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-plus"></i> Tambah Data</a>
            </div><br>
        <?php   } ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
<!-- Advanced Tables -->
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Terlambat</th>
                        <?php if ($_SESSION['admin']) {?>
                        <th width="21%">Aksi</th>
                        <?php   } ?>
                    </tr>
                </thead>
                <tbody>

                    <?php


                        $no = 1;

                        $sql = $koneksi->query("SELECT * FROM tb_transaksi ORDER BY tgl_pinjam desc");

                        while ($data= $sql->fetch_assoc()) {
                        $id_transaksi = $data['id'];


                    ?>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <?php 
                                $test = $data['id_buku'];
                                // echo $test;
                                $jbuku = $koneksi->query("SELECT * FROM tb_buku WHERE id_buku=$test");
                                $jjbuku = $jbuku->fetch_assoc();
                                echo $jjbuku['judul'];
                             ?>
                        </td>
                        <td>
                        <?php 
                            $anggota = $data['nis'];
                            // echo $test;
                            $anggotaa = $koneksi->query("SELECT * FROM tb_anggota WHERE nis=$anggota");
                            $show = $anggotaa->fetch_assoc();
                            echo $anggota;
                         ?>
                         </td>
                        <td><?php echo $show['nama'];;?></td>
                        <td><?php echo $data['tgl_pinjam'];?></td>
                        <td><?php echo $data['tgl_kembali'];?></td>
                        <td>
                            <?php

                                $query_cek = $koneksi->query("SELECT * FROM tb_transaksi WHERE id = '$id_transaksi'");
                                $row_cek = mysqli_fetch_assoc($query_cek);
                                $status_cek = $row_cek['status'];

                                if ($status_cek == 'Pinjam' || $status_cek == 'Diperpanjang') {
                                    echo "<font color='#f97b6f'>$data[status]</font>";
                                } elseif ($status_cek == 'Dikembalikan') {
                                    echo $data['status'];
                                }
                            ?>

                        </td>
                        
                        <td>
                        	<?php

                            $query_cek = $koneksi->query("SELECT * FROM tb_transaksi WHERE id = '$id_transaksi'");
                            $row_cek = mysqli_fetch_assoc($query_cek);
                            $status_cek = $row_cek['status'];

                            if ($status_cek == 'Pinjam' || $status_cek == 'Diperpanjang') {
                                //$denda = 1000;

                                $tanggal_dateline = $data['tgl_kembali'];
                                $tgl_kembali=date('Y-m-d');
                                $lambat = terlambat($tanggal_dateline, $tgl_kembali);

                                //$denda1 = $lambat*$denda;

                                if ($lambat>0) {
                                    echo "<font color='red'>$lambat hari </font>";
                                }else{
                                    echo $lambat . " hari";
                                }

                            } elseif ($status_cek == 'Dikembalikan') {
                                echo "-";
                            }

                        	?>
                        </td>
                        
                        <?php if ($_SESSION['admin']) {?>
                        <td>
                            <?php
                            $query_cek = $koneksi->query("SELECT * FROM tb_transaksi WHERE id = '$id_transaksi'");
                            $row_cek = mysqli_fetch_assoc($query_cek);
                            $status_cek = $row_cek['status'];

                            if ($status_cek == 'Dikembalikan') {
                
                            ?>
                                
                            <?php
                            }else if($status_cek == 'Pinjam' || $status_cek == 'Diperpanjang' ){
                            ?>
                            <a href="?page=transaksi&aksi=kembali&id=<?php echo $data['id']; ?>&judul=<?php echo $data['judul']?>" class="btn btn-info"  style="font-size: 14px;" >Kembali</a>
                            <a href="?page=transaksi&aksi=perpanjang&id=<?php echo $data['id']; ?>&judul=<?php echo $data['judul'];?>&tgl_kembali=<?php echo $data['tgl_kembali']?>&lambat=<?php echo $lambat; ?>" class="btn btn-danger" style="font-size: 14px;">Perpanjang</a>
                            <?php
                        }
                        ?>
                        </td>
                        <?php   } ?>
                    </tr>
                    <?php  } ?>
                </tbody>
                </table>
              </div>
    </div>
</div>
</div>
</div>              

