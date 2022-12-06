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
//ambil data dari url
$id = $_GET['id'];

//query data siswa berdasarkan id
$sqlGet = "SELECT * FROM tb_siswa WHERE id = '$id'";
$queryGet = mysqli_query($conn, $sqlGet);
$data = mysqli_fetch_array($queryGet);


?>

<div class="card-header py-3">
<h1 class="h4 mb-2 text-gray-800">Edit Siswa</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
<form action="" method="POST">
    <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control"  name="nama" id="nama" value="<?php echo "$data[nama]";?>">
  </div>
  <div class="mb-3">
    <label for="no_induk" class="form-label">No Induk</label>
    <input type="text" class="form-control"  name="no_induk" id="induk" value="<?php echo "$data[no_induk]";?>">
  </div>
  <div class="mb-3">
    <label for="nisn" class="form-label">NISN</label>
    <input type="text" class="form-control"  name="nisn" id="nisn" value="<?php echo "$data[nisn]";?>">
  </div>
  <div class="mb-3">
    <label for="kelas" class="form-label">Kelas</label>
    <input type="text" class="form-control"  name="kelas" id="kelas" value="<?php echo "$data[kelas]";?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Jenis Kelamin</label><br>
    <input type="checkbox" class="form-chek-input"  name="jk" value="Laki-Laki">
    <label>Laki-Laki</label>

    <input type="checkbox" class="form-chek-input"  name="jk" value="Perempuan">
    <label>Perempuan</label>
  </div>
    <div class="mb-3"><button class="btn btn-primary" type="submit" name="submit">Ubah</button></div>
</form>

<?php 
if (isset($_POST['submit'])){
  $nama       = $_POST["nama"];
  $no_induk   = $_POST["no_induk"];
  $nisn       = $_POST["nisn"];
  $kelas       = $_POST["kelas"];
  $jk         = $_POST["jk"];


$sqlUpdate = "UPDATE tb_siswa 
              SET nama='$nama', no_induk='$no_induk', nisn='$nisn', kelas='$kelas', jk='$jk'
              WHERE id= '$id'";
$query= mysqli_query($conn, $sqlUpdate);


if( isset($_POST["submit"]) ) {
	if(($_POST)>0 ) {	
    echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'siswa.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'siswa.php';
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