<?php
session_start();
	include("connection.php");

	$error_message;

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
						header("Location: index.php");
						die;
					}
				}
			}

			$error_message = "Incorrect username or password";
		}
		else{
			$error_message = "Incorrect username or password";
		}
	}
?>

<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="signin.css" />
</head>
<body>
	<div class="mainHeader">
		<a href="/robonet" class="headerLogo"></a>
		<h1 class="robonettitle">ROBONET</h1>
		<div class="rightHeaderContent">
			<div class="UserBar">
				<div class="usernameDisplay">
				<?php
					if(isset($_SESSION['userID'])){
						echo "Signed in as Seth";
						echo "<hr>";
						echo "<a href='/robonet' class='logoutLink' >Profile</a>";
						echo "<a style='margin-left: 30px;' href='logoutpage.php' class='logoutLink' >Logout</a>";
					}
					else{
						echo "Not signed in";
						echo "<hr>";
						echo "<a href='signinpage.php' class='logoutLink'>Sign In</a>";
						echo "<a style='margin-left: 30px;' href='signuppage.php' class='logoutLink' >Sign Up</a>";
					}
				?>
				</div>
				<a href="/robonet" class="userLogo"></a>
			</div>
		</div>
	</div>
	<div class="signInContent">
		<div class="signinfield">
			<div class="messageFieldHeader" style="display: flex; justify-content: center">
				<h1 style="margin-left: 15px">Sign in to your Robonet account </h1>
			</div>
			<form method="post">
				<div class="messageEntry">
					<div class="messageEntryTextOther">
						<div style="margin-left: 20px">Enter your username</div>
					</div>
				</div>
				<input type="text" name="user_name" class="signinTextbox">

				<div class="messageEntry">
					<div class="messageEntryTextOther">
						<div style="margin-left: 20px">Enter your password</div>
					</div>
				</div>
				<input type="password" name="password" class="signinTextbox">

				<div class="messageEntryTextOther">
					<div style="margin-left: 20px; color: red;">
						<?php
							if (!empty($error_message)){
								echo $error_message;
							}
						?>
					</div>
				</div>

				<div style="display: flex; justify-content: center;">
				<input type="submit" value="Login" class="signinButton">
				</div
			</form>
		</div>
	</div>
</body>