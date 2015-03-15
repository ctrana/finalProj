<?php
	session_start();
	//Turn on error reporting
	ini_set('display_errors', 'On');
	//Connects to the database
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","tranac-db","GxMuVbwDqQKe5OMo","tranac-db");
	$_SESSION['share']=1;
	$result=array();
	if(!($stmt = $mysqli->prepare("SELECT carReview.make, carReview.model, carReview.year, carReview.comments FROM carReview WHERE carReview.user = ? OR carReview.share = ?"))){
		echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
	}
					
	if(!($stmt->bind_param("ii",$_SESSION['user'],$_SESSION['share']))){
		echo "Bind failed: "  . $mysqli->errno . " " . $mysqli->error;
	}
					
	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	if(!$stmt->bind_result($make, $model, $year, $comments)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	while($stmt->fetch()){
		$result[]=$make.$model.$year.$comments;
	}
	echo json_encode
	$stmt->close();
									
?>