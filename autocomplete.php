<?php include 'database/konfig.php';?>
<?php
$searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna

$sql="SELECT * FROM tb_data WHERE nama LIKE '%".$searchTerm."%' ORDER BY nama ASC"; // query sql untuk menampilkan data mahasiswa dengan operator LIKE

$hasil=mysqli_query($conn,$sql); //Query dieksekusi

//Disajikan dengan menggunakan perulangan
while ($row = mysqli_fetch_array($hasil)) {
    $data[] = $row['nama'];
 
}
//Nilainya disimpan dalam bentuk json
echo json_encode($data);
?>