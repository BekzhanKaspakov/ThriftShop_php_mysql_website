<!DOCTYPE html>
<html>
<link rel="stylesheet" href="main.css">
<head>
	<title> Donator Page </title>
</head>
	<a href="home.php"> Home Page <br/><br/></a>
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
	<h1 align="center">Donator Page</h1>
	<p align="center">Hello <?php print "$user"?></p>
		<header class="page-header">
		<div class="page-header__inner">
		<nav class="menu menu-closed">
			<button class="menu-toggler" type="button">Open the menu</button>
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
<body style=" text-align: center; ">
	<div align="center">
	<form style="float:left; width: 500px" id='donate' action='donate.php' method='post' align='center' accept-charset='UTF-8'>
	<fieldset align='right' >

		<legend>Want to donate an item?</legend>
		<br/>
		<label for='name' > Name: </label>
		<input type='text' name='name' maxlength="20" required/>
		<br/><br/>
		<label for='name' > Price: </label>
		<input type='number' name='price' required/>
		<br/><br/>
		<label for='name' > Size: </label>
		<input type='number' name='size' required/>
		<br/><br/>
		
		<input type='submit' name='Submit' value='Submit' />

	</fieldset>
</form>
</div>
<form style="float:left; width: 500px" id='donate' action='updateD.php' method='post' align='center' accept-charset='UTF-8'>
	<fieldset align='right' >

		<legend>Want to fix some info of your Item?</legend>
		<br/>
		<label for='name' > Enter ID of the item you wish to change: </label>
		<input type='number' name='ID' maxlength="20" required/>
		<br/><br/>
		<label for='name' > Name (leave blank if changes are not required): </label>
		<input type='text' name='name' />
		<br/><br/>
		<label for='name' > Price(leave blank if changes are not required): </label>
		<input type='number' name='price' />
		<br/><br/>
		<label for='name' > Size(leave blank if changes are not required): </label>
		<input type='number' name='size' />
		<br/><br/>
		<input type='submit' name='Update' value='Update' />
		<input type='submit' name='Delete' value='Delete' />

	</fieldset>
</form>

	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<h2 align="center">Your Donations History</h2>
	<table border="1px" width="100%">
		<tr>
			<th>Name</th>
			<th>ID</th>
			<th>Price</th>
			<th>Status</th>
			<th>Date of admission</th>
			<th>Review</th>
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
			$query = mysqli_query($connection, "SELECT * FROM User left outer join Donator on ID=D_ID WHERE '$Username'=Username");
			$row1 = mysqli_fetch_assoc($query);
			$_SESSION['userID'] = $row1['D_ID'];
		?>

		<?php
             //The Blank string is the password
			$result2 = mysqli_query($connection, "SELECT * FROM Donated_item WHERE Donator_D_ID = '$row1[D_ID]' ");


			while($row2 = mysqli_fetch_assoc($result2)){   //Creates a loop to loop through results
				echo "<tr>";
				echo "<td>" . $row2['Name'] . "</td>";
				echo "<td>" . $row2['I_ID'] . "</td>";
				echo "<td>" . $row2['Price'] . "</td>";
				echo "<td>" . $row2['Status'] . "</td>";
				echo "<td>" . $row2['Date_of_admission'] . "</td>";
				echo "<td>" . $row2['Reviews'] . "</td>";
				echo "</tr>";
			}

			echo "</table>"; //Close the table in HTML
		?>
	</table>
</body>
</html>