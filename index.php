<?php
/*
session_start();

	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if (!empty($user_name) && !empty($password) && !is_numeric($user_name)){
			$query = "SELECT * FROM "
		}
		else{
			echo "incorrect username or password";
		}
	}
*/
?>


<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="signin.css" />
</head>
<body style="margin: 0px;">
	<div class="banner">
		<img src="Background.png" style="width:100%">
		<div class="centered">
			<h1 class="title">robonet</h1>
			<br>
			<form method="post">
				<div class="login">Login</div><br>

				<input type="text" name="user_name"><br><br>
				<input type="password" name="password"><br><br>
				<input class="LoginButton" type="submit" value="Login"><br><br><br>

				<a style="font-size:20px" href="signup.php">Signup</a><br><br>
			</form>
		</div>
	</div>
</body>
</html>