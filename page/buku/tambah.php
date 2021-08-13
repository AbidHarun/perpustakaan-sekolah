<?php 
    include 'file_upload.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Buku</h6>
    </div>
    <div class="card-body">
        <form method="POST" onsubmit="return validasi(this)" enctype="multipart/form-data" >
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label>Judul</label>
                        <input class="form-control" name="judul" id="judul" required />
                    </div>

                    <div class="form-group">
                        <label>Pengarang</label>
                        <input class="form-control" name="pengarang" id="pengarang" required />
                    </div>

                    <div class="form-group">
                        <label>Penerbit</label>
                        <input class="form-control" name="penerbit" id="penerbit" required />
                    </div>

                    <div class="form-group">
                        <label>Jenis Buku</label>
                        <input class="form-control" name="jenis" id="jenis" required />
                    </div>
                    
                    <div class="form-group">
                        <label>Gambar</label><br>
                        <input type="file" name="gambar" id="gambar" required />
                    </div>
                        
                
                </div>  
                <div class="col-md-6">

                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <select class="form-control" name="tahun">
                            <?php
                                $tahun = date("Y");
                                for ($i=$tahun-29; $i <= $tahun; $i++) { 
                                    echo'<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>ISBN</label>
                        <input class="form-control" name="isbn" id="isbn" required />    
                    </div>

                    <div class="form-group">
                        <label>Jumlah Buku</label>
                        <input class="form-control" type="number" name="jumlah" id="jumlah" required />
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Masuk Buku</label>
                        <input type="date" class="form-control" name="tgl_input" id="tgl_input" required />
                    </div>
                    
                </div>
            </div>
                <div>                    
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
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
    $tgl_input = $_POST ['tgl_input'];
    $simpan = $_POST ['simpan'];
    $jenis = $_POST ['jenis'];


    if ($simpan) {  
        
    $media = upload_gambar();
    if (!$media) {
        return false;
    }
        $sql = $koneksi->query("INSERT INTO tb_buku (judul, pengarang, penerbit, tahun_terbit, isbn, jumlah_buku, tgl_input, jenis, foto)values('$judul', '$pengarang', '$penerbit', '$tahun', '$isbn', '$jumlah', '$tgl_input', '$jenis', '$media')");

        if ($sql) {
            ?>
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Disimpan");
                    window.location.href="?page=buku";

                </script>
            <?php
        }
    }

 ?>
                             
                             

