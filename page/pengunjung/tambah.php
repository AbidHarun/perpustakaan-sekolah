<!-- <script type="text/javascript" >
    function validasi(form){
        if (form.nis.value=="") {
            alert("nis Tidak Boleh Kosong");
            form.nis.focus();
            return(false);
        }
        return(true);
    }
</script> -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pengunjung</h6>
    </div>
    <div class="card-body">

    <div class="row">
        <div class="col-md-12">
            <form method="POST" method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)" >
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <select name="nis" class="form-control selek2" id="nis">
                        <option value="kosong" hidden>-Pilih Siswa</option>
                        <?php
                        $pinjam = date("Y-m-d");
                        $query_siswa = "SELECT * FROM tb_anggota";
                        $result_siswa = $koneksi->query($query_siswa);
                        while ($row = mysqli_fetch_assoc($result_siswa)) {
                        ?>
                        <option value="<?= $row['nis'] ?>"><?= $row['nis'] ?> - <?= $row['nama']?></option>
                        <?php
                        }
                        ?>         
                    </select>
                    
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input class="form-control" name="tgl" type="text" value="<?= $pinjam; ?>" readonly />
                    
                </div>

        
                
                <div>
                	<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                    <a href="?page=pengunjung" class="btn btn-primary">Kembali</a>
                </div>

         </form>
      </div>
 </div>  
 </div>  
 </div>



 <?php

 	$nis = $_POST['nis'];

    $tgl = $_POST['tgl'];
 	$simpan = $_POST ['simpan'];

    if (isset($simpan)) {
        
        if ($nis == 'kosong') {
            echo "<script>
            alert('Nis Belum Diinput');
            window.location.href='?page=pengunjung&aksi=tambah';
            </script>";
            return false;
        }
    }

 	if ($simpan) {
  
        $xcek = $koneksi->query("SELECT * FROM tb_pengunjung WHERE nis='$nis' AND tanggal='$tgl'");
        $xnum = mysqli_num_rows($xcek);
       
 		if($xnum >= 1)
            {
                echo "<script>alert('Pengunjung telah di data');</script>";
                echo "<meta http-equiv='refresh' content='0; url=?page=pengunjung'>";
            }
        else{
     		$sql = $koneksi->query("INSERT into tb_pengunjung values('', '$nis', '$tgl')");
     			?>
     				<script type="text/javascript">
     					alert ("Data Berhasil Disimpan");
     					window.location.href="?page=pengunjung";
     				</script>
     			<?php
        } 		
 	

     }

 ?>
                             
                             

