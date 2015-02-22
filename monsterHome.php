<?php
	session_start(); 
	if (!isset($_SESSION['phonenumber'])||!isset($_POST['monsterid'])){
		header('Location: login.php');
	}

	if($_POST['monsterid']!=0){
		$con = new mysqli("localhost","s1425535","InQzRF8RSn","s1425535");
		//$con = new mysqli("playground.eca.ed.ac.uk","s1425535","InQzRF8RSn","s1425535");
		if ($con->connect_errno) {
		   printf("Connect failed: %s\n", $con->connect_error);
		   exit();
		}

		$stmt=$con->prepare("SELECT bigmonsters.id,bigmonsters.name,bigmonsters.description,houseinfo.housepic FROM s1425535.bigmonsters,s1425535.houseinfo where bigmonsters.id=".$_POST['monsterid']." and bigmonsters.houseid=houseinfo.houseid and bigmonsters.ownerNum=".$_SESSION['phonenumber'].";");
		$stmt->execute();
		$stmt->bind_result($monsterid,$monstername,$description,$housepic);
?>


<?php
		$stmt->fetch();
		printf("<div id='monsterhome'><p>%s</p><h1>%s </h1><h2>'s HOME</h2><p>%s</p><img src='%s'></img><div>",$monsterid,$monstername,$description,$housepic); 
		$stmt->close();
		$con->close();
	}
	else{//newhouse
		echo "newhouse!";
	}
?>


