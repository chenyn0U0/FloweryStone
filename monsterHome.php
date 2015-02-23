<?php 
	session_start(); 
	if (!isset($_SESSION['phonenumber'])||!isset($_POST['monsterid'])){
		header('Location: login.php');
	}

	if (isset($_POST['logout'])) {
		unset($_SESSION['phonenumber']);
		header('Location: login.php');
	}
?>

<!DOCTYPE html>  
<html lang="en">  
<head>
	<meta charset="UTF-8">
	<title>Time Management</title>

	<link rel="stylesheet" href="stylesheets/mainstyle.css">
	<script src="js/jquery.js"></script>

	<script type="text/javascript">
		function logout(){
	        if(confirm("Are you sure you want to log out?"))
	        {
	        	document.getElementById('logout').click();
	        }
		}
	</script>
</head>

<body>
	<div class="headercontainer">
		<div class="header">
			<div id="logocontainer">
				<div id="logo">
					<img src="img/logo.png">
				</div>
				<div id="logotext">
					<h1 style="margin-bottom:5px"><b>M</b>ami <b>M</b>onster</h1>
					<p style="color:white;margin-top:5px">WORK <b>SMART</b> LIVE <b>BETTER</b></p>
				</div>
			</div>
			<div id="userstatus">
				<a href="javascript:logout()"><img src="img/user-m.png"/> <b><?php echo $_SESSION['phonenumber']; ?></b></a>
				<form action="" method="POST">
				<input style="display:none" type="submit" name="logout" id="logout">
				</form>
			</div>
		</div>
	</div>
	<div class="pagecontextcontainer">
		<div class="pagecontext" style="text-align:left">
			<div id="lefthomediv">
				<div id='monsterhome'>


<?php
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
		printf("<h1>%s </h1><h3>'s HOME</h3><p>%s</p><img src='%s'></img>",$monstername,$description,$housepic); 
		$stmt->close();
		$con->close();
	}
	else{//newhouse
		echo "newhouse!";
	}
?>






				</div>
			</div>
			<div id="righthomediv">
				<!-- <img src="img/M1.png"/> -->
			</div>
		</div>
	</div>

	<div class="footercontainer">
		<div class="footer">
			<div id="teamlogo">
				<img src="img/team.png">
			</div>
			</div>
		</div>
	</div>


</body>
</html>