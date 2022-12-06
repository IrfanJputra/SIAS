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
<h1 class="h3 mb-2 text-gray-800">Data Siswa Mutasi</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <a href="tambah_mutasi.php" class="btn btn-danger" role="button">Tambah Siswa Mutasi</a>
    <a href="tambah_data.php" class="btn btn-primary" role="button">Data Siswa</a>
    </div>
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
                        <th>Jenis Kelamin</th>
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
        $data = mysqli_query($conn,"SELECT * FROM tb_siswa");
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
        $data = mysqli_query($conn, "SELECT * FROM tb_siswa , tb_status WHERE tb_siswa.id_mutasi = tb_status.id_mutasi LIMIT $halaman_awal, $batas");
        $nomor = $halaman_awal+1;
        while($baris= mysqli_fetch_array($data)){
            ?>
            <tr>
                
                <td><?php echo $no++; ?></td>
                <td><?php echo $baris['nama']; ?>&nbsp;<span class="badge badge-danger"><?php echo $baris['mutasi'];?></span></td>
                <td><?php echo $baris['no_induk']; ?></td>
                <td><?php echo $baris['nisn']; ?></td>
                <td><?php echo $baris['kelas']; ?></td>
                <td><?php echo $baris['jk']; ?></td>
                <td>
                    <a class="btn btn-primary" href="edit.php?id=<?= $baris["id"]; ?>">Ubah</a> 
                    <a class="btn btn-danger" href="hapus.php?id=<?= $baris["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
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