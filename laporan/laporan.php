<?php
error_reporting(0);
$koneksi = new mysqli("localhost","root","","db_perpustakaan");


$content ='

<style type="text/css">
	*{
		margin-left:40px;
	}
    .tabelkecil {font-size: 12px; border-collapse: collapse;}
    .tabel {font-size: 12px; border-collapse: collapse;}    
	th{padding: 8px 5px;  background-color:  #cccccc;  }
	td{padding: 8px 5px;   }
</style>

';


if (isset($_POST['cetak'])) {
	
	$tgl1 = $_POST['tanggal1'];
	$tgl2 = $_POST['tanggal2'];

	$jumlah = $koneksi->query("SELECT * FROM tb_buku where tgl_input between '$tgl1' and '$tgl2' ORDER BY pinjam DESC");
	$nums = mysqli_num_rows($jumlah);

	$content.='<page>
	<h1>Laporan Data Buku SMPN 2 Suwawa</h1>
	<p>Tanggal : '.$tgl1.' s/d '.$tgl2.'</p>
	<br>
	<p>Buku : '.$nums.'</p>';
	
} else {
	$jumlah = $koneksi->query("SELECT * FROM tb_buku ORDER BY pinjam DESC");
	$nums = mysqli_num_rows($jumlah);

	$jumlah_pinjam = $koneksi->query("SELECT * FROM tb_transaksi WHERE status='Dikembalikan' OR status='Pinjam'");
	$jpinjam = mysqli_num_rows($jumlah_pinjam);

	$content.='<page>
	<h1>Laporan Data Buku SMPN 2 Suwawa</h1>
	<p>Tanggal : Semua data /'.date('d-m-Y').'</p>
	<br>
	<p>Buku : '.$nums.'</p>
	';
}


 $content .= '
<table border="1px" class="tabelkecil"   width=100%>
	<tr>
		<th>No</th>
		<th>Judul</th>
		<th>Pengarang</th>
		<th>Penerbit</th>
		<th>Jenis</th>
		<th>Tahun Terbit</th>
		<th>ISBN</th>
		<th>Jumlah Buku</th>
		<th>Tanggal Masuk</th>
	</tr>';



if (isset($_POST['cetak'])) {

	
	$tgl1 = $_POST['tanggal1'];
	$tgl2 = $_POST['tanggal2'];
	
		
	$no = 1;
	$sql = $koneksi->query("SELECT * from tb_buku where tgl_input between '$tgl1' and '$tgl2' ORDER BY pinjam DESC");
	
	while ($tampil=mysqli_fetch_assoc($sql)) {
		$total += $tampil['jumlah_buku'];
		$content .='
			<tr>
				<td align="center">'.$no++.'</td>
				<td align="center">'.$tampil['judul'].'</td>
				<td align="center">'.$tampil['pengarang'].'</td>
				<td align="center">'.$tampil['penerbit'].'</td>
				<td align="center">'.$tampil['jenis'].'</td>
				<td align="center">'.$tampil['tahun_terbit'].'</td>
				<td align="center">'.$tampil['isbn'].'</td>
				<td align="center">'.$tampil['jumlah_buku'].'</td>
				<td align="center">'.$tampil['tgl_input'].'</td>
			</tr>
		';	
	}

	$jumlah_pinjam = $koneksi->query("SELECT * FROM tb_transaksi WHERE (status='Dikembalikan' OR status='Pinjam') AND (tgl_input between '$tgl1' and '$tgl2')");
	$jpinjam = mysqli_num_rows($jumlah_pinjam);


	$content .='
		</table>

		<p>Total Jumlah Buku Saat ini   : '.$total.' <br><br>
		Total Jumlah Buku Dipinjam   : '.$jpinjam.'</p>
		<p>Berikut rincian jumlah jenis buku :</p>

		<table border="1px" class="tabel" width=100%>
			<tr>
				<th>No</th>
				<th>Jenis Buku</th>
				<th>Jumlah</th>
			</tr>
	';

	$noo = 1;
	$jumlah_jenis = $koneksi->query("SELECT jenis, COUNT(jenis) as Jumlah FROM tb_buku WHERE tgl_input between '$tgl1' and '$tgl2' GROUP BY jenis ");
	while ($jjenis=mysqli_fetch_assoc($jumlah_jenis)) {
	$content .='
			<tr>
				<td align="center">'.$noo++.'</td>
				<td align="center">'.$jjenis['jenis'].'</td>
				<td align="center">'.$jjenis['Jumlah'].'</td>
			</tr>
	';	
	}
}
else{

	$no=1;

	$sql = $koneksi->query("SELECT * FROM tb_buku ORDER BY pinjam DESC");
	while ($tampil=$sql->fetch_assoc()) {
		$total += $tampil['jumlah_buku'];
		$content .='
			<tr>
				<td align="center">'.$no++.'</td>
				<td align="center">'.$tampil['judul'].'</td>
				<td align="center">'.$tampil['pengarang'].'</td>
				<td align="center">'.$tampil['penerbit'].'</td>
				<td align="center">'.$tampil['jenis'].'</td>
				<td align="center">'.$tampil['tahun_terbit'].'</td>
				<td align="center">'.$tampil['isbn'].'</td>
				<td align="center">'.$tampil['jumlah_buku'].'</td>
				<td align="center">'.$tampil['tgl_input'].'</td>
			</tr>
		';
	}

	$content .='
		</table>

		<p>Total Jumlah Buku Saat ini   : '.$total.' <br><br>
		Total Jumlah Buku Dipinjam   : '.$jpinjam.'</p>

		<p>Berikut rincian jumlah jenis buku :</p>

		<table border="1px" class="tabel"  >
			<tr>
				<th>No</th>
				<th>Jenis Buku</th>
				<th>Jumlah</th>
			</tr>
	';

	$noo = 1;
	$jumlah_jenis = $koneksi->query("SELECT jenis, COUNT(jenis) as Jumlah FROM tb_buku GROUP BY jenis");
	while ($jjenis=$jumlah_jenis->fetch_assoc()) {
	$content .='
			<tr>
				<td align="center">'.$noo++.'</td>
				<td align="center">'.$jjenis['jenis'].'</td>
				<td align="center">'.$jjenis['Jumlah'].'</td>
			</tr>
	';
	}

}

$content .='
	</table>
	</page>
';


require_once('../assets/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('L','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('laporan-buku.pdf');
?>