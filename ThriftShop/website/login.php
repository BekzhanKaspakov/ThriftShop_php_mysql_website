<!DOCTYPE html>
<html>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="main.css">
<head>
	<title>
		my first php website
	</title>
</head>
<body>
	<?php 
		session_start();
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			header("location:home.php");
		}
		if(!empty($_GET['message'])) 
			{
    			$message = $_GET['message'];
    			echo $message;
    		}
	 ?>
	<h2>Login Page</h2>
	<div class="login">
	  <div class="login_form">
	<form class="login-form" action="checklogin.php" method="POST">
		Enter Username: <input type="text" name="Username" required="required">
		Enter Password: <input type="Password" name="Password" required="required">
		<input type="submit" name="Login">
		<a href="register.php"> Click here to register</a>
	</form>
</div>
</div>
</body>
</html>