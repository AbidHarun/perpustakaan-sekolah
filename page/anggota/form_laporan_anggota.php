<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cetak Laporan Anggota</h6>
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            
            <form method="POST" action="laporan/laporan_anggota.php"  >

                <div class="form-group">
                    <label>Dari Tanggal </label>
                    <input class="form-control" name="tanggal1" type="date"  />
                    
                </div>

                <div class="form-group">
                    <label>Sampai Tanggal </label>
                    <input class="form-control" name="tanggal2" type="date"  />
                    
                </div>


                <div>
                    
                    <input type="submit" name="cetak" value="Cetak" target="blank"  class="btn btn-primary">
                     <a href="./laporan/laporan_anggota.php" class="btn btn-default" target="blank" style="margin-top: 8px; margin-left: 5px;"> Cetak Semua</a>
                </div>

           </form>
          </div>
        </div>
    </div>
</div>