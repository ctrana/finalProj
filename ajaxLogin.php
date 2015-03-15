<?php
session_start();
//Turn on error reporting
//ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","tranac-db","GxMuVbwDqQKe5OMo","tranac-db");


if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

if(!($stmt = $mysqli->prepare("SELECT users.id FROM users WHERE users.username = ? AND users.password = ?"))){
	echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
}

if(!($stmt->bind_param("ss",$_POST['username'],$_POST['password']))){
	echo "Bind failed: "  . $mysqli->errno . " " . $mysqli->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($userId)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
$_SESSION['user']=&$userId;
$_SESSION['userName']=$_POST['username'];
echo json_encode($userId);
}
	
var_dump($_SESSION);

?>