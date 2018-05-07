<?php
require_once 'includes/auth.php';
require_once 'includes/header2.php';
require_once 'includes/functions.php';
?>
  
    <?php
if (isset($_POST['submit'])) { //check if the form has been submitted
	if ((empty($_POST['e_name'])) || (empty($_POST['type'])) || (empty($_POST['date']))|| (empty($_POST['g_number'])) ) {
		$message = '<p class="error">Please fill out all of the form fields!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$e_name = sanitizeMySQL($conn, $_POST['e_name']);
		$type = sanitizeMySQL($conn, $_POST['type']);			
		$date = sanitizeMySQL($conn, $_POST['date']);
		$g_number = sanitizeMySQL($conn, $_POST['g_number']);
		$query = "INSERT INTO events VALUES(NULL, \"$e_name\", \"$type\", \"$date\", \"$g_number\", NULL)";
		$result = $conn->query($query);
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
			$message = "<p class=\"message\">Successfully Added! <a href=\"index.php\">Return to homepage!</a></p>";
		}
	}
}
?>

<?php 
include_once 'includes/header.php'; 
if (isset($message)) echo $message;
?>

<form method="post" action="">
	<fieldset>
		<legend>Add New Event</legend>
		<label for="e_name">Event Name:</label>
		<input type="text" name="e_name"><br> 
		<label for="type">Type:</label>
		<input type="text" name="type"><br> 
		<label for="date">Date:</label> 
		<input type="datet" name="date"><br> 
		<label for="g_number">Guest_number:</label>
		<input type="text" name="g_number"><br> 
		<input type="submit" name="submit">
	</fieldset>
</form>
<?php include_once 'includes/footer.php'; ?>
