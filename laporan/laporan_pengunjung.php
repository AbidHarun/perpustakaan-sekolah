<?php
error_reporting(0);
$koneksi = new mysqli("localhost","root","","db_perpustakaan");


$content ='

<style type="text/css">
	.tabel{font-size: 13px; border-collapse: collapse;}
	.tabel th{padding: 8px 5px;  background-color:  #cccccc;  }
	.tabel td{padding: 8px 5px;     }
</style>
';


if (isset($_POST['cetak'])) {
	
	$tgl1 = $_POST['tanggal1'];
	$tgl2 = $_POST['tanggal2'];

	$jumlah = $koneksi->query("SELECT * FROM tb_pengunjung where tanggal between '$tgl1' and '$tgl2'");

	$nums = mysqli_num_rows($jumlah);

	$content.='<page>
	<h1>Laporan Data Pengunjung Perpustakaan SMPN 2 Suwawa</h1>
	<p>Tanggal : '.$tgl1.' s/d '.$tgl2.'</p>
	<br>
	<p>Jumlah Pengunjung : '.$nums.'</p>';
	
} else {
	$jumlah = $koneksi->query("SELECT * FROM tb_pengunjung");

	$nums = mysqli_num_rows($jumlah);

	$content.='<page>
	<h1>Laporan Data Pengunjung Perpustakaan SMPN 2 Suwawa</h1>
	<p>Tanggal : Semua data /'.date('d-m-Y').'</p>
	<br>
	<p>Jumlah Pengunjung : '.$nums.'</p>';
}


$content .= '
<table border="1px" class="tabel"  >
<tr>
<th>No </th>
<th>NIS</th>
<th>Nama</th>
<th>Tanggal</th>
</tr>';

if (isset($_POST['cetak'])) {

	$tgl1 = $_POST['tanggal1'];
	$tgl2 = $_POST['tanggal2'];	
		
	$no = 1;
	$sql = $koneksi->query("SELECT * FROM tb_pengunjung where tanggal between '$tgl1' and '$tgl2' ");
	while ($tampil=$sql->fetch_assoc()) {
		$nama = $tampil['nis'];
		$namaq = $koneksi->query("SELECT * FROM tb_anggota WHERE nis='$nama' ");

		$tampil_nama = mysqli_fetch_assoc($namaq);
		$content .='
			<tr>
				<td align="center">'.$no++.'</td>
				<td align="center">'.$tampil['nis'].'</td>
				<td align="center">'.$tampil_nama['nama'].'</td>
				<td align="center">'.$tampil['tanggal'].'</td>
			</tr>
		';
	}

}else{

	$no=1;

	$sql = $koneksi->query("SELECT * from tb_pengunjung");
	while ($tampil=$sql->fetch_assoc()) {
		$nama = $tampil['nis'];
		$namaq = $koneksi->query("SELECT * FROM tb_anggota WHERE nis = '$nama'");
		// echo "<pre>";
		// print_r($nama);
		// echo "</pre>";
		$tampil_nama = mysqli_fetch_assoc($namaq);
		$content .='
			<tr>
				<td align="center">'.$no++.'</td>
				<td align="center">'.$tampil['nis'].'</td>
				<td align="center">'.$tampil_nama['nama'].'</td>
				<td align="center">'.$tampil['tanggal'].'</td>
			</tr>
		';
	}
}


$content .='


</table>
</page>';

require_once('../assets/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('laporan-pengunjung.pdf');
?>
