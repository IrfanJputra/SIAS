<?php
//Koneksi ke database
$conn = mysqli_connect("localhost:3306","root","","db_mutasi");


//tambah data
function tambah($data){

    global $conn;
    $mutasi     = htmlspecialchars($data["mutasi"]);
    $nama       = htmlspecialchars($data["nama"]);
    $no_induk   = htmlspecialchars($data["no_induk"]);
    $nisn       = htmlspecialchars($data["nisn"]);
    $kelas       = htmlspecialchars($data["kelas"]);
    $jk         = htmlspecialchars($data["jk"]);
    $tanggal    = date("Y-m-d H:i:s");
    
    $query = "INSERT INTO tb_siswa 
                    VALUES (NULL,'$mutasi', '$nama', '$no_induk', '$nisn', '$kelas', '$jk', '$tanggal')";
   
   
   mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//hapus data
function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_siswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}

//edit data

function edit($id){

    global $conn;
    if (isset($_POST['submit'])){
        $nama       = $_POST["nama"];
        $no_induk   = $_POST["no_induk"];
        $nisn       = $_POST["nisn"];
        $kelas       = $_POST["kelas"];
        $jk         = $_POST["jk"];
      
      
      $sqlUpdate = "UPDATE tb_siswa 
                    SET nama='$nama', no_induk='$no_induk', nisn='$nisn', kelas='$kelas', jk='$jk'
                    WHERE id= '$id'";
      $query= mysqli_query($conn, $sqlUpdate);
}
}

function tambah_surat($data){

    global $conn;
    $no_berkas              = htmlspecialchars($data["no_berkas"]);
    $alamat_pengirim        = htmlspecialchars($data["alamat_pengirim"]);
    $tanggal                = htmlspecialchars($data["tanggal"]);
    $perihal                = htmlspecialchars($data["perihal"]);


    // upload gambar
	$file_surat = upload();
	if( !$file_surat ) {
		return false;
	}
    
    $query = "INSERT INTO tb_masuk 
                    VALUES (NULL,'$no_berkas', '$alamat_pengirim', '$tanggal', '$perihal', '$file_surat')";
   
   
   mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {

	$namaFile = $_FILES['file_surat']['name'];
	$ukuranFile = $_FILES['file_surat']['size'];
	$error = $_FILES['file_surat']['error'];
	$tmpName = $_FILES['file_surat']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiFileValid = ['jpg', 'png', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if( !in_array($ekstensiFile, $ekstensiFileValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if( $ukuranFile > 10000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'upload/' . $namaFileBaru);

	return $namaFileBaru;
}

//hapus msurat
function hapus_msurat($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_masuk WHERE id_masuk = $id");
	return mysqli_affected_rows($conn);
}


//tambah data di tb_data
function tambah_data($data){

    global $conn;
    $nama       = htmlspecialchars($data["nama"]);
    $nisn       = htmlspecialchars($data["nisn"]);
    
    $query = "INSERT INTO tb_data 
                    VALUES (NULL,'$nama','$nisn')";
   
   
   mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//hapus data
function hapus_data($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_data WHERE id_data = $id");
	return mysqli_affected_rows($conn);
}

//auto complete
// function autocomplete($data){

// $searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna

// $sql="SELECT * FROM tb_data WHERE nama LIKE '%".$searchTerm."%' ORDER BY nama ASC"; // query sql untuk menampilkan data mahasiswa dengan operator LIKE

// $hasil=mysqli_query($conn,$sql); //Query dieksekusi

// //Disajikan dengan menggunakan perulangan
// while ($row = mysqli_fetch_array($hasil)) {
//     $data[] = $row['nama'];
 
// }
// //Nilainya disimpan dalam bentuk json
// echo json_encode($data);

// }


	function tambah_ksurat($data){

		global $conn;
		$no_berkas              = htmlspecialchars($data["no_berkas"]);
		$alamat_penerima       = htmlspecialchars($data["alamat_penerima"]);
		$tanggal                = htmlspecialchars($data["tanggal"]);
		$perihal                = htmlspecialchars($data["perihal"]);
	
	
		// upload gambar
		$file_surat = upload();
		if( !$file_surat ) {
			return false;
		}
		
		$query = "INSERT INTO tb_keluar 
						VALUES (NULL,'$no_berkas', '$alamat_penerima', '$tanggal', '$perihal', '$file_surat')";
	   
	   
	   mysqli_query($conn, $query);
	
		return mysqli_affected_rows($conn);
	}

	//hapus data ksurat
function hapus_ksurat($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_keluar WHERE id_keluar = $id");
	return mysqli_affected_rows($conn);
}


//registrasi

function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM tb_admin WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
	}


	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO tb_admin VALUES(NULL, '$username', '$password')");

	return mysqli_affected_rows($conn);

}


//hapus admin

function hapus_admin ($id){

global $conn;
mysqli_query($conn, "DELETE FROM tb_admin WHERE id_admin = $id");
return mysqli_affected_rows($conn);
}


?>

