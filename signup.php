<?php
session_start();

	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if (!empty($user_name) && !empty($password) && !is_numeric($user_name)){
			
			$query = "insert into logininfo (userID,username,password) values (NULL,'$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: global.php");
			die;
		}else{
			echo "Username or Password is not valid";
		}
	}
?>

<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="signin.css" />
</head>
<body style="margin: 0px;">
	<div class="banner">
		<img src="Background1.png" style="width:1080px;height:1080px;">
		<div class="centered">
			<h1 class="blacktitle">robonet</h1>
			<br>
			<form method="post">
				<div class="signup">Signup</div><br>

				<input type="text" name="user_name"><br><br>
				<input type="password" name="password"><br><br>
				<input class="LoginButton" type="submit" value="Signup"><br><br><br>

				<a style="font-size:20px" href="index.php">Click here to Login</a><br><br>
			</form>
		</div>
	</div>
</body>
</html>