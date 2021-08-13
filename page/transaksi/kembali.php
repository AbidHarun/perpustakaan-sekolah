<?php

	$id = $_GET['id'];
	$id_buku = $_GET['judul'];
	$tglskrg = date("d-m-Y");

	// $sql = $koneksi->query("update tb_transaksi set status='kembali' where id = '$id'");
	$sql = $koneksi->query("UPDATE tb_transaksi SET status = 'Dikembalikan', tgl_kembali='$tglskrg' WHERE id='$id'");

	$buku = $koneksi->query("UPDATE tb_buku set jumlah_buku = (jumlah_buku+1) where judul='$id_buku' ");

	if ($sql || $buku) {
		?>
			<script type="text/javascript">
				
				alert("Buku Berhasil Dikembalikan");

				window.location.href="?page=transaksi";

			</script>
		<?php
	}

?>