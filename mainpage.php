<!DOCTYPE html>  
<html lang="en">  
<head>
	<meta charset="UTF-8">
	<title>Time Management</title>

<?php
	session_start(); 
	if (!isset($_SESSION['phonenumber'])){
		header('Location: login.php');
	}

	if (isset($_POST['logout'])) {
		unset($_SESSION['phonenumber']);
		header('Location: login.php');
	}
?>
</head>

<body>



<div>
	<p>hello <?php echo $_SESSION['phonenumber']; ?></p>
	<form action="" method="POST">
	<input type="submit" name="logout" value="log out">
	</form>
</div>

</body>
</html>