<!DOCTYPE html>  
<html lang="en">  
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>


<?php session_start(); 


if (isset($_SESSION['phonenumber'])) {//如果已经登录了
	header('Location: mainpage.php');
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

	<p>Please input your phone number here.</p>
	<form action="" method="POST">
	<input type="text" name="phonenumber" />
	<br />
	<input type="submit" name="submit">
	</form>

<?php
	exit;
}
?>

</body>
</html>