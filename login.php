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
			<!-- <a id="header-logo"href=""><img src="img/path_logo.png" alt="bike logo"></a>
			<div class="filler"></div>
			<a id="burger-button" href="javascript:void(0);" onclick="toggleNavi();"><img src="img/burger2.png" alt=""></a>
			<ul id="header-nav">
				<li><a a href="javascript:void(0);" onclick="showthetool()">GET STARTED</a></li>
				<li><a href="javascript:void(0);" onclick="scrollTo('map-anchor');hideAll();">THE TOOL</a></li>
				<li><a href="javascript:void(0);" onclick="scrollTo('team-anchor');hideAll();">ABOUT US</a></li>
			</ul> -->
		</div>
	</div>


	<?php session_start(); 
	if (isset($_SESSION['phonenumber'])) {//如果已经登录了
		//header('Location: mainpage.php');
		?>
		<script type="text/javascript">
		$(document).ready(function(){$("#loginbox").hide();});
		$(document).ready(function(){$("#alreadylogined").show();});
		</script>
	<?php
	}
	else if (isset($_POST['submit'])) {//提交电话号码后
		
		//数据库操作（查询是否已有，已有登录，未有创建登录）
		$con = new mysqli("localhost","s1425535","InQzRF8RSn","s1425535");
		if ($con->connect_errno) {
		   printf("Connect failed: %s\n", $con->connect_error);
		   exit();
		}

		$sqlsearch=$con->prepare("SELECT * FROM `user` WHERE `phoneNumber` = ?");
		$sqlsearch->bind_param("s",$phoneNumber);
		$phoneNumber=$_POST['phonenumber'];
		$sqlsearch->execute();
		$sqlsearch->close();
		 
		if(!$sqlsearch->fetch()){//不存在创建新用户
			echo "not exist";

			$sqladd=$con->prepare("INSERT INTO user (phoneNumber,registerTime,registerIP)
									VALUES	(?,?,?)");
			$sqladd->bind_param("sss",$phoneNumber,$registerTime,$registerIP);

			$registerTime=date('Y-m-d H:i:s',time());
			$registerIP=$_SERVER["REMOTE_ADDR"];
			$sqladd->execute();
			$sqladd->close();
		}
		else{echo "already exist";}//用户已存在
		$con->close();

		$_SESSION['phonenumber'] = $_POST['phonenumber'];
		header('Location: mainpage.php');
	}
	else {
	?>

	<script type="text/javascript">
		$(document).ready(function(){$("#loginbox").show();});
		$(document).ready(function(){$("#alreadylogined").hide();});
	</script>

	<?php
	}
		if (isset($_POST['logout'])) {
		unset($_SESSION['phonenumber']);
		header('Location: login.php');
	}
	?>

	<div class="pagecontextcontainer">
		<div class="pagecontext">
			<br/><br/>
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


			<div id="alreadylogined">
				<p>hello <?php echo $_SESSION['phonenumber']; ?></p>
				<form action="" method="POST">
				<input type="submit" name="logout" value="log out">
				</form>
			</div>
		</div>
	</div>


</body>
</html>