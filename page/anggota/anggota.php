<div class="row">
                <div class="col-md-12">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Anggota</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if ($_SESSION['admin']) {?>
                                <div>
                                    <a href="?page=anggota&aksi=tambah" class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-plus"></i> Tambah Data</a>
                                </div><br>
                                <?php   } ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <!-- <th>Nomor HP</th> -->
                                            <th>Kelas</th>
                                            <?php if ($_SESSION['admin']) {?>
                                            <th width="19%">Aksi</th>
                                            <?php   } ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi->query("SELECT * from tb_anggota");

                                            while ($data= $sql->fetch_assoc()) {
                                                
                                            $jk = ($data['jk']==l)?"Laki-laki":"Perempuan";
                                        ?>

                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data['nis'];?></td>
                                            <td><?php echo $data['nama'];?></td>
                                            <td><?php echo $jk;?></td>
  
                                            <td><?php echo $data['kelas'];?></td>
                                            <?php if ($_SESSION['admin']) {?>
                                            <td>
                                                <a href="?page=anggota&aksi=ubah&id=<?php echo $data['nis']; ?>" class="btn btn-warning" ><i class="fa fa-edit"></i></a>
                                                <a onclick="return confirm('Anda ingin menghapus?')" href="?page=anggota&aksi=hapus&id=<?php echo $data['nis']; ?>" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
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