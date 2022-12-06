<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

?>

<?php include 'template/v_sidebar.php'; ?>
<?php include 'template/v_header.php'; ?>

<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Surat Masuk</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <a href="tambah_msurat.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Berkas</th>
                        <th>Alamat Pengirim</th>
                        <th>Tanggal</th>
                        <th>Perihal</th>
                        <th>File Surat</th>
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
        $data = mysqli_query($conn,"SELECT * FROM tb_masuk");
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
        $data = mysqli_query($conn, "SELECT * FROM tb_masuk LIMIT $halaman_awal, $batas");
        $nomor = $halaman_awal+1;
        while($baris= mysqli_fetch_array($data)){
            ?>
            <tr>
                
                <td><?php echo $no++; ?></td>
                <td><?php echo $baris['no_berkas']; ?></td>
                <td><?php echo $baris['alamat_pengirim']; ?></td>
                <td><?php echo $baris['tanggal']; ?></td>
                <td><?php echo $baris['perihal']; ?></td>
                <td><a href="upload/<?php echo $baris['file_surat']; ?>" target="_blank"><img src="upload/<?php echo $baris['file_surat']; ?>" width="50"> </a></td>
                <td>
                    <a class="btn btn-primary" href="edit_msurat.php?id=<?= $baris["id_masuk"]; ?>">Ubah</a> 
                    <a class="btn btn-danger" href="hapus_msurat.php?id=<?= $baris["id_masuk"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
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
<?php include 'template/v_footer.php'; ?>







