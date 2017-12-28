<?php 
	require "donator.php";
	$ID = mysqli_escape_string($connection, $_POST['ID']);
	$user = mysqli_escape_string($connection, $_SESSION['userID']);





 ?>