<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "robonetusers";

if (!$con = mysqli_connect($host, $username, $password, $database)){
	die("failed to connect!");
}

if (!$messages = mysqli_connect($host, $username, $password, $database)){
	die("failed to connect!");
}