<?php 
require 'function.php';

$id = $_GET["id"];

if( hapus_msurat($id) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'surat_masuk.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'surat_masuk.php';
		</script>
	";
}

?>