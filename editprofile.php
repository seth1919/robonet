<?php
session_start();

	include("connection.php");
	include("checklogin.php");

	$user_data = check_login($con);
	$error_message;

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$age_recieved = $_POST['age_input'];
		$gender_recieved = $_POST['gender_input'];
		$location_recieved = $_POST['location_input'];
		$bio_recieved = $_POST['bio_input'];

		if (empty($error_message)){
			if (!empty($age_recieved) && is_numeric($age_recieved) && !empty($location_recieved) && !empty($bio_recieved)){
				
				$query = "UPDATE userprofiles SET age=" . $age_recieved . ", gender=" . $gender_recieved . ", location='" . $location_recieved . "', bio='" . $bio_recieved . "' WHERE userID=" . $_SESSION['userID'];
				mysqli_query($con, $query);

				header("Location: editprofile.php");
				die;
			}else{
				$error_message = "No field can be left empty and age must be a number";
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
	<?php
		$user_search = $_SESSION['userID'];
		$searchQuery = "SELECT * FROM logininfo where userID = '$user_search' LIMIT 1";
		$searchResult = mysqli_query($con, $searchQuery);
		if ($searchResult){
			if ($searchResult && mysqli_num_rows($searchResult) > 0){
				$searchData = mysqli_fetch_assoc($searchResult);

				$user_search1 = $_GET["user_search"];
				$searchQuery1 = "SELECT * FROM userprofiles where userID = '" . $searchData['userID'] . "' LIMIT 1";
				$searchResult1 = mysqli_query($con, $searchQuery1);
				if ($searchResult1){
					if ($searchResult1 && mysqli_num_rows($searchResult1) > 0){
						$searchData1 = mysqli_fetch_assoc($searchResult1);
						?>
							<div class="userProfile">
								<div class="profileBackground">
									<div class="profileBox">
										<div class="userLogoBig">
										</div>
										<div style="margin-top: 50px; font-size: 18px; width: 50%">
											<?php
												echo $searchData['username'];
												echo "<hr>";
												echo "<br>";
												echo "Age: ";
												if ($searchData1['age'] != 675){
													echo $searchData1['age'];
												}
												else{
													echo "not set";
												}
												echo "<br>";
												echo "<br>";
												echo "Gender: ";
												if ( $searchData1['gender'] == 0){
													echo "male";
												}
												else if ( $searchData1['gender'] == 1){
													echo "female";
												}
												else{
													echo "not set";
												}
												echo "<br>";
												echo "<br>";
												echo "Lives in: ";
												echo $searchData1['location'];
												echo "<br>";
												echo "<br>";
												echo "Bio: ";
												echo $searchData1['bio'];
												echo "<br>";
											?>
										</div>
									</div>
								</div>
							</div>
						<?php
					}
				}
			}
		}
	?>

	<div class="signInContent">
		<div class="signinfield" style="margin-top: 0px">
			<div class="messageFieldHeader" style="display: flex; justify-content: center">
				<h1 style="margin-left: 15px">Edit your profile</h1>
			</div>
			<form method="post">
				<div class="messageEntry">
					<div class="messageEntryTextOther">
						<div style="margin-left: 20px">Enter your age</div>
					</div>
				</div>
				<input type="text" name="age_input" class="signinTextbox">

				<div class="messageEntry">
					<div class="messageEntryTextOther">
						<div style="margin-left: 20px">Choose your gender</div>
					</div>
				</div>
				<select name="gender_input" class="gender_dropdown">
					<option value="0">Male</option>
					<option value="1">Female</option>
				</select>

				<div class="messageEntry">
					<div class="messageEntryTextOther">
						<div style="margin-left: 20px">Enter your locaton</div>
					</div>
				</div>
				<input type="text" name="location_input" class="signinTextbox">

				<div class="messageEntry">
					<div class="messageEntryTextOther">
						<div style="margin-left: 20px">Enter a short description about yourself</div>
					</div>
				</div>
				<input type="text" name="bio_input" class="signinTextbox">

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
					<input type="submit" value="Submit" class="signinButton">
				</div
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