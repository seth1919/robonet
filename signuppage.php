<?php
session_start();

	include("connection.php");

	$error_message;

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if (!empty($user_name) && !empty($password) && !is_numeric($user_name)){
			$query = "SELECT * FROM logininfo where username = '$user_name' limit 1";

			$result = mysqli_query($con, $query);

			if ($result){
				if ($result && mysqli_num_rows($result) > 0){
					//another user has this account
					$error_message = "Sorry, that username is taken";
				}
			}
		}
		else{
			$error_message = "Enter a valid username and password";
		}

		if (empty($error_message)){
			if (!empty($user_name) && !empty($password) && !is_numeric($user_name)){
				
				$query = "insert into logininfo (userID,username,password) values (NULL,'$user_name','$password')";

				mysqli_query($con, $query);

				$user_search = $_POST["user_name"];
				// if the user exists, display their last 10 messages
				$searchQuery = "SELECT * FROM logininfo where username = '$user_search' LIMIT 1";
				$searchResult = mysqli_query($con, $searchQuery);
				if ($searchResult){
					if ($searchResult && mysqli_num_rows($searchResult) > 0){
						$searchData = mysqli_fetch_assoc($searchResult);
						
						$insertQuery = "insert into userprofiles (userID,age,gender,location,bio) values (". $searchData['userID'] .",675,2,'no data','not set')";
						mysqli_query($con, $insertQuery);
					}
				}

				header("Location: signinpage.php");
				die;
			}else{
				$error_message = "Enter a valid username and password";
			}
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
				<h1 style="margin-left: 15px">Create a Robonet account </h1>
			</div>
			<form method="post">
				<div class="messageEntry">
					<div class="messageEntryTextOther">
						<div style="margin-left: 20px">Create a username</div>
					</div>
				</div>
				<input type="text" name="user_name" class="signinTextbox">

				<div class="messageEntry">
					<div class="messageEntryTextOther">
						<div style="margin-left: 20px">Create a password</div>
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
					<input type="submit" value="Sign Up" class="signinButton">
				</div
			</form>
		</div>
	</div>

	<div class="signInContent" style="margin-top: 0px">
		<div class="signinfield" style="margin-top: 0px">
			<div class="messageFieldHeader" style="display: flex; justify-content: center">
				<a href="signinpage.php" class="signintomakeapost">If you already have an account, sign in</a>
			</div>
		</div>
	</div>
</body>
</html>