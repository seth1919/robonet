<?php
session_start();

	include("connection.php");
	include("checklogin.php");

	$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<!-- display the 10 most recent messages posted to the site -->
	<?php
		$host = "localhost";
		$username = "root";
		$password = "";
		$database = "robonetusers";
		if (!$messages = mysqli_connect($host, $username, $password, $database)){
			die("failed to connect!");
		}
		//if there are any values in the table, display them one at a time
		$sql = "SELECT messageID, userID, message FROM messages";
		$result = $messages->query($sql);
		
		if ($result->num_rows > 0){
			// output data of each row
			while ($row = $result->fetch_assoc()) {
				echo "Message number: " . $row["messageID"]. " From user: " . $row["userID"]. " " . $row["message"]. "<br>";
			}
		} else {
			echo "0 results";
		}
	?>

	<br><br>

	Signed in as <?php echo $user_data['username']; ?>
	<br>
	<a href="logout.php">Logout</a>
</body>
</html>