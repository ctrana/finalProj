<?php
session_start();
//Turn on error reporting
//ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","tranac-db","GxMuVbwDqQKe5OMo","tranac-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}	
if(!($stmt = $mysqli->prepare("INSERT INTO users(username, password) VALUES (?,?)"))){
	echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
}
if(!($stmt->bind_param("ss",$_POST['user'],$_POST['pass']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 	
$stmt->close();

?>