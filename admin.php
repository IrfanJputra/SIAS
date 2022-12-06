<?php
session_start();

if( !isset($_SESSION["level"]) ) {
	header("Location: login.php");
	exit;
}
?>

<?php include 'database/konfig.php' ?>
<?php include 'template/v_sidebar.php' ?>
<?php include 'template/v_header.php' ?>

<?php 

$query = mysqli_query($conn, 'SELECT * FROM tb_admin');
$array = mysqli_fetch_assoc($query);

?>

<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Admin</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <a href="tambah_admin.php" class="btn btn-danger" role="button">Tambah Admin</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>      
                <?php 
        include 'database/konfig.php';
        $no =1;
        $batas = 6;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
        $previous = $halaman - 1;
        $next = $halaman + 1;
        $data = mysqli_query($conn,"SELECT * FROM tb_admin");
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
        $data = mysqli_query($conn, "SELECT * FROM tb_admin LIMIT $halaman_awal, $batas");
        $nomor = $halaman_awal+1;
        while($baris= mysqli_fetch_array($data)){
            ?>
            <tr>
                
                <td><?php echo $no++; ?></td>
                <td><?php echo $baris['username']; ?>&nbsp;<span class="badge badge-danger"></span></td>
                <td><?php echo $baris['password']; ?></td>
                <td><?php echo $baris['level']; ?></td>
                <td>
                    <!-- <a class="btn btn-primary" href="edit_admin.php">Ubah</a>  -->
                    <a class="btn btn-danger" href="hapus_admin.php?id=<?= $baris["id_admin"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
                </td>
                </tr>
                </tr>
            <?php 
        }
        ?>
                </tbody>
            </table>
            <nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>

        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


<?php include 'template/v_footer.php' ?>