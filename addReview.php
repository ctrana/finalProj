<?php
session_start();
//Turn on error reporting
//ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","tranac-db","GxMuVbwDqQKe5OMo","tranac-db");

if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}	

if(!($stmt = $mysqli->prepare("INSERT INTO carReview (make, model, year, comments, share, user) VALUES (?,?,?,?,?,?)"))){
	echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
}

if(!($stmt->bind_param("ssisii",$_POST['make'],$_POST['model'],$_POST['year'],$_POST['comments'],$_POST['share'],$_SESSION['user']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 	

while($stmt->fetch()){
	var_dump($_POST);
	var_dump($_SESSION);
}

$stmt->close();


?>