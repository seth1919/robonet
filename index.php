<?php
session_start();
	include("connection.php");


	$user_data;
	if(isset($_SESSION['userID'])){
		$id = $_SESSION['userID'];
		$query = "select * from logininfo where userID = '$id' limit 1";

		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
		}
	}
	else{

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
						echo $user_data['username'];
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