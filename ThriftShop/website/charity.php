<?php 
	require"donator.php";
	$name = mysqli_escape_string($connection, $_POST['name']);
	$goal = mysqli_escape_string($connection, $_POST['goal']);
	$purpose = mysqli_escape_string($connection, $_POST['purpose']);
	$user = mysqli_escape_string($connection, $_SESSION['userID']);
	mysqli_query($connection, "INSERT into Charity_event (Charity_Organizator_C_ID, Name, Goal, Purpose, Amount) values ('$user', '$name', '$goal', '$purpose', 0)");

	header ("location:ch_org.php");


?>