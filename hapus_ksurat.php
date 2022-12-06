<?php 
require 'function.php';

$id = $_GET["id"];

if( hapus_ksurat($id) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'surat_keluar.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'surat_keluar.php';
		</script>
	";
}

?>