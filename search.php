<?php

include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';
?>

<?php
	
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		
if (isset($_GET['type'])) {
	$type = sanitizeMySQL($conn, $_GET['type']);
	$query = "SELECT 'e_name','type','date','g_number' FROM `events` WHERE `type` = ".$type;
	$result = $conn->query($query);
	if (!$result) die ("No event found with type of $type.");
	$rows = $result->num_rows;
		while ($row = $result->fetch_assoc()) {
			echo '<h1>Event History</h1>';
			echo "<table><th>Event Name</th><th>Type</th><th>Date</th><th>Guest number</th>";
					while($row = $result->fetch_assoc()){
							echo "<tr><td>" . $row['e_name'] . "</td><td>" . $row['type'] . "</td><td>" . $row['date'] . "</td>
					<td>" . $row['g_number'] . "</td></tr>";}
			echo "</table>";
	}
	
	echo "<p><a href=\"index.php\">Return to homepage</a></p>";
}	


?>

<form action="" method="get">
	<fieldset>
		<legend>Select Event Type</legend>
		
		<select name="type">
		<option value="Conference">Conference</option>
		<option value="Campaign">Campaign</option>
		<option value="Competition">Competition</option>
	</select>
		<input type="submit" name="submit">
	</fieldset>
</form>

<?php
require_once 'includes/footer.php';
?>