<!DOCTYPE html>
<html>
<link rel="stylesheet" href="main.css">
<head>

	<title>
		My Fisrt website Homepage
	</title>
</head>

<body>
	
	<?php
	session_start();
	$user = 'root';
	$pass = '';
	$server = 'mydb';
	$db = new mysqli('localhost', $user, $pass, $server);
	if ($db->connect_error) {
	   die("Connection failed: " . $db->connect_error);
	} 
	#$query = mysqli_query($db, "SELECT * from User where Username='$Username'");
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		$Username = mysqli_escape_string($db, $_SESSION['user']);
    	echo "Welcome to the member's area, $Username!";
	} else {
   	 	header("location:error.php");
	}
	$user = $_SESSION['user'];
?>
	<br/><br/>
	<br/><br/>
	<br/><br/>
	<h1 align="center">Home Page</h1>
	<p align="center">Hello <?php print "$user"?></p>
		<header class="page-header">
		<div class="page-header__inner">
		<nav class="menu menu-closed">
			<!--<button class="menu-toggler" type="button">Open the menu</button>-->
			<a class="menu-logo"><img src="icons/menu.png"></a>

			<ul class="menu__list">
				<li class="menu__list-item">
					<a class="menu__link" href="logout.php">Logout</a>
				</li>
				<li class="menu__list-item">
					<a class="menu__link" href="buyer.php">Shop</a>
				</li>

				<li class="menu__list-item">
					<a class="menu__link" href="reviewer.php">Reviews</a>
				</li>	
				
				<li class="menu__list-item">
					<a class="menu__link" href="donator.php">Donator</a>
				</li>	
				
	<?php 
		$query = mysqli_query($db, "SELECT * from Charity_Organizator as c, User as u where u.ID=c.C_ID and '$Username'=u.Username");
		$exists = mysqli_num_rows($query);
		if ($exists>0){ ?>	
					<li  class="menu__list-item">
						<a class="menu__link" href="ch_org.php">Event Registration</a>
					</li>
		<?php }	?>
		</ul>
		</nav>
	</div>
	</header>	
	
</body>
</html>