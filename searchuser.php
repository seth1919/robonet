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
<html>
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

			<?php
				$user_search = $_GET["user_search"];

				// if the user exists, display their last 10 messages
				$query = "SELECT * FROM logininfo where username = '$user_search' LIMIT 1";

				$result = mysqli_query($con, $query);

				if ($result){
					if ($result && mysqli_num_rows($result) > 0){
						$user_data1 = mysqli_fetch_assoc($result);

						?>
						<div class="messageFieldHeader">
							<div style="width: 50px;"></div>
							<h1 style="margin-left: 15px">
						<?php
						echo "The most recent posts from " . $user_data1['username']; 
						echo "  </h1> </div>";

						//display the last 10 messages by this user
						//if there are any values in the table, display them one at a time
						$sql = "SELECT messageID, userID, message FROM messages WHERE userID = " . strval($user_data1['userID'] . " ORDER By messageID DESC LIMIT 10");
						$result = $con->query($sql);
						
						if ($result->num_rows > 0){
							// output data of each row
							while ($row = $result->fetch_assoc()) {
								?>
									<div class="messageEntry">
										<div style="height: 30px; width: 50px; background-color: black;">
										</div>
										<div class="messageEntryTextOther">
											<div style="margin-left: 20px">
											<?php 
												echo "Message number: " . $row["messageID"]. "&nbsp&nbsp&nbsp&nbsp From user: " . $user_data1["username"]. "&nbsp&nbsp&nbsp&nbsp " . $row["message"]. "<br>";
											?>
											</div>
										</div>
									</div>
								<?php
							}
						} else {
							echo "0 results";
						}
					}
					else{
						echo "no user with the username " . $user_search . " could be found.";
					}
				}
				else{
					echo "no user with the username " . $user_search . " could be found.";
				}
			?>
		</div>
	</div>
	<div class="signInContent" style="margin-top: 0px">
		<div class="signinfield" style="margin-top: 0px">
			<div class="messageFieldHeader" style="display: flex; justify-content: center">
				<h1 style="margin-left: 15px">Search for a user</h1>
			</div>
			<form action="searchuser.php">
				<div class="messageEntry">
					<div class="messageEntryTextOther">
						<div style="margin-left: 20px">Enter the username here</div>
					</div>
				</div>
				<input type="text" name="user_search" class="signinTextbox">

				<div class="messageEntryTextOther">
					<div style="margin-left: 20px; color: red;">
					</div>
				</div>

				<div style="display: flex; justify-content: center;">
					<input type="submit" value="Search" class="signinButton">
				</div>
			</form>
		</div>
	</div>
	<div class="signInContent" style="margin-top: 0px">
		<div class="signinfield" style="margin-top: 0px">
			<div class="messageFieldHeader" style="display: flex; justify-content: center">
				<a href="index.php" class="signintomakeapost">Back to home page</a>
			</div>
		</div>
	</div>
</body>
</html>