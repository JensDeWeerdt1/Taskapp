<?php
session_start();
include_once("../classes/User.class.php");
	

if(!empty($_SESSION['user']))
{
    header("Location: home.php");
}

if (!empty($_POST)) {
	$login = new User();

	$username = strip_tags($_POST['login_email']);
	$password = strip_tags($_POST['login_password']);

	$username = stripslashes($username);
	$password = stripslashes($password);



	if($login->CanLogin($username,$password)){
		header('Location: tasks.php');
	}else{
		echo "Error";
	}

}
?><!DOCTYPE html>
<html>
	<head>
		<title>IMDstagram</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/reset.css">
		<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>

		<div>    
			<form action="" method="post" id="loginform">
				<label id="login1"for="login_email">E-mail</label><br>
				<input type="text" name="login_email" class="textfield" placeholder="E-mail"><br>
				<label id="login1" for="login_password">Password</label><br>
				<input type="password" name="login_password" class="textfield" placeholder="Password">
				<button type="submit" class="submitbtn">Log in</button><br>
				<a class="register" href="register.php">Not an account yet? Register here!</a>
			</form>
	
		</div>
	</body>
</html>