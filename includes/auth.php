<?php
$hn = 'localhost';
$db = 'cliao7';
$un = 'root';
$pw = '';

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	$salt1 = "qm&h*";
	$salt2 = "pg!@";
	$username = $_SERVER['PHP_AUTH_USER'];
	$password = hash('ripemd128', $salt1.$_SERVER['PHP_AUTH_PW'].$salt2);
	$query  = "SELECT fname, lname FROM users WHERE username='$username' AND password='$password'";
	$result = $conn->query($query);
	if (!$result) die($conn->error);

	$rows = $result->num_rows;
	if ($rows==1) {
		$row = $result->fetch_assoc();
		echo "Hello ".$row['fname']." ".$row['lname'].", you are now logged in!";
	} else {
		die("Invalid username / password combination");
	}
} else {
	header('WWW-Authenticate: Basic realm="Restricted Section"');
	header('HTTP/1.0 401 Unauthorized');
	die ("Please enter your username and password");
}
?>
