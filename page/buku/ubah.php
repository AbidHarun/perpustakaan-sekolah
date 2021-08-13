<?php
	$id_buku = $_GET['id_buku'];
	$sql = $koneksi->query("select * from tb_buku where id_buku='$id_buku'");
	$tampil = $sql->fetch_assoc();
	$tahun2 = $tampil['tahun_terbit'];
    include 'file_upload.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data</h6>
    </div>
    <div class="card-body">
    <form method="POST" enctype="multipart/form-data" >
        <div class="row">
            <div class="col-md-6">
                
                    <div class="form-group">
                        <label>Judul</label>
                        <input class="form-control" name="judul" value="<?php echo $tampil['judul'];?>" required />
                    </div>

                    <div class="form-group">
                        <label>Pengarang</label>
                        <input class="form-control" name="pengarang" value="<?php echo $tampil['pengarang'];?>" required />
                    </div>

                    <div class="form-group">
                        <label>Penerbit</label>
                        <input class="form-control" name="penerbit" value="<?php echo $tampil['penerbit'];?>" required />        
                    </div>

                    <div class="form-group">
                        <label>Jenis Buku</label>
                        <input class="form-control" name="jenis" id="jenis" value="<?php echo $tampil['jenis'];?>" required/>        
                    </div>

                    <div class="form-group">
                        <label>Tanggal Masuk Buku</label>
                        <input type="date" class="form-control" value="<?php echo $tampil['tgl_input'] ?>" name="tgl_input" id="tgl_input" required />
                    </div> 

                    <div class="form-group">
                        <label>Gambar</label><br>
                        <img src="uploud/<?= $tampil['foto']; ?>" alt="gambar" width="200"><br>
                        <input type="file" name="gambar" id="gambar"/>
                        <input type="hidden" name="gambars" id="gambar" value="<?php echo $tampil['foto'] ?>"/>
                    </div>        
                    
            </div>
            <div class="col-md-6">
                     <div class="form-group">
                        <label>Tahun Terbit</label>
                        <select class="form-control" name="tahun">
                            <?php
                            	$tahun = date("Y");
                            	for ($i=$tahun-29; $i <= $tahun; $i++) { 
                            			if ($i==$tahun2 ) {
                            			 echo'<option value="'.$i.'" selected>'.$i.'</option>';
                            			}else{
                            			 echo'<option value="'.$i.'">'.$i.'</option>';
    									}			     	
                            	}
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>ISBN</label>
                        <input class="form-control" name="isbn" value="<?php echo $tampil['isbn'];?>" required/>
                        
                    </div>

                    <div class="form-group">
                        <label>Jumlah Buku</label>
                        <input class="form-control" type="number" name="jumlah" value="<?php echo $tampil['jumlah_buku'];?>" required />  
                    </div>

                    <div class="form-group">
                        <label>Dipinjam</label>
                        <input class="form-control" type="number" name="pinjam" value="<?php echo $tampil['pinjam'];?>" required />  
                    </div>      


            </div>
        </div>  
                    <div>
                    	<input type="submit" name="simpan" value="Ubah" class="btn btn-success">
                        <a href="?page=buku" class="btn btn-primary">Kembali</a>
                    </div>
    </form>
    </div>  
 </div>


 <?php

 	$judul = $_POST ['judul'];
 	$pengarang = $_POST ['pengarang'];
 	$penerbit = $_POST ['penerbit'];
 	$tahun = $_POST ['tahun'];
 	$isbn = $_POST ['isbn'];
 	$jumlah = $_POST ['jumlah'];
    $pinjam = $_POST['pinjam'];
    $tgl_input = $_POST['tgl_input'];
    $jenis = $_POST['jenis'];

 	$simpan = $_POST ['simpan'];

 	if ($simpan) {

    $gambar_sebelumnya = $_POST['gambars'];
        if ($_FILES['gambar']['error'] === 4) {
            $gambar_baru = $gambar_sebelumnya;
        } else {
            $gambar_baru = upload_gambar();
            unlink("/uploud/$gambar_sebelumnya");
        }
 		
 		$sql = $koneksi->query("UPDATE tb_buku set judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun', isbn='$isbn', jumlah_buku='$jumlah', pinjam='$pinjam', tgl_input='$tgl_input', jenis='$jenis', foto='$gambar_baru' where id_buku='$id_buku'");

 		if ($sql) {
 			?>
 				<script type="text/javascript">
 					
 					alert ("Ubah Berhasil Disimpan");
 					window.location.href="?page=buku";

 				</script>
 			<?php
 		}
 	}

 ?>
                             
                             

