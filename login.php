<?php session_start(); 
	require "phpfunction.php";

	if (isset($_SESSION['phonenumber'])) {//如果已经登录了
		header('Location: mainpage.php');
	}
	else if (isset($_POST['submit'])&&($_POST['phonenumber']!="")) {//提交电话号码后
		
		//数据库操作（查询是否已有，已有登录，未有创建登录）
		$con = getconnection();
		 
		if(!sqlselectcheck($con,,"SELECT * FROM `user` WHERE `phoneNumber` = ".$_POST['phonenumber']){//不存在创建新用户
			echo "not exist";

			$stmt=$con->prepare("INSERT INTO user (phoneNumber,registerTime,registerIP)
									VALUES	('".$phoneNumber."','".date('Y-m-d H:i:s',time())."','".$_SERVER["REMOTE_ADDR"]."')");
			$stmt->close();
		}
		else{echo "already exist";}//用户已存在登录进此用户
		$con->close();

		$_SESSION['phonenumber'] = $_POST['phonenumber'];
		header('Location: mainpage.php');
	}
	else {
	}
	?>


<!DOCTYPE html>  
<html lang="en">  
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<link rel="stylesheet" href="stylesheets/mainstyle.css">
	<script src="js/jquery.js"></script>

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
		</div>
	</div>


	
	<div class="pagecontextcontainer">
		<div class="pagecontext">
			
			<h3>WORK <b>SMARTER</b>, LIVE <b>BETTER</b></h3>
			<p>A gamified time-management website that lets individuals divide their long-term goals into small tasks and helps users focus on current task with ease.</p>
			<img src="img/M1.png" class="loginpic"/><img src="img/M2.png" class="loginpic"/><img src="img/M3.png" class="loginpic"/>
			<h1>FEED YOUR<br/> MONSTER</h1>
			<div id="loginbox">

				<p>Please input your phone number here.</p>
				<form action="" method="POST">
				<input type="text" name="phonenumber" />
				<br />
				<input type="submit" name="submit">
				</form>

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