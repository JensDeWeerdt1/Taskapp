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
		<title>Taskapp</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/reset.css">
		<link rel="stylesheet" href="../css/style.css">
		<script type="text/javascript" src="../js/bootstrap.js"></script>
		<link rel="stylesheet" href="../css/bootstrap.css">
	</head>
	<body>

		<div class='screensize'> 
		    <div class="login"> 
			<form action="" method="post" id="loginform">
				<label id="login1"for="login_email">E-mail</label>
				<input type="text" name="login_email" class="textfield" placeholder="E-mail"><br>
				<label id="login1" for="login_password">Password</label>
				<input type="password" name="login_password" class="textfield" placeholder="Password"><br>
				<button type="submit" class="btn btn-small btn-success">Log in</button><br>
				<a class="register" href="register.php">Not an account yet? Register here!</a>
			</form>
	        </div>  
		</div>
	</body>
</html>