<?php 
	ob_start();
	require "buyer.php";
	$Ch_ID = mysqli_escape_string($connection, $_POST['ID']);
	$money = mysqli_escape_string($connection, $_POST['money']);
	$user = mysqli_escape_string($connection, $_SESSION['userID']);
	$result1 = mysqli_query($connection, "SELECT * from Buyer where B_ID = $user");
	$row1 = mysqli_fetch_assoc($result1);
	$wallet = mysqli_escape_string($connection, $row1['Wallet']);

	$result = mysqli_query($connection, "SELECT * from Charity_event where Ch_ID = $Ch_ID");
	$exists = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	if ($exists>0){
		if ($wallet>$money){
			mysqli_query($connection, "UPDATE Buyer SET Wallet = Wallet - $money where B_ID=$user");
			mysqli_query($connection, "UPDATE Charity_event SET Amount = Amount + $money where Ch_ID=$Ch_ID");

			$result1 = mysqli_query($connection, "SELECT * from Charity_event_has_Buyer where Buyer_B_ID=$user and Charity_event_Ch_ID=$Ch_ID");
			$exists1 = mysqli_num_rows($result1);
			if ($exists1>0){
				mysqli_query($connection, "UPDATE Charity_event_has_Buyer SET Donation_amount = Donation_amount + $money WHERE Buyer_B_ID=$user and Charity_event_Ch_ID=$Ch_ID");
			} else{
			mysqli_query($connection, "INSERT into Charity_event_has_Buyer (Buyer_B_ID, Charity_event_Ch_ID, Donation_amount) values ($user, $Ch_ID, $money)");
			}	
			header("Location:buyer.php?message=Success");
		}
		else
		{
			header("Location:buyer.php?message=Insufficient Funds");
		}
	}
	else
	{
		header("Location:buyer.php?message=No charity has this ID");
	}


 ?>