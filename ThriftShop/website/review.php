<?php 
	require "reviewer.php";
	$ID = mysqli_escape_string($connection, $_POST['ID']);
	if ($_POST["Delete"]){
		if($_POST["Delete"]) 
			{
				mysqli_query($connection, "UPDATE Donated_item SET Reviews = '', Reviewer_R_ID = NULL, Status = 'Unreviewed' WHERE I_ID = $ID");
				header("Location: reviewer.php?message=Successfully Deleted");
			}
	} else {
		$Review = mysqli_escape_string($connection, $_POST['review']);
		$user = mysqli_escape_string($connection, $_SESSION['userID']);
		if ($_POST["Submit"]){
			$result = mysqli_query($connection, "SELECT * from Donated_item where I_ID = $ID and Status = 'Unreviewed' ");
			$exists = mysqli_num_rows($result);
			$row = mysqli_fetch_assoc($result);
			if ($exists>0)
			{
				mysqli_query($connection, "UPDATE Donated_item SET Reviews = '$Review', Reviewer_R_ID = $user, Status = 'Reviewed' WHERE I_ID = $ID");
				header("Location: reviewer.php?message=Successfully Updated"); 
		
		
			} 
			else 
			{
				header("Location: reviewer.php?message=Something is wrong"); 
			}
		}	
		else 
		{
			$result = mysqli_query($connection, "SELECT * from Donated_item where I_ID = $ID and Status = 'Reviewed' ");
			$exists = mysqli_num_rows($result);
			$row = mysqli_fetch_assoc($result);
			if ($exists>0)
			{
				mysqli_query($connection, "UPDATE Donated_item SET Reviews = '$Review', Reviewer_R_ID = $user, Status = 'Reviewed' WHERE I_ID = $ID");
				header("Location: reviewer.php?message=Successfully Updated");
		
			} 
			else 
			{
				header("Location: reviewer.php?message=Something is wrong"); 
			}
	}
}


 ?>