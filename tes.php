<?php
session_start();

if( !isset($_SESSION["level"]) ) {
	header("Location: login.php");
	exit;
}

?>

<pre><?php print_r($_SESSION) ?></pre>
<a href="logout">logout</a>