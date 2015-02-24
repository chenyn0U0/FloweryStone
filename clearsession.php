<?php
	session_start();
	unset($_SESSION['phonenumber']);
	header('Location: login.php');
?>