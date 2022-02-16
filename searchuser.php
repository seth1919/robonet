<?php

session_start();

	include("connection.php");
	include("checklogin.php");

	$sign_in = check_login($con);

	$user_search = $_GET["user_search"];

	// if the user exists, display their last 10 messages
	$query = "SELECT * FROM logininfo where username = '$user_search' LIMIT 1";

	$result = mysqli_query($con, $query);

	if ($result){
		if ($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			//display the last 10 messages by this user
			//if there are any values in the table, display them one at a time
			$sql = "SELECT messageID, userID, message FROM messages WHERE userID = " . strval($user_data['userID'] . " ORDER By messageID DESC LIMIT 10");
			$result = $con->query($sql);
			
			echo "The most recent posts from " . $user_data['username']; 
			echo "<br>";
			if ($result->num_rows > 0){
				// output data of each row
				while ($row = $result->fetch_assoc()) {
					echo "Message number: " . $row["messageID"]. "&nbsp&nbsp&nbsp&nbsp From user: " . $user_search . "&nbsp&nbsp&nbsp&nbsp " . $row["message"]. "<br>";
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

<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<br><br>

	<a href="global.php">Back to main page</a>

	<br><br>
	Signed in as <?php echo $sign_in['username']; ?>
	<br>
	<a href="logout.php">Logout</a>
</body>
</html>