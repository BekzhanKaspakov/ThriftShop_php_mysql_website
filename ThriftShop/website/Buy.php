<?php 
	ob_start();
	require "buyer.php";
	
	$I_ID = mysqli_escape_string($connection, $_POST['ID']);
	$item = mysqli_query($connection, "SELECT * from Donated_item WHERE I_ID='$I_ID'");
	$exists = mysqli_num_rows($item);
	$ID = mysqli_escape_string($connection, $_SESSION['userID']);
	$user = mysqli_query($connection, "SELECT * from User left outer join Buyer on ID=B_ID WHERE ID = '$ID'");
	$row1 = mysqli_fetch_assoc($item);
	$row2 = mysqli_fetch_assoc($user);
	if ($exists>0) {
		if($row1['Price']<$row2['Wallet']){
			$num = mysqli_escape_string($connection, $row2['Wallet']-$row1['Price']);
			mysqli_query($connection, "UPDATE Buyer SET Wallet = $num WHERE B_ID = $ID");
			mysqli_query($connection, "UPDATE Donated_item SET Buyer_B_ID = $ID, Status = 'Sold' WHERE I_ID = '$I_ID'");
			header("location:buyer.php?message=Success");
		} 
		else
		{
			header("location:buyer.php?message=Insufficient funds");
		}
	} 
	else 
	{
		header("location:buyer.php?message=No such item in database. Check the correctness of the input ID");
	}
	header("location:buyer.php?message=SHIT");
?>