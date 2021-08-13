<?php
	

	$nis = $_GET['id'];

	$sql = $koneksi->query("select * from tb_anggota where nis = '$nis'");

	$tampil = $sql->fetch_assoc();

    $jkl = $tampil['jk'];
    $kelas = $tampil['kelas'];


?>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data</h6>
    </div>
    <div class="card-body">

    <div class="row">
        <div class="col-md-12">
            <form method="POST" >
                <div class="form-group">
                    <label>NIS</label>
                    <input class="form-control" name="nis" value="<?php echo $tampil['nis']?>" readonly/>
                    
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input class="form-control" name="nama" value="<?php echo $tampil['nama']?>" required /> 
                </div>

               

                <div class="form-group">
                    <label>Jenis Kelamin</label><br/>
                    <label class="checkbox-inline">
                        <input type="checkbox" value="l" name="jk" <?php echo($jkl==l)?"checked":"";?> /> Laki-laki
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" value="p" name="jk" <?php echo($jkl==p)?"checked":""; ?> /> Perempuan
                    </label>
                    
                </div>

                <div class="form-group">
                <label> Kelas</label>
                <select class="form-control" name="kelas">
                    <option value="VII" <?php if ($kelas=='VII') {echo "selected";} ?>>VII</option>
                    <option value="VIII"<?php if ($kelas=='VIII') {echo "selected";} ?>>VIII</option>
                    <option value="IX"<?php if ($kelas=='IX') {echo "selected";} ?>>IX</option>
                </select>
                </div>
                
                <div>
                	
                	<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                    <a href="?page=anggota" class="btn btn-primary">Kembali</a>
                </div>

         </form>
      </div>
</div>  
 </div>  
 </div>


 <?php

 	$nis = $_POST ['nis'];
 	$nama = $_POST ['nama'];
 	// $nomorHp = $_POST ['nomorHp'];
 	$jk = $_POST ['jk'];
 	$kelas = $_POST ['kelas'];
 	
 	$simpan = $_POST ['simpan'];


 	if ($simpan) {
 		
 		$sql = $koneksi->query("update  tb_anggota set nama='$nama', jk='$jk', kelas='$kelas' where nis='$nis' ");
 		if ($sql) {
 			?>
 				<script type="text/javascript">
 					
 					alert ("Data Berhasil Disimpan");
 					window.location.href="?page=anggota";

 				</script>
 			<?php
 		}
 	}

 ?>
                             
                             

