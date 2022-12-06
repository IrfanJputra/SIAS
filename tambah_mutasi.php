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
	if( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'siswa.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'siswa.php';
			</script>
		";
	}


}
?>



<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="script/getData.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
</head>
<div class="card-header py-3">
<h1 class="h4 mb-2 text-gray-800">Tambah Data Siswa</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
<form action="" method="POST">

<table>
            <label for="nama">Nama Siswa</label>
        <select  name="nama"  class="form-control" onchange="isi_otomatis()" id="nama" required>
        <option disabled selected> Pilih Siswa </option>
    <?php 
     include 'database/konfig.php';
      $data = mysqli_query($conn, "SELECT * FROM tb_data");
       while($baris= mysqli_fetch_array($data)){
      ?>
        <option value="<?php echo $baris['nama']; ?>"><?php echo $baris['nisn']; ?> - <?php echo $baris['nama']; ?></option>
      <?php
       }
           ?> 
       </select>
  <br>
 
   <div class="mb-3">
    <label for="no_induk" class="form-label">No Induk</label>
    <input type="text" class="form-control"  name="no_induk" readonly id="no_induk">
  </div> 
  <div class="mb-3">
    <label for="nisn" class="form-label">NISN</label>
    <input type="text" class="form-control"  name="nisn" readonly id="nisn">
  </div>
  <div class="mb-3">
    <label for="kelas" class="form-label">Kelas</label>
    <input type="text" class="form-control"  name="kelas" readonly id="kelas">
  </div>
  <div class="mb-3">
    <label class="form-label">Jenis Kelamin</label><br>
    <input type="radio" class="form-chek-input"  name="jk" value="Laki-Laki" required>
    <label>Laki-Laki</label>
    <input type="radio" class="form-chek-input"  name="jk" value="Perempuan">
    <label>Perempuan</label>
  </div>

  <label for="mutasi">Pilih Mutasi</label>
        <select  name="mutasi" class="form-control" value="mutasi" >
    <option disabled selected> Pilih </option>
    <?php 
     include 'database/konfig.php';
      $data = mysqli_query($conn, "SELECT * FROM tb_status WHERE id_mutasi;");
       while($baris= mysqli_fetch_array($data)){
      ?>
        <option value="<?php echo $baris['id_mutasi']; ?>"><?php echo $baris['mutasi']; ?></option> 

      <?php
       }
           ?>
       </select>
<br>
    <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
    <div class="mb-3"><button class="btn btn-primary" type="submit" name="submit">Tambah Data</button></div>
    </table>
</form>

</div>
</div>
</div>
</div>

<script type="text/javascript">
            function isi_otomatis(){
                var nama = $("#nama").val();
                $.ajax({
                    url: 'tampil.php',
                    data:"nama="+nama ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#nisn').val(obj.nisn);
                    $('#no_induk').val(obj.no_induk);
                    $('#kelas').val(obj.kelas);
                });
            }
        </script>

<script type="text/javascript">
 $(document).ready(function() {
     $("#nama").select2();
 });
</script>

<?php include 'template/v_footer.php'; ?>
