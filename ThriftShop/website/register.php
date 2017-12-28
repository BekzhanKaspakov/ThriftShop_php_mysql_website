<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="main.css">
<head>
	<!--<style> 
	fieldset { 
		border:1px solid green; 
		width: 300px;
	}

	legend {
		padding: 0.2em 0.5em;
		border:1px solid green;
		color:green;
		font-size:90%;
		text-align:left;
	}
</style>-->
<title>
	my first php website
</title>
</head>
<body>
	<h2>Registration Page</h2>
	
	<div class="login">
	<div class="login_form">
	<form class="login-form" id='register' action='register.php' method='post' align='center'

	accept-charset='UTF-8'>
		<input type='hidden' name='submitted' id='submitted' value='1'/>
		First Name*:
		<input type='text' name='fname' id='fname' maxlength="50" required/>
		Last Name*:
		<input type='text' name='lname' id='lname' maxlength="50" required/>
		Email Address*:
		<input type='email' name='email' id='email' maxlength="50" required/>
		Username*: 
		<input type='text' name='username' id='username' maxlength="50" required/>
		Password*:
		<input type='password' name='password' id='password' maxlength="50" required/>
		Do you wish to register also as charity organizator:
		<input align="center" type="checkbox" name="test" value="value1">
		<br/>
		<input type='submit' name='Submit' value='Submit' />
		<a href="login.php"> Already registered? Click here to login</a>
</form>
</div>
</div>
</body>
</html>

<?php
$user = 'root';
$pass = '';
$server = 'mydb';
$bool = true;
$db = new mysqli('localhost', $user, $pass, $server);
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = mysqli_escape_string($db, $_POST['username']);
	$password = mysqli_escape_string($db ,$_POST['password']);
	$email = mysqli_escape_string($db, $_POST['email']);
	$fname = mysqli_escape_string($db ,$_POST['fname']);
	$lname = mysqli_escape_string($db, $_POST['lname']);

	echo "username entered is: ". $username ."<br/>";
	echo "password entered is: ". $password ."<br/>";
} else {
	$username = null;
	$password = null;
}	

#mysqli_select_db($db, "mydb") or die(mysqli_error());
if ($username == null) {die("");}
$query = mysqli_query($db,"SELECT *  from User");
while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
{	
	$table_user = $row['Username'];
	if($username == $table_user)
	{
		$bool = false;
		print '<script>alert("username is taken! or invalid");</script>';
		print '<script>window.location.assign("register.php");</script>';
	}
}

if($bool)
{
	mysqli_query($db,"INSERT into User (username, password, fname, lname, email) values ('$username', '$password', '$fname', '$lname', '$email')");
	$temp = mysqli_query($db, "SELECT * from User WHERE Username = '$username'");
	$temp1 = mysqli_fetch_array($temp);
	$temp2 = mysqli_escape_string($db, $temp1['ID']);
	mysqli_query($db, "INSERT INTO Buyer (B_ID, Wallet) values ($temp2, 0)");
	mysqli_query($db, "INSERT INTO Donator (D_ID) values ($temp2)");
	mysqli_query($db, "INSERT INTO Reviewer (R_ID) values ($temp2)");
	if ($_POST['test'] == 'value1'){
		mysqli_query($db, "INSERT INTO Charity_Organizator (C_ID) values ($temp2)");
	}
	print '<script>alert("Successfully registered!");</script>';
	header("Location: login.php?message=Successfully Registered");
}


?>