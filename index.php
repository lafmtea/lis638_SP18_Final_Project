<?php
require_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';
?>
  
  <p>
  We're thrilled to share our recent information with our cases! Sign up for email below!
  </p>
    <?php
if (isset($_POST['submit'])) { //check if the form has been submitted
	if ((empty($_POST['fname'])) || (empty($_POST['lname'])) || (empty($_POST['email'])) ) {
		$message = '<p class="error">Please fill out all of the form fields!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$fname = sanitizeMySQL($conn, $_POST['fname']);
		$lname = sanitizeMySQL($conn, $_POST['lname']);			
		$email = sanitizeMySQL($conn, $_POST['email']);
		$query = "INSERT INTO email_list VALUES(NULL, \"$fname\", \"$lname\", \"$email\")";
		$result = $conn->query($query);
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
			$message = "<p class=\"message\">Successfully Subscribe! <a href=\"index.php\">Return to homepage!</a></p>";
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
		<legend>Subcribe US</legend>
		<label for="fname">First Name:</label>
		<input type="text" name="fname"><br> 
		<label for="lname">Last Name:</label>
		<input type="text" name="lname"><br> 
		<label for="lname">Email:</label> 
		<input type="text" name="email"><br> 
		<input type="submit" name="submit">
	</fieldset>
</form>
<?php include_once 'includes/footer.php'; ?>
