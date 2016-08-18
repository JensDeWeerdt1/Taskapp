<?php 

    include_once("../classes/User.class.php");

    if(!empty($_POST))
    {
        try
        {  
            $user = new User();
            $user->Firstname = $_POST['firstname'];
            $user->Lastname = $_POST['lastname'];
            $user->Username = $_POST['username'];
            $user->Email = $_POST['register_email'];
            $user->Password = $_POST['register_password'];
            $user->ConfirmPassword = $_POST['confirm_register_password'];
            $user->Admin = $_POST['useradmin'];
		    $user->register();
        }
        catch(exception $e)
        {
            $error = $e->getMessage();
        }
	}

?><!DOCTYPE html>
<html>
	<head>
		<title>IMDstagram</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/reset.css">
		<link rel="stylesheet" href="../css/style.css">
		<script type="text/javascript" src="../js/bootstrap.js"></script>
		<link rel="stylesheet" href="../css/bootstrap.css">
	</head>
	<body>
	<div class="screensize">
		<div class="register1">
			<form action="" method="post" id="registerform">
                <?php if(isset($error) && !empty($error)): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>
                <label id="login1" for="firstname">First name</label>
				<input type="text" name="firstname" class="textfield" placeholder="First name"><br>
                <label id="login1" for="lastname">Last name</label>
				<input type="text" name="lastname" class="textfield" placeholder="Last name"><br>
				<label id="login1" for="username">Username</label>
				<input type="text" name="username" class="textfield" placeholder="Username"><br>
				<label id="login1" for="register_email">E-mail</label>
				<input type="text" name="register_email" class="textfield" placeholder="E-mail"><br>
				<label id="login1" for="register_password">Password</label>
				<input type="password" name="register_password" class="textfield" placeholder="Password"><br>
                <label id="login1" for="confirm_register_password">Confirm password</label>
				<input type="password" name="confirm_register_password" class="textfield" placeholder="Confirm password"><br>
				<input type="hidden" value="0" name="useradmin">
				<button type="submit" class="btn btn-small btn-success">Register</button><br>
				
				<a href="index.php" class="return">Go back to log in page.</a>
			</form>
		</div>
		</div>
	</body>
</html>






















