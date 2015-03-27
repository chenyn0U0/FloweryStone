<?php

function checklogstatus(){
	session_start(); 
	if (!isset($_SESSION['username'])){
		header('Location: login.php');
	}

	if (isset($_POST['logout'])) {
		unset($_SESSION['username']);
		header('Location: login.php');
	}
}

function getconnection(){
	$con = new mysqli("localhost","s1425535","InQzRF8RSn","s1425535");
	//$con = new mysqli("playground.eca.ed.ac.uk","s1425535","InQzRF8RSn","s1425535");
	if ($con->connect_errno) {
	   printf("Connect failed: %s\n", $con->connect_error);
	   exit();
	}
	return $con;
}



function runsql($con,$sql){
	$stmt=$con->prepare($sql);
	$stmt->execute();
	return $stmt;
}

function sqlselectcheck($con,$sql){
	$stmt=$con->prepare($sql);
	$stmt->execute();
	if(!$stmt->fetch()) $result=false;
	else $result=true;
	$stmt->close();
	return $result;
}

// function getselectresult($con,$sql,$columnamount){
// 	$stmt=$con->prepare($sql);
// 	$stmt->execute();
// 	$stmt->bind_result();




// 	if(!$stmt->fetch()) $result=false;
// 	else $result=true;
// 	$stmt->close();
// 	return $result;
// }

?>