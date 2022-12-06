<?php

//membuat koneksi ke database
include 'database/konfig.php';

//variabel nim yang dikirimkan form.php
$nama = $_GET['nama'];

//mengambil data
$query = mysqli_query($conn, "SELECT * FROM tb_data WHERE nama='$nama'");
$row = mysqli_fetch_array($query);
$data = array(
            'nisn'      =>  @$row['nisn'],
            'no_induk'      =>  @$row['no_induk'],
            'kelas'      =>  @$row['kelas'],);

//tampil data
echo json_encode($data);
?>