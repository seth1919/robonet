<?php
session_start();

	include("connection.php");
	include("checklogin.php");

	$user_data = check_login($con);

	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		$insert_message = $_POST['new_message'];
		
		$query = $con->prepare("INSERT INTO messages (messageID, userID, message) VALUES (NULL, ?, ?)");
		$query->bind_param("is", $user_data['userID'], $insert_message);

		$query->execute();
		header("location: global.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<!-- display the 10 most recent messages posted to the site -->
	Here's what people are saying now:
	<br>
	<?php
		$host = "localhost";
		$username = "root";
		$password = "";
		$database = "robonetusers";
		if (!$messages = mysqli_connect($host, $username, $password, $database)){
			die("failed to connect!");
		}
		//if there are any values in the table, display them one at a time
		$sql = "SELECT messageID, userID, message FROM messages ORDER BY messageID DESC LIMIT 10";
		$result = $messages->query($sql);
		
		if ($result->num_rows > 0){
			// output data of each row
			while ($row = $result->fetch_assoc()) {

				$matching_user_query = "select * from logininfo where userID = '" . $row['userID'] . "' limit 1";
				$matching_user_result = mysqli_query($con, $matching_user_query);
				if ($matching_user_result && mysqli_num_rows($matching_user_result) > 0){
					$matching_user = mysqli_fetch_assoc($matching_user_result);
				}

				echo "Message number: " . $row["messageID"]. "&nbsp&nbsp&nbsp&nbsp From user: " . $matching_user["username"]. "&nbsp&nbsp&nbsp&nbsp " . $row["message"]. "<br>";
			}
		} else {
			echo "0 results";
		}
	?>

	<br><br>

	<!-- display the 10 most recent posts by this user -->
	Your most recent posts: <br>
	<?php
		$host = "localhost";
		$username = "root";
		$password = "";
		$database = "robonetusers";
		if (!$messages = mysqli_connect($host, $username, $password, $database)){
			die("failed to connect!");
		}
		//if there are any values in the table, display them one at a time
		$sql = "SELECT messageID, userID, message FROM messages WHERE userID = " . strval($user_data['userID'] . " ORDER By messageID DESC LIMIT 10");
		$result = $messages->query($sql);
		
		if ($result->num_rows > 0){
			// output data of each row
			while ($row = $result->fetch_assoc()) {
				$matching_user_query = "select * from logininfo where userID = '" . $row['userID'] . "' limit 1";
				$matching_user_result = mysqli_query($con, $matching_user_query);
				if ($matching_user_result && mysqli_num_rows($matching_user_result) > 0){
					$matching_user = mysqli_fetch_assoc($matching_user_result);
				}

				echo "Message number: " . $row["messageID"]. "&nbsp&nbsp&nbsp&nbsp From user: " . $matching_user["username"]. "&nbsp&nbsp&nbsp&nbsp " . $row["message"]. "<br>";
			}
		} else {
			echo "0 results";
		}
	?>

	<br><br><br><br>

	<form method="post">
		<div class="login">Make a post</div><br>

		<input type="text" name="new_message"><br><br>
		<input class="LoginButton" type="submit" value="submit"><br><br><br>
	</form>

	<br><br><br><br>

	<form action="searchuser.php">
		<div class="login">Search for a user</div><br>

		<input type="text" name="user_search"><br><br>
		<input class="LoginButton" type="submit" value="search"><br><br><br>
	</form>

	<br><br>

	Signed in as <?php echo $user_data['username']; ?>
	<br>
	<a href="logout.php">Logout</a>
</body>
</html>