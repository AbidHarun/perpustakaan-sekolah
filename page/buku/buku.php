<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php if ($_SESSION['admin']) {?>
                    <div>
                        <a href="?page=buku&aksi=tambah" class="btn btn-success" style="margin-top:  8px;"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div><br>
                    <?php   } ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>ISBN</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Jenis</th>
                                <th>Tahun</th>
                                <th>Jumlah</th>
                                <!-- <th>Lokasi</th> -->
                                <?php if ($_SESSION['admin']) {?>
                                <th width="19%">Aksi</th>
                                <?php   } ?>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                            $no = 1;

                            $sql = $koneksi->query("SELECT * from tb_buku ORDER BY tgl_input");

                            while ($data= $sql->fetch_assoc()) {

                        ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['judul'];?></td>
                            <td><?php echo $data['isbn'];?></td>
                            <td><?php echo $data['pengarang'];?></td>
                            <td><?php echo $data['penerbit'];?></td>
                            <td><?php echo $data['jenis'];?></td>
                            <td><?php echo $data['tahun_terbit'];?></td>
                            <td><?php echo $data['jumlah_buku'];?></td>
                            <?php if ($_SESSION['admin']) {?>
                            <td>
                                <a href="?page=buku&aksi=ubah&id_buku=<?php echo $data['id_buku']; ?>" class="btn btn-warning" ><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Anda yakin ingin menghapus?')" href="?page=buku&aksi=hapus&id_buku=<?php echo $data['id_buku']; ?>" class="btn btn-danger" ><i class="fa fa-trash"></i></a>

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

     