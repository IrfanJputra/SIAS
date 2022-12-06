<?php
session_start();

if( !isset($_SESSION["level"]) ) {
	header("Location: login.php");
	exit;
}

?>
<?php 
$level = $_SESSION['level'];
if($level == 'Admin') { include "template/v_sidebar.php"; }
if($level == 'User') { include "template/v_sidebar1.php"; }
?>
<?php include 'template/v_header.php'; ?>



<?php
require 'function.php';

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambah_surat($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
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


}
?>


<div class="card-header py-3">
<h1 class="h4 mb-2 text-gray-800">Tambah Surat Masuk</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
<form action="" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
    <label for="no_berkas" class="form-label">No Berkas</label>
    <input type="text" class="form-control"  name="no_berkas" id="no_berkas" required>
  </div>
  <div class="mb-3">
    <label for="alamat_pengirim" class="form-label">Alamat Pengirim</label>
    <input type="text" class="form-control"  name="alamat_pengirim" id="alamat_pengirim">
  </div>
  <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal</label>
    <input type="date" class="form-control"  name="tanggal" id="tanggal">
  </div>
  <div class="mb-3">
    <label for="perihal" class="form-label">Perihal</label>
    <input type="text" class="form-control"  name="perihal" id="perihal">
  </div>
  <div class="mb-3">
    <label for="file_surat" class="form-label">File Surat</label>
    <input type="file" class="form-control"  name="file_surat" id="file_surat">
    <label class="form-label">JPG, JPEG, PNG</label>
  </div>

    <div class="mb-3"><button class="btn btn-primary" type="submit" name="submit">Tambah Data</button></div>
</form>

</div>
</div>
</div>
</div>
<?php include 'template/v_footer.php'; ?>
