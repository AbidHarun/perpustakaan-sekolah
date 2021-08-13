<?php
	
	$nis = $_GET ['id'];

	$koneksi->query("DELETE from tb_anggota where nis ='$nis'");

?>


<script type="text/javascript">
		window.location.href="?page=anggota";
</script>