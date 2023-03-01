<?php 
session_start();

	include("connection.php");
	include("operations.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>This is the index page</h1>

	<br>
	Hello, <?php echo $user_data['firstName']; ?>

	<br></br>

	<input type="button" value="initialization" onclick="location='initialize_database.php'" />

</body>
</html>

<?php
#Reference: https://www.youtube.com/watch?v=WYufSGgaCZ8

?>