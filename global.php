<?php
session_start();

	include("connection.php");
	include("checklogin.php");

	$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	This is the global page

	<br><br>

	Signed in as <?php echo $user_data['username']; ?>
	<br>
	<a href="logout.php">Logout</a>
</body>
</html>