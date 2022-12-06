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
?>>
<?php include 'template/v_header.php'; ?>

<?php
include 'database/konfig.php';

$id = $_GET["id"];
//query data siswa berdasarkan id
$sqlGet = "SELECT * FROM tb_data WHERE id_data = '$id'";
$queryGet = mysqli_query($conn, $sqlGet);
$data = mysqli_fetch_array($queryGet);

?>

<div class="card-header py-3">
<h1 class="h4 mb-2 text-gray-800">Edit Data</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
<form action="" method="POST">
    <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control"  name="nama" id="nama" value="<?php echo "$data[nama]";?>">
  </div>
  <div class="mb-3"><button class="btn btn-primary" type="submit" name="submit">Ubah</button></div>
</form>

<?php 
if (isset($_POST['submit'])){
  $nama       = $_POST["nama"];


$sqlUpdate = "UPDATE tb_data
              SET nama='$nama'
              WHERE id_data = '$id'";
$query= mysqli_query($conn, $sqlUpdate);


if( isset($_POST["submit"]) ) {
	if(($_POST)>0 ) {	
    echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'tambah_data.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'tambah_data.php';
			</script>
		";
	}
}
}
?>
