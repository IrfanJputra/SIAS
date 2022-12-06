<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rekap Mutasi</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
</head>  
<br>
<center>
<h3>LAPORAN DATA MUTASI SISWA </h3>
<h4>SDN-3 Kereng Bangkirai </h4>
</center>
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
        //ambil data dari 2 tabel
        $data = mysqli_query($conn, "SELECT * FROM tb_siswa, tb_status WHERE tb_siswa.id_mutasi = tb_status.id_mutasi ORDER BY tanggal DESC");
        while($baris= mysqli_fetch_array($data)){
            ?>
            <tr>
                
                <td><?php echo $no++; ?></td>
                <td><?php echo $baris['nama']; ?></td>
                <td><?php echo $baris['no_induk']; ?></td>
                <td><?php echo $baris['nisn']; ?></td>
                <td><?php echo $baris['jk']; ?></td>
                <td><b><?php echo $baris['mutasi'];?></b></td>
                <td><?php echo $baris['keterangan'];?></td>
                <td><?php echo $baris['tanggal'];?></td>
                <td><?php echo $baris['kelas'];?></td>
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