<?php 
	ob_start();
	require "buyer.php";
	$money = mysqli_escape_string($connection, $_POST['money']);
	$user = mysqli_escape_string($connection, $_SESSION['userID']);
	mysqli_query($connection, "UPDATE Buyer SET Wallet = Wallet + $money where B_ID = $user");
	header("location:buyer.php");
 ?>