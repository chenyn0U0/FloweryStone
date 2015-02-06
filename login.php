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
	$phoneNumber=$_POST['phonenumber'];

	//数据库操作（查询是否已有，已有登录，未有创建登录）
	$con = mysql_connect("localhost","s1425535","InQzRF8RSnIf");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("s1425535", $con);

	$sqlsearch="SELECT * FROM `user` WHERE `phoneNumber` = $phoneNumber";


	$result=mysql_query($sqlsearch);
	$row = mysql_fetch_array($result);
	 
	if($row==""){//不存在创建新用户
		echo "not exist";
		$registerTime=date('Y-m-d H:i:s',time());
		$registerIP=$_SERVER["REMOTE_ADDR"];

		$sqladd="INSERT INTO user (phoneNumber,registerTime,registerIP)
		VALUES
		('$phoneNumber','$registerTime','$registerIP')";
		if (!mysql_query($sqladd,$con))
		  {
		  die('Error: ' . mysql_error());
		  }
		echo "<hr/>1 record added";		
	}
	else{echo "already exist";}//用户已存在
	mysql_close($con);

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