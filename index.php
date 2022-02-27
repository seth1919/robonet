<?php
session_start();
	include("connection.php");


	$user_data;
	$user_profile;
	if(isset($_SESSION['userID'])){
		$id = $_SESSION['userID'];
		$query = "select * from logininfo where userID = '$id' limit 1";

		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
		}

		$profileQuery = "select * from userprofiles where userID = '$id' limit 1";

		$profileResult = mysqli_query($con, $profileQuery);
		if ($profileResult && mysqli_num_rows($profileResult) > 0){
			$user_profile = mysqli_fetch_assoc($profileResult);
		}
	}
	else{

	}

	$error_message;
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		$insert_message = $_POST['new_message'];
		
		if (!empty($insert_message)){
			$query = $con->prepare("INSERT INTO messages (messageID, userID, message) VALUES (NULL, ?, ?)");
			$query->bind_param("is", $user_data['userID'], $insert_message);

			$query->execute();
			header("location: index.php");
		}
		else{
			$error_message = "The message cannot be empty";
		}
	}
?>


<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="signin.css" />
</head>
<body style="margin: 0px;">
	<?php
		$adname = "waterBottleAd.jpg";

		if (isset($_SESSION['userID'])){
			// find an ad which matches the user's data
			$ad;
			$adQuery = "select * from advertisements where (gender = " . $user_profile['gender'] . " OR gender = 2) AND lowerAge < " . $user_profile['age'] . " AND upperAge > " . $user_profile['age'] . " AND (location = 'Any' OR location = '" . $user_profile['location'] . "');";
			$adresult = mysqli_query($con, $adQuery);
			if ($adresult && mysqli_num_rows($adresult) > 0){
				$ad = mysqli_fetch_assoc($adresult);

				$adname = $ad['adName'];
				$adShowingDecrease = "UPDATE advertisements SET adShowings = " . ($ad['adShowings'] - 1) . " WHERE adID = " . $ad['adID'] . "";
				mysqli_query($con, $adShowingDecrease);
			}
		}
	?>

	<div class="advertisementContainer">
		<img src="advertisementImages/<?php echo $adname; ?>" class="advertisement">
	</div>

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
						echo "<a href='searchuser.php?user_search=";
						echo $user_data['username'];
						echo "' class='logoutLink' >Profile</a>";
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
	<div class="mainContent" style="margin-top: 0px">
		<div class="messageField">
			<div class="messageFieldHeader">
				<div style="width: 50px;">
				</div>
				<h1 style="margin-left: 15px"> Recent Messages </h1>
			</div>

			<?php
				//if there are any values in the table, display them one at a time
				$sql = "SELECT messageID, userID, message FROM messages ORDER BY messageID DESC LIMIT 10";
				$result = $messages->query($sql);
				
				if ($result->num_rows > 0){
					// output data of each row
					$message_count = 0;
					while ($row = $result->fetch_assoc()) {
						$message_count = $message_count + 1;
						$matching_user_query = "select * from logininfo where userID = '" . $row['userID'] . "' limit 1";
						$matching_user_result = mysqli_query($con, $matching_user_query);
						if ($matching_user_result && mysqli_num_rows($matching_user_result) > 0){
							$matching_user = mysqli_fetch_assoc($matching_user_result);
						}

						if ($message_count % 2 == 0){
							?>
								<div class="messageEntry">
									<div style="height: 30px; width: 50px; background-color: black;">
									</div>
									<div class="messageEntryText">
										<div style="margin-left: 20px; display: flex">
											<div style="width: 400px">
												<?php 
													echo "Message number: " . $row["messageID"]. "&nbsp&nbsp&nbsp&nbsp From user: ";
												?>
												<a href="searchuser.php?user_search=<?php echo $matching_user["username"] ?>" style="color: white;"><?php echo $matching_user["username"] ?></a>
											</div>
											<?php
												echo "&nbsp&nbsp&nbsp&nbsp " . $row["message"]. "<br>";
											?>
										</div>
									</div>
								</div>
							<?php
						}
						else{
							?>
								<div class="messageEntry">
									<div style="height: 30px; width: 50px; background-color: black;">
									</div>
									<div class="messageEntryTextOther">
										<div style="margin-left: 20px; display: flex">
											<div style="width: 400px">
												<?php 
													echo "Message number: " . $row["messageID"]. "&nbsp&nbsp&nbsp&nbsp From user: ";
												?>
												<a href="searchuser.php?user_search=<?php echo $matching_user["username"] ?>" style="color: white;"><?php echo $matching_user["username"] ?></a>
											</div>
											<?php
												echo "&nbsp&nbsp&nbsp&nbsp " . $row["message"]. "<br>";
											?>
										</div>
									</div>
								</div>
							<?php
						}
					}
				} else {
					echo "0 results";
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

	<?php
	if (isset($_SESSION['userID'])){
		?>
		<div class="signInContent" style="margin-top: 0px">
			<div class="signinfield" style="margin-top: 0px">
				<div class="messageFieldHeader" style="display: flex; justify-content: center">
					<h1 style="margin-left: 15px">Submit a post to the website</h1>
				</div>
				<form method="post">
					<div class="messageEntry">
						<div class="messageEntryTextOther">
							<div style="margin-left: 20px">Type your message here</div>
						</div>
					</div>
					<input type="text" name="new_message" class="signinTextbox">

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
						<input type="submit" value="Submit Post" class="signinButton">
					</div
				</form>
			</div>
		</div>
		<?php
	}
	else{
		?>
		<div class="signInContent" style="margin-top: 0px">
			<div class="signinfield" style="margin-top: 0px">
				<div class="messageFieldHeader" style="display: flex; justify-content: center">
					<a href="signinpage.php" class="signintomakeapost">Sign in to make a post</a>
				</div>
			</div>
		</div>
		<?php
	}
	?>
	
</body>
</html>