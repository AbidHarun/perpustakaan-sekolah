<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Anggota</h6>
    </div>
    <div class="card-body">

    <div class="row">
        <div class="col-md-12">
            
            <form method="POST" onsubmit="return validasi(this)">
                <div class="form-group">
                    <label>NIS</label>
                    <input class="form-control" name="nis" id="nis" required />
                    
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input class="form-control" name="nama" id="nama" required />
                    
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label><br/>
                    <label class="checkbox-inline">
                        <input type="checkbox" value="l" name="jk"  /> Laki-laki
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" value="p" name="jk"  /> Perempuan
                    </label>
                    
                    
                </div>

                 <div class="form-group">
                    <label> Kelas</label>
                    <select class="form-control" name="kelas">
                        <option value="kosong" hidden>== Pilih Kelas ==</option>
                        <option value="VII">VII</option>
                        <option value="VIII">VIII</option>
                        <option value="IX">IX</option>
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
    if (isset($simpan)) {
    
        if ($kelas == "kosong") {
            echo "<script>
            alert ('Kelas Harus Diisi');
            window.location.href='?page=anggota&aksi=tambah';
            </script>
            ";
            return false;
        }
    }

 	if ($simpan) {
 		
 		$sql = $koneksi->query("INSERT into tb_anggota (nis, nama, jk, kelas )values('$nis', '$nama', '$jk', '$kelas')");

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
                             
                             

