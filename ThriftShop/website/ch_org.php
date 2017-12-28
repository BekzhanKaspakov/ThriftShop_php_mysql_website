<!DOCTYPE html>
<html>
<link rel="stylesheet" href="main.css">
<head>
	<title> Charity Organizator Page </title>
</head>
	<a href="home.php"> Home Page <br/><br/></a>

<body style=" text-align: center; "> 
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
		$Username = mysqli_escape_string($db, $_SESSION['user']);
		$query = mysqli_query($db, "SELECT * from Charity_Organizator as c, User as u where u.ID=c.C_ID and '$Username'=u.Username");
		$exists = mysqli_num_rows($query);
	if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) and ($exists>0)) {
			
	} else {
   	 	header("location:error.php");
	}
	$user = $_SESSION['user'];
?>
	<br/><br/>
	
		<header class="page-header">
		<div class="page-header__inner">
		<nav class="menu menu-closed">
			
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
	<h1 align="center"> Charity Organizator Page </h1>
	<p align="center">Hello <?php print "$user"?></p>
	<form style="float:left; width: 500px" id='donate' action='charity.php' method='post' align='center' accept-charset='UTF-8'>
	<fieldset align='right' >

		<legend> Add your charity event </legend>
		<br/>
		<label for='name' > Enter the name of your event: </label>
		<input type='text' name='name' maxlength="50" required/>
		<br/><br/>
		<label for='name' > Set your Goal: </label>
		<input type='number' name='goal' required/>
		<br/><br/>
		<label for='name' > Briefly describe the purpose: </label>
		<input style="width: 100%; height:200px;font-size:14pt;" type='text' name='purpose' required/>
		<br/><br/>
		
		<input type='submit' name='Submit' value='Submit' />

	</fieldset>
</form>
<form style="float:left; clear: right;width: 500px" id='donate' action='updateC.php' method='post' align='center' accept-charset='UTF-8'>
	<fieldset align='right' >

		<legend> Fix your information </legend>
		<br/>
		<label for='name' > Enter ID of the event you wish to fix: </label>
		<input type='number' name='ID' maxlength="50" required/>
		<br/><br/>
		<label for='name' > Name (leave blank if changes are not required): </label>
		<input type='text' name='name' />
		<br/><br/>
		<label for='name' > Goal(leave blank if changes are not required): </label>
		<input type='number' name='goal' />
		<br/><br/>
		<label for='name' > Purpose(leave blank if changes are not required): </label>
		<input style="width: 100%; height:200px;font-size:14pt;" type='text' name='purpose' />
		<br/><br/>
		<input type='submit' name='Update' value='Update' />
		<input type='submit' name='Delete' value='Delete' />

	</fieldset>
</form><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<h2 align="center">Charity Events that you organized</h2>
	<table border="1px" width="100%">
		<tr>
			<th>Name</th>
			<th>ID</th>
			<th>Goal</th>
			<th>Amount</th>
			<th>Purpose</th>
		</tr>
	
		<?php

			if(!empty($_GET['message'])) 
			{
    			$message = $_GET['message'];
    			echo $message;
    		}
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			} else {
   		 		header("location:error.php");
			}
			$connection = mysqli_connect('localhost', 'root', '','mydb');
			$Username = mysqli_escape_string($connection,$_SESSION['user']);
			$query = mysqli_query($connection, "SELECT * FROM User left outer join Charity_Organizator on ID=C_ID WHERE '$Username'=Username");
			$row1 = mysqli_fetch_assoc($query);
			$_SESSION['userID'] = $row1['C_ID'];
		?>

		<?php
             //The Blank string is the password
			$result2 = mysqli_query($connection, "SELECT * FROM Charity_event WHERE Charity_organizator_C_ID = '$row1[C_ID]' ");


			while($row2 = mysqli_fetch_assoc($result2)){   //Creates a loop to loop through results
				echo "<tr>";
				echo "<td>" . $row2['Name'] . "</td>";
				echo "<td>" . $row2['Ch_ID'] . "</td>";
				echo "<td>" . $row2['Goal'] . "</td>";
				echo "<td>" . $row2['Amount'] . "</td>";
				echo "<td>" . $row2['Purpose'] . "</td>";
				echo "</tr>";
			}

			echo "</table>"; //Close the table in HTML
		?>
	</table>
</body>
</html>