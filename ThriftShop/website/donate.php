<?php 
	require"donator.php";
	$name = mysqli_escape_string($connection, $_POST['name']);
	$price = mysqli_escape_string($connection, $_POST['price']);
	$size = mysqli_escape_string($connection, $_POST['size']);
	$user = mysqli_escape_string($connection, $_SESSION['userID']);
	mysqli_query($connection, "INSERT into Donated_item (Donator_D_ID, Name, Price, Size, Status, Date_of_admission) values ('$user', '$name', '$price', '$size', 'Unreviewed', now())");

	header ("location:donator.php");


?>