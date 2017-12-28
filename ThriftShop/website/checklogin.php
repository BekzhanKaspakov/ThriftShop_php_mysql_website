<!DOCTYPE html>
<html>
<?php
	session_start();
	$user = 'root';
	$pass = '';
	$server = 'mydb';
	$db = new mysqli('localhost', $user, $pass, $server);
	if ($db->connect_error) {
	   die("Connection failed: " . $db->connect_error);
	} 

	$Username = mysqli_escape_string($db, $_POST['Username']);
	$Password = mysqli_escape_string($db ,$_POST['Password']);
	$query = mysqli_query($db, "SELECT * from User where Username='$Username'");
	$exists = mysqli_num_rows($query);
	$table_users = "";
	$table_passwords = "";
	if ($exists>0) 
	{
		while($row = mysqli_fetch_assoc($query)){
			$table_users = $row['Username'];
			$table_passwords = $row['Password'];
		}
		if (($Username == $table_users) && ($Password == $table_passwords))
		{
			if ($Password = $table_passwords)
			{
				$_SESSION['loggedin'] = true;
				$_SESSION['user'] = $Username;
				header("location: home.php");
			}
		}
		else
		{
			print '<script>alert("Incorrect Password");</script>';
			print '<script>window.location.assign("login.php </script>';
		}
	}
	else
	{
		print '<script>alert("Incorrect Username!");</script>';
		print '<script>window.location.assign("login.php </script>';
	}
?>
<h1>There is no such combination of username and password in our database.</h1>
<h3> Please Try again by clicking 
<a href="login.php">here</a>
</h3>
</html>




