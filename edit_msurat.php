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
include 'database/konfig.php';
include 'function.php';
$id = $_GET["id"];
//query data siswa berdasarkan id
$sqlGet = "SELECT * FROM tb_masuk WHERE id_masuk = '$id'";
$queryGet = mysqli_query($conn, $sqlGet);
$data = mysqli_fetch_array($queryGet);

?>

<div class="card-header py-3">
<h1 class="h4 mb-2 text-gray-800">Edit Surat Masuk</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
<form action="" method="POST" enctype="multipart/form-data">
<input type="hidden" name="file_lama" value="<?= $data["file_surat"]; ?>">
    <div class="mb-3">
    <label for="no_berkas" class="form-label">No Berkas</label>
    <input type="text" class="form-control"  name="no_berkas" id="no_berkas" value="<?php echo "$data[no_berkas]";?>">
  </div>
  <div class="mb-3">
    <label for="alamat_pengirim" class="form-label">Alamat Pengirim</label>
    <input type="text" class="form-control"  name="alamat_pengirim" id="alamat_pengirim" value="<?php echo "$data[alamat_pengirim]";?>">
  </div>
  <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal</label>
    <input type="date" class="form-control"  name="tanggal" id="tanggal" value="<?php echo "$data[tanggal]";?>">
  </div>
  <div class="mb-3">
    <label for="perihal" class="form-label">Perihal</label>
    <input type="text" class="form-control"  name="perihal" id="perihal" value="<?php echo "$data[perihal]";?>">
  </div>
  <div class="mb-3">
    <label for="file_surat" class="form-label">File Surat</label>
    <input type="file" class="form-control"  name="file_surat" id="file_surat" value="<?php echo "$data[file_surat]";?>">
  </div>

    <div class="mb-3"><button class="btn btn-primary" type="submit" name="submit">Ubah</button></div>
</form>


<?php 
if (isset($_POST['submit'])){
  $no_berkas          = $_POST["no_berkas"];
  $alamat_pengirim    = $_POST["alamat_pengirim"];
  $tanggal            = $_POST["tanggal"];
  $perihal            = $_POST["perihal"];
  $file_lama         = $_POST["file_lama"];
	
	// cek apakah user pilih gambar baru atau tidak
	if( $_FILES['file_surat']['error'] === 4 ) {
		$file_surat = $file_lama;
	} else {
		$file_surat = upload();
	}
	
$sqlUpdate = "UPDATE tb_masuk 
              SET no_berkas='$no_berkas', 
              alamat_pengirim='$alamat_pengirim', 
              tanggal='$tanggal', 
              perihal='$perihal',
              file_surat='$file_surat'
              WHERE id_masuk = '$id'";
$query= mysqli_query($conn, $sqlUpdate);


if( isset($_POST["submit"]) ) {
	if(($_POST)>0 ) {	
    echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'surat_masuk.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'surat_masuk.php';
			</script>
		";
	}
}
}
?>

</div>
</div>
</div>
</div>
<?php include 'template/v_footer.php'; ?>