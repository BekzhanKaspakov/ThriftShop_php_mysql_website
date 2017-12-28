<!DOCTYPE html>
<html>
<link rel="stylesheet" href="main.css">
<head>
	<title> Reviewer Page </title>
</head>
	<a href="home.php"> Home Page <br/><br/></a>

<body style=" text-align: center; ">
	
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
	<h1 align="center">Reviewer Page</h1>
	<p align="center">Hello <?php print "$user"?></p>
	<h2 align="center">Items waiting for a reviews</h2>
	<table align="center" border="1px" width="50%">
		<tr>
			<th style="width:200px">Name</th>
			<th style="width:50px" align="center">ID</th>
			<th style="width:50px" align="center">Price</th>
			<th style="width:50px" align="center">Status</th>
		</tr>
	
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
			$Username = mysqli_escape_string($connection,$_SESSION['user']);
			$query = mysqli_query($connection, "SELECT * FROM User left outer join Reviewer on ID = R_ID WHERE '$Username'=Username");
			$row1 = mysqli_fetch_assoc($query);
			$_SESSION['userID'] = $row1['ID'];
			$R_ID = mysqli_escape_string($connection, $row1['R_ID']);

             //The Blank string is the password
			$result = mysqli_query($connection, "SELECT * FROM Donated_item WHERE Status='Unreviewed'");

			while($row = mysqli_fetch_assoc($result)){   //Creates a loop to loop through results
				echo "<tr>";
				echo "<td>" . $row['Name'] . "</td>";
				echo "<td>" . $row['I_ID'] . "</td>";
				echo "<td>" . $row['Price'] . "</td>";
				echo "<td>" . $row['Status'] . "</td>";
				echo "</tr>";
			}

			echo "</table>"; //Close the table in HTML
		?>
	</table>
	<h2 align="center">Your Reviewes History</h2>
	<table align="center" border="1px" width="50%">
		<tr>
			<th style="width:100px;">Name</th>
			<th>ID</th>
			<th>Details</th>
			<th>Price</th>
			<th>Status</th>
		</tr>
	
		<?php
			$result2 = mysqli_query($connection, "SELECT * FROM Donated_item WHERE Reviewer_R_ID = '$R_ID'");


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
	<div align="center">
	<form style="width: 50%;" id='buy' action='review.php' method='post' align='center' accept-charset='UTF-8'>
	<fieldset >

		<legend>Write, Update or Delete review?</legend>
		<br/>
		<label for='name' > Enter the ID of desired item: </label>
		<input type='number' name='ID' required/>
		<br/><br/>
		<label for='name' > Write a review: </label>
		<input style="width: 100%;height:100px;font-size:14pt;" type='text' name='review'/>
		<br/><br/>
		<input type='submit' name='Submit' value='Submit' />
		<input type='submit' name='Update' value='Update' />
		<input type='submit' name='Delete' value='Delete' />
	</fieldset>
</form>
</div>
	
</body>
</html>