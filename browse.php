<?php

include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

	$query = "SELECT e_name, type, date, g_number FROM events";
	$result = $conn->query($query);
			echo '<h1>Event Overview</h1>';
			echo "<table align='center'><th>Event Name</th><th>Event Type</th><th>Date</th><th>Guest number</th>";
					while($row = $result->fetch_assoc()){
							echo "<tr><td>" . $row['e_name'] . "</td><td>" . $row['type'] . "</td><td>" . $row['date'] . "</td>
					<td>" . $row['g_number'] . "</td></tr>";}
			echo "</table>";

	echo "<p><a href=\"index.php\">Return to homepage</a></p>";
	
?>

<?php
require_once 'includes/footer.php';
?>