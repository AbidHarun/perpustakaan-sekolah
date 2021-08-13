<?php
error_reporting(0);
$koneksi = new mysqli("localhost","root","","db_perpustakaan");


$content ='

<style type="text/css">
	.tabel{font-size: 12px; border-collapse: collapse;}
	.tabel th{padding: 8px 5px;  background-color:  #cccccc;  }
	.tabel td{padding: 8px 5px;     }
</style>


';

if (isset($_POST['cetak'])) {
	
	$tgl1 = $_POST['tanggal1'];
	$tgl2 = $_POST['tanggal2'];

	$jumlah = $koneksi->query("SELECT * FROM tb_transaksi where tgl_input between '$tgl1' and '$tgl2'");
	$nums = mysqli_num_rows($jumlah);

	$jumlah_pinjam = $koneksi->query("SELECT * FROM tb_transaksi WHERE (status='Dikembalikan' OR status='Pinjam') AND (tgl_input between '$tgl1' and '$tgl2')");
	$jpinjam = mysqli_num_rows($jumlah_pinjam);
	$content.='<page>
	<h1>Laporan Data Transaksi Perpustakaan SMPN 2 Suwawa</h1>
	<p>Tanggal : '.$tgl1.' s/d '.$tgl2.'</p>
	<br>
	<p>Jumlah Transaksi : '.$nums.'</p>';
	
} else {
	$jumlah = $koneksi->query("SELECT * FROM tb_transaksi");
	$nums = mysqli_num_rows($jumlah);

	$jumlah_pinjam = $koneksi->query("SELECT * FROM tb_transaksi WHERE status='Dikembalikan' OR status='Pinjam'");
	$jpinjam = mysqli_num_rows($jumlah_pinjam);


	$content.='<page>
	<h1>Laporan Data Transaksi Perpustakaan SMPN 2 Suwawa</h1>
	<p>Tanggal : Semua data /'.date('d-m-Y').'</p>
	<br>
	<p>Jumlah Transaksi : '.$nums.'</p>';
}

 $content .= '
<table border="1px" class="tabel"  >
<tr>
<th>No </th>
<th>Judul</th>
<th>NIS</th>
<th>Nama</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>
<th>Status</th>

</tr>';

if (isset($_POST['cetak'])) {


	
	$tgl1 = $_POST['tanggal1'];
	$tgl2 = $_POST['tanggal2'];

	
		
	$no = 1;
	$sql = $koneksi->query("SELECT * from tb_transaksi where tgl_input between '$tgl1' and '$tgl2' ");
	while ($tampil=$sql->fetch_assoc()) {
		$judulbuku = $koneksi->query('SELECT judul FROM tb_buku WHERE id_buku=$tampil->judul');
		$content .='
			<tr>
				<td align="center">'.$no++.'</td>
				<td align="center">'.$tampil['judul'].'</td>
				<td align="center">'.$tampil['nis'].'</td>
				<td align="center">'.$tampil['nama'].'</td>
				<td align="center">'.$tampil['tgl_pinjam'].'</td>
				<td align="center">'.$tampil['tgl_kembali'].'</td>
				<td align="center">'.$tampil['status'].'</td>
			</tr>
		';
	
}
}else{

$no=1;

$sql = $koneksi->query("select * from tb_transaksi");
while ($tampil=$sql->fetch_assoc()) {
	$content .='
		<tr>
			<td align="center">'.$no++.'</td>
			<td align="center">'.$tampil['judul'].'</td>
			<td align="center">'.$tampil['nis'].'</td>
			<td align="center">'.$tampil['nama'].'</td>
			<td align="center">'.$tampil['tgl_pinjam'].'</td>
			<td align="center">'.$tampil['tgl_kembali'].'</td>
			<td align="center">'.$tampil['status'].'</td>
		</tr>
	';
}
}

$content .='
</table>
	<p>Jumlah Buku Dipinjam : '.$jpinjam.'</p>
</page>';

require_once('../assets/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('laporan-transaksi.pdf');
?>
