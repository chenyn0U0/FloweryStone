<?php session_start(); 
	require "phpfunction.php";

	if (isset($_SESSION['username'])) {//如果已经登录了
		header('Location: mainpage.php');
	}
	else if (isset($_POST['submit'])&&($_POST['username']!="")&&($_POST['password']!="")) {//提交电话号码后
		
		//数据库操作（查询是否已有，已有登录，未有创建登录）
		$con = getconnection();
		 
		if(!sqlselectcheck($con,"SELECT * FROM `user` WHERE `username` = '".$_POST['username']."' and `password` = '".$_POST['password']."'")){//不存在创建新用户
			// echo "not exist";

			// $stmt=$con->prepare("INSERT INTO user (username,password,registerTime,registerIP)
			// 						VALUES	('".$_POST["username"]."','".$_POST["password"]."','".date('Y-m-d H:i:s',time())."','".$_SERVER["REMOTE_ADDR"]."')");
			// $stmt->close();
		}
		else{
			$_SESSION['username'] = $_POST['username'];
		}//用户已存在登录进此用户
		$con->close();

		if($_SESSION['username'] == $_POST['username']) header('Location: mainpage.php');
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
	<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
		$(document).ready(function(){
			<?php
			if(!isset($_POST['username'])) echo"$('#logininputbox').hide(0).fadeOut(0);";
			?>
			
			$("#startlogin").click(function(){
				$("#logininputbox").show(0);
				$("#logininputbox").fadeIn("slow");
			});
			$("#clickcloseblack").click(function(){				
				$("#logininputbox").fadeOut("slow");
				$("#logininputbox").hide(0);
			});
		});
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
		</div>
	</div>


	
	<div class="pagecontextcontainer">
		<div class="pagecontext">
			<div id="loginpagecontent" style="position:relative;top:-80px">
				<div class="monstertitle"><img src="img/loginmooonster.png" width="330px"/></div>

				<div class="iconcontainer">
					<div class="icon">
						<img src="datavisualisation/redmon.png" class="picstyle"/>
						<div class="textbox">
							<p class="text">Adopt a monster, which is a project you create. Find big projects are difficult to focus on? They are supposed to be broken down into small actionable tasks.</p>
						</div>
					</div>
				

					<div class="icon">
						<img src="datavisualisation/greenmon.png" class="picstyle"/>
			    		<div class="textbox">
			    			<p class="text">Each little monster corresponds a small task.  Don't get your little monsters starved. They need you to work hard and get pizzas.</p>
			    		</div>
			    	</div>

			    	<div class="icon">
						<img src="datavisualisation/yellowpie.png" class="picstyle"/>
			    		<div class="textbox">
			    			<p class="text">Every pizza represents interval 30 minutes in lengths. Once you have finished a 30-minutes work, you can have a short break.</p>
			    		</div>
			    	</div>

			    	<div class="icon">
						<img src="datavisualisation/bluebadge.png" class="picstyle"/ >
			    		<div class="textbox">
			    			<p class="text">You will earn a badge once you have reached a specific accomplishment.</p>
			    		</div>
			    	</div>
				</div>
				
			    <div class="destxt">
			 		<h2>We mimic the process of working as adopting monsters and feeding them with pizzas. Don't let your monsters starved.
			 		</br>
			 		We make focusing easier. We make you a step closer to your dream.
			 		</h2>

			 		<a id="startlogin" style="font-size:30px;color:#666666;cursor:pointer">ADOPT A MONSTER NOW!</a>
			 		 
			    </div>
			</div>
		</div>
	</div>

	<div id="logininputbox">
		<div id="clickcloseblack"></div>
		<div class="containerout" >
			<img src="img/monsfa.png" class="moxingfamily"/>

			<div class="containerin">
				<div align="center" style="margin-top:35px">
					<img src="img/loginmooonster.png" width="250" height="90" alt=""/> 
				</div>
				<div class="loginboxtext">
					<form action="" method="POST">
						<p class="logintitle">Username</p>
						<input class="logintxt" type="text" name="username"/>
						</br>
						<p class="logintitle">Password</p>
						<input class="logintxt" type="password" name="password"/>
						<?php
						if(isset($_POST['username'])) echo"<p style='color:red;font-size:12px'>Your username or password is not correct.</p>";
						?>
						<input class="loginbutton" type="submit" value="Login" name="submit"/>
					</form>
				</div>
		
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