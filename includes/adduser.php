
<?php
$hn = 'localhost';
$db = 'cliao7';
$un = 'root';
$pw = '';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$salt1 = "qm&h*";
$salt2 = "pg!@";
$fname = 'ChinMi';
$lname = 'Liao';
$username = 'cliao';
$password = 'happycoding2018';
$token = hash('ripemd128', "$salt1$password$salt2");

$query  = "INSERT INTO user VALUES(NULL, '$fname', '$lname', '$username', '$token')";
$result = $conn->query($query);
if (!$result) die($conn->error);
?>
