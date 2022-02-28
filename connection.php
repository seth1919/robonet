<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "robonetusers";

$con = mysqli_connect($host, $username, $password);
$databaseCheck = "CREATE DATABASE IF NOT EXISTS robonetusers";
mysqli_query($con, $databaseCheck);
$connectQuery = "use robonetusers";
mysqli_query($con, $connectQuery);
$tableCheck = "CREATE TABLE IF NOT EXISTS advertisements(
	adID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	gender INT(11) UNSIGNED NOT NULL,
	lowerAge INT(11) UNSIGNED NOT NULL,
	upperAge INT(11) UNSIGNED NOT NULL,	
	location varchar(50) NOT NULL,
	adName varchar(500) NOT NULL,
	adShowings int(11) UNSIGNED NOT NULL
)";
mysqli_query($con, $tableCheck);
$tableCheck1 = "CREATE TABLE IF NOT EXISTS logininfo(
	userID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username varchar(50) NOT NULL,
	password varchar(50) NOT NULL
)";
mysqli_query($con, $tableCheck1);
$tableCheck2 = "CREATE TABLE IF NOT EXISTS messages(
	messageID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	userID INT(11) UNSIGNED NOT NULL,
	message varchar(500) NOT NULL
)";
mysqli_query($con, $tableCheck2);
$tableCheck3 = "CREATE TABLE IF NOT EXISTS userprofiles(
	userID INT(11) UNSIGNED NOT NULL,
	age INT(11) UNSIGNED NOT NULL,
	gender INT(11) UNSIGNED NOT NULL,
	location varchar(50) NOT NULL,
	bio varchar(500) NOT NULL
)";
mysqli_query($con, $tableCheck3);

if (!$messages = mysqli_connect($host, $username, $password, $database)){
	die("failed to connect!");
}