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
require 'function.php';
// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambah_data($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'tambah_data.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'tambah_data.php';
			</script>
		";
	}


}
?>


<div class="card-header py-3">
<h1 class="h4 mb-2 text-gray-800">Tambah Data Siswa</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
<form action="" method="POST" enctype="multipart/form-data" >

    <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control"  name="nama" id="nama" required>
  </div>
    <div class="mb-3">
    <label for="no_induk" class="form-label">No Induk</label>
    <input type="text" class="form-control"  name="no_induk" id="no_induk" required>
  </div>
    <div class="mb-3">
    <label for="nisn" class="form-label">NISN</label>
    <input type="text" class="form-control"  name="nisn" id="nisn" required>
  </div>
    <div class="mb-3">
    <label for="kelas" class="form-label">Kelas</label>
    <input type="text" class="form-control"  name="kelas" id="kelas" required>
  </div>
  <center>
    <div class="mb-3"><button class="btn btn-primary" type="submit" name="submit">Tambah Data</button></div>
    </center>
</form>



<div class="container-fluid">
<!-- Page Heading -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h1 class="h5 mb-2 text-gray-800">Data Siswa</h1>
</div>
<!-- DataTales Example -->

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Induk</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>      
                <?php 
        include 'database/konfig.php';
        $page = (isset($_GET['page']))? $_GET['page'] : 1;
        $limit = 10; 
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;

        $query = "SELECT * FROM tb_data ORDER BY nama ASC LIMIT $limit_start, $limit";
        $dewan1 = $conn->prepare($query);
        $dewan1->execute();
        $res1 = $dewan1->get_result();
        while ($row = $res1->fetch_assoc()) {
      ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $row["nama"]; ?></td>
          <td><?php echo $row["no_induk"]; ?></td>
          <td><?php echo $row["nisn"]; ?></td>
          <td><?php echo $row["kelas"]; ?></td>
          <td>
                    <a class="btn btn-primary" href="edit_data.php?id=<?= $row["id_data"]; ?>">Ubah</a> 
                    <a class="btn btn-danger" href="hapus_data.php?id=<?= $row["id_data"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
                </td>
        </tr>
      <?php } ?>

                </tbody>
            </table>
            <?php
          $query_jumlah = "SELECT count(*) AS jumlah FROM tb_data";
          $dewan1 = $conn->prepare($query_jumlah);
          $dewan1->execute();
          $res1 = $dewan1->get_result();
          $row = $res1->fetch_assoc();
          $total_records = $row['jumlah'];
        ?>
        <p>Total Siswa : <b> <?php echo $total_records; ?> </b></p>
        <nav class="mb-5">
          <ul class="pagination justify-content-end">
            <?php
              $jumlah_page = ceil($total_records / $limit);
              $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
              $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
              $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
              
              if($page == 1){
                echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
              } else {
                $link_prev = ($page > 1)? $page - 1 : 1;
                echo '<li class="page-item"><a class="page-link" href="?page=1">First</a></li>';
                echo '<li class="page-item"><a class="page-link" href="?page='.$link_prev.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
              }

              for($i = $start_number; $i <= $end_number; $i++){
                $link_active = ($page == $i)? ' active' : '';
                echo '<li class="page-item '.$link_active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
              }

              if($page == $jumlah_page){
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
              } else {
                $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                echo '<li class="page-item"><a class="page-link" href="?page='.$link_next.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item"><a class="page-link" href="?page='.$jumlah_page.'">Last</a></li>';
              }
            ?>
          </ul>
        </nav>
        </div>
    </div>
</div>
</div>

</div>
</div>
</div>

<?php include 'template/v_footer.php'; ?>
