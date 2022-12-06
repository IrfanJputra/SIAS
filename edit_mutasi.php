<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

?>
<?php include 'template/v_sidebar.php'; ?>
<?php include 'template/v_header.php'; ?>

<?php
include 'database/konfig.php';

$id = $_GET["id"];
//query data siswa berdasarkan id
$sqlGet = "SELECT * FROM tb_status WHERE id_mutasi = '$id'";
$queryGet = mysqli_query($conn, $sqlGet);
$data = mysqli_fetch_array($queryGet);

?>

<div class="card-header py-3">
<h1 class="h4 mb-2 text-gray-800">Edit Mutasi</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
<form action="" method="POST">
    <div class="mb-3">
    <label for="mutasi" class="form-label">Mutasi</label>
    <input type="text" class="form-control"  name="mutasi" id="mutasi" value="<?php echo "$data[mutasi]";?>">
  </div>
  <div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan</label>
    <input type="text" class="form-control"  name="keterangan" id="keterangan" value="<?php echo "$data[keterangan]";?>">
  </div>
  <div class="mb-3"><button class="btn btn-primary" type="submit" name="submit">Ubah</button></div>
</form>

<?php 
if (isset($_POST['submit'])){
  $mutasi       = $_POST["mutasi"];
  $keterangan   = $_POST["keterangan"];


$sqlUpdate = "UPDATE tb_status 
              SET mutasi='$mutasi', keterangan='$keterangan'
              WHERE id_mutasi = '$id'";
$query= mysqli_query($conn, $sqlUpdate);


if( isset($_POST["submit"]) ) {
	if(($_POST)>0 ) {	
    echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'data_mutasi.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'data_mutasi.php';
			</script>
		";
	}
}
}
?>
