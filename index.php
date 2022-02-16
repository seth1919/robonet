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
	<div class="mainContent">
		<div class="messageField">
			<div class="messageFieldHeader">
				<div style="width: 50px;">
				</div>
				<h1 style="margin-left: 15px"> Recent Messages </h1>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryText">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryTextOther">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryText">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryTextOther">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
		</div>
		<div class="messageField">
			<div class="messageFieldHeader">
				<div style="width: 50px;">
				</div>
				<h1 style="margin-left: 15px"> Recent Messages </h1>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryText">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryTextOther">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryText">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryTextOther">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
		</div>
		<div class="messageField">
			<div class="messageFieldHeader">
				<div style="width: 50px;">
				</div>
				<h1 style="margin-left: 15px"> Recent Messages </h1>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryText">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryTextOther">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryText">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryTextOther">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
		</div>
		<div class="messageField">
			<div class="messageFieldHeader">
				<div style="width: 50px;">
				</div>
				<h1 style="margin-left: 15px"> Recent Messages </h1>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryText">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryTextOther">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryText">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
			<div class="messageEntry">
				<div style="height: 30px; width: 50px; background-color: black;">
				</div>
				<div class="messageEntryTextOther">
					<div style="margin-left: 20px">Message Text</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>