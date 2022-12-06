<?php 
session_start();

if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}

require 'database/konfig.php';

if( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$username'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;

			header("Location: index.php");
			exit;
		}
	}

	$error = true;

}

?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- CDN Icon Bootstrap 5 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


<!-- My CSS -->
<style type="text/css">
  body{
    background-color: rgb(235,235,235);
  }

</style>



	<title>Halaman Login</title>

</head>
<body>

<div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-form bg-light mt-4 p-4">
                    <form method="post" class="row g-3">
                        <h4 class="text-center">Login Admin</h4>
                        <?php if( isset($error) ) : ?>
	                    <p style="color: red; font-style: italic;">Username / Password Salah</p>
                        <?php endif; ?>
                        <div class="col-12">
                            <label>Email</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                        </div>
                        <div class="col-12">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Ingat saya</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="login" class="btn btn-dark float-end">Login</button>
                        </div>
                    </form>
                    <hr class="mt-4">
                    <div class="col-12">
                        <p class="text-center mb-0">Belum punya akun? <a href="registrasi.php">Daftar di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>







</body>
</html>