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
<h1 class="h3 mb-0 text-gray-800">Siswa Mutasi</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="cetak_mutasi.php" target="_BLANK" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-print fa-sm text-white-50"></i> Print</a>
    </div>
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
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Kelas</th>
                        </tr>
                </thead>
                <tbody> 
                <?php 
        include 'database/konfig.php';
        $no =1;
        $batas = 10;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
        $previous = $halaman - 1;
        $next = $halaman + 1;
        $data = mysqli_query($conn,"SELECT * FROM tb_masuk");
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
        //ambil data dari 2 tabel
        $data = mysqli_query($conn, "SELECT * FROM tb_siswa, tb_status WHERE tb_siswa.id_mutasi = tb_status.id_mutasi ORDER BY tanggal DESC LIMIT $halaman_awal, $batas");
        $nomor = $halaman_awal+1;
        while($baris= mysqli_fetch_array($data)){
            ?>
            <tr>
                
                <td><?php echo $no++; ?></td>
                <td><?php echo $baris['nama']; ?></td>
                <td><?php echo $baris['no_induk']; ?></td>
                <td><?php echo $baris['nisn']; ?></td>
                <td><?php echo $baris['jk']; ?></td>
                <td><span class="badge badge-danger"><?php echo $baris['mutasi'];?></span></td>
                <td><?php echo $baris['keterangan'];?></td>
                <td><?php echo $baris['tanggal'];?></td>
                <td><?php echo $baris['kelas']; ?></td>
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