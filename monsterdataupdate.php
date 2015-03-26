<?php
session_start();

if (isset($_SESSION['username'])){

	if(isset($_POST[''])){
		$con = new mysqli("localhost","s1425535","InQzRF8RSn","s1425535");
		//$con = new mysqli("playground.eca.ed.ac.uk","s1425535","InQzRF8RSn","s1425535");
		if ($con->connect_errno) {
		   printf("Connect failed: %s\n", $con->connect_error);
		   exit();
		}

		$stmt=$con->prepare("INSERT INTO s1425535.bigmonsters(ownerNum,name,description,houseid,adopttime,adoptip) VALUES ('".$_SESSION["username"]."','".$_POST["newname"]."','".$_POST["newdescription"]."','".$_POST["newhouse"]."','".date('Y-m-d H:i:s',time())."','".$_SERVER["REMOTE_ADDR"]."')");
		$stmt->execute();
		$stmt->close();
		
		$_POST["monsterid"]=mysqli_insert_id($con);
		mysql_close($con);
	}

	if (!isset($_POST['monsterid'])){
		header('Location: login.php');
	}

	if (isset($_POST['logout'])) {
		unset($_SESSION['username']);
		header('Location: login.php');
	}


}

?>