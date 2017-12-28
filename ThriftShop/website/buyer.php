<!DOCTYPE html>
<html>
<link rel="stylesheet" href="main.css">
<head>
	<title> Byuer Page </title>
</head>
	<a href="home.php"> Home Page <br/><br/></a>
<?php
	if(!empty($_GET['message'])) 
			{
    			$message = $_GET['message'];
    			echo $message;
    		} 
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
	<h1 align="center">Buyer Page</h1>
	<p align="center">Hello <?php print "$user" ?> </p>
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
	<?php
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	} else {
   	 	header("location:error.php");
	}
	
	$connection = mysqli_connect('localhost', 'root', '','mydb');
	?>
<body>
	<form style="width: 30%; float: left;" id='buy' action='fill.php' method='post' align='center' accept-charset='UTF-8'>
	<fieldset >

		<legend>Fill your Wallet here</legend>
		<br/>
		<label for='name' > $: </label>
		<input type='number' name='money' required/>
		<br/><br/>
		<input type='submit' name='Submit' value='Submit' />

	</fieldset>

</form>
	<form style="width: 30%; float: left" id='buy' action='Buy.php' method='post' align='center' accept-charset='UTF-8'>
	<fieldset >

		<legend>Want to buy something?</legend>
		<br/>
		<label for='name' > Enter the ID of desired item: </label>
		<input type='number' name='ID' required/>
		<br/><br/>
		<input type='submit' name='Submit' value='Submit' />

	</fieldset>
</form>
<br/><br/><br/><br/><br/><br/>
	<h2 align="center">Shopping Catalogue</h2>
	<table border="1px" width="100%">
		<tr>
			<th>Name</th>
			<th>ID</th>
			<th>Details</th>
			<th>Price</th>
			<th>Status</th>
		</tr>
	
		<?php
			$Username = mysqli_escape_string($connection,$_SESSION['user']);
			$query = mysqli_query($connection, "SELECT Wallet, B_ID FROM User left outer join Buyer on ID=B_ID WHERE '$Username'=Username");
			$row1 = mysqli_fetch_assoc($query);
			$_SESSION['userID'] = $row1['B_ID'];
		?>
	<h3 align="right"> 
		Wallet: 
		<?php
			echo $row1['Wallet']."$";

 		?>
	</h3>
		<?php
             //The Blank string is the password
			$result = mysqli_query($connection, "SELECT * FROM Donated_item WHERE Status='Reviewed'");

			while($row = mysqli_fetch_assoc($result)){   //Creates a loop to loop through results
				echo "<tr>";
				echo "<td>" . $row['Name'] . "</td>";
				echo "<td>" . $row['I_ID'] . "</td>";
				echo "<td>" . $row['Reviews'] . "</td>";
				echo "<td>" . $row['Price'] . "</td>";
				echo "<td>" . $row['Status'] . "</td>";
				echo "</tr>";
			}

			echo "</table>"; //Close the table in HTML
		?>
	</table>
	<h2 align="center">Your Shopping History</h2>
	<table border="1px" width="100%">
		<tr>
			<th>Name</th>
			<th>ID</th>
			<th>Details</th>
			<th>Price</th>
			<th>Status</th>
		</tr>
		<?php
			$result2 = mysqli_query($connection, "SELECT * FROM Donated_item WHERE Buyer_B_ID = '$row1[B_ID]'");


			while($row2 = mysqli_fetch_assoc($result2)){   //Creates a loop to loop through results
				echo "<tr>";
				echo "<td>" . $row2['Name'] . "</td>";
				echo "<td>" . $row2['I_ID'] . "</td>";
				echo "<td>" . $row2['Reviews'] . "</td>";
				echo "<td>" . $row2['Price'] . "</td>";
				echo "<td>" . $row2['Status'] . "</td>";
				echo "</tr>";
			}

			echo "</table>"; //Close the table in HTML
		?>
	</table>
	<br/><br/>
	<form id='buy' action='moneyD.php' method='post' align='center' accept-charset='UTF-8'>
	<fieldset >

		<legend> Donate money on charity events</legend>
		<br/>
		<label for='name' > Enter the ID of the charity: </label>
		<input type='number' name='ID' required/>
		<br/><br/>
		<label for='name' > How much do you wish to donate: </label>
		<input type='number' name='money' required/>
		<br/><br/>
		<input type='submit' name='Submit' value='Submit' />

	</fieldset>
	<h2 align="center">Charity Events</h2>
	<table border="1px" width="100%">
		<tr>
			<th>Name</th>
			<th>ID</th>
			<th>Purpose</th>
			<th>Goal</th>
			<th>Amount</th>
		</tr>
		<?php
			$result2 = mysqli_query($connection, "SELECT * FROM Charity_event");


			while($row3 = mysqli_fetch_assoc($result2)){   //Creates a loop to loop through results
				echo "<tr>";
				echo "<td>" . $row3['Name'] . "</td>";
				echo "<td>" . $row3['Ch_ID'] . "</td>";
				echo "<td>" . $row3['Purpose'] . "</td>";
				echo "<td>" . $row3['Goal'] . "</td>";
				echo "<td>" . $row3['Amount'] . "</td>";
				echo "</tr>";
			}

			echo "</table>"; //Close the table in HTML
		?>
	</table>
	<h2 align="center"> History of Your Donations to the Charities:</h2>
	<table border="1px" width="100%">
		<tr>
			<th>Name</th>
			<th>Charity ID</th>
			<th>Amount</th>
		</tr>
		<?php
			$result3 = mysqli_query($connection, "SELECT * FROM Charity_event_has_Buyer left outer join Charity_event on Ch_ID = Charity_event_Ch_ID WHERE Buyer_B_ID='$row1[B_ID]'");


			while($row4 = mysqli_fetch_assoc($result3)){   //Creates a loop to loop through results
				echo "<tr>";
				echo "<td>" . $row4['Name'] . "</td>";
				echo "<td>" . $row4['Charity_event_Ch_ID'] . "</td>";
				echo "<td>" . $row4['Donation_amount'] . "</td>";
				echo "</tr>";
			}

			echo "</table>"; //Close the table in HTML
		?>
	</table>
</form>
</body>
</html>