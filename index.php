<?php
session_start();

	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if (!empty($user_name) && !empty($password) && !is_numeric($user_name)){
			$query = "SELECT * FROM logininfo where username = '$user_name' limit 1";

			$result = mysqli_query($con, $query);

			if ($result){
				if ($result && mysqli_num_rows($result) > 0){
					$user_data = mysqli_fetch_assoc($result);
					if($user_data['password'] === $password){
						$_SESSION['userID'] = $user_data['userID'];
						header("Location: global.php");
						die;
					}
				}
			}

			echo "incorrect username or password";
		}
		else{
			echo "incorrect username or password";
		}
	}
?>


<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="signin.css" />
</head>
<body style="margin: 0px;">
	<div class="mainHeader">
		<a href="/robonet" class="headerLogo"></a>
		<h1 class="robonettitle">ROBONET</h1>
		<div class="rightHeaderContent">
			<div class="UserBar">
				<div class="usernameDisplay">
					Signed in as Seth
					<hr>
					<a href="/robonet" class="logoutLink" >Profile</a>
					<a style="margin-left: 30px;" href="/robonet" class="logoutLink" >Logout</a>
				</div>
				<a href="/robonet" class="userLogo"></a>
			</div>
		</div>
	</div>
	<div class="banner">
		<div class="centered">
			<br>
			<form method="post">
				<div class="login">Login</div><br>

				<input type="text" name="user_name"><br><br>
				<input type="password" name="password"><br><br>
				<input class="LoginButton" type="submit" value="Login"><br><br><br>

				<a style="font-size:20px" href="signup.php">Click here to Signup</a><br><br>
			</form>
		</div>
	</div>

</body>
</html>