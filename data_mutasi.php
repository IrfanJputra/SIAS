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


<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Mutasi</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <!-- <a href="tambah_mutasi.php" class="btn btn-primary" role="button">Tambah Data</a> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mutasi</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>      
                <?php 
        include 'database/konfig.php';
        $no =1;
        $data = mysqli_query($conn, 'SELECT * FROM tb_status');
        while($baris= mysqli_fetch_array($data)){
            ?>
            <tr>
                
                <td><?php echo $no++; ?></td>
                <td><?php echo $baris['mutasi']; ?></td>
                <td><?php echo $baris['keterangan']; ?></td>
                <td>
                    <a class="btn btn-primary" href="edit_mutasi.php?id=<?= $baris["id_mutasi"]; ?>">Ubah</a> 
                    <!-- <a class="btn btn-danger" href="hapus_mutasi.php?id=<?= $baris["id_mutasi"]; ?>" onclick="return confirm('yakin?');">Hapus</a> -->
                </td>
                </tr>
                </tr>
            <?php 
        }
        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include 'template/v_footer.php'; ?>