<?php  
	require"donator.php";
	$ID = mysqli_escape_string($connection, $_POST['ID']);
	$user = mysqli_escape_string($connection, $_SESSION['userID']);
	$result = mysqli_query($connection, "SELECT * from Charity_event  where Ch_ID = $ID and Charity_Organizator_C_ID = $user ");
	$exists = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	if ($exists>0){
		if ($_POST['Delete'])
		{
				mysqli_query($connection, "DELETE FROM Charity_event where Ch_ID = $ID and Charity_Organizator_C_ID = $user");
				header("Location: ch_org.php?message=Successfully deleted");
			
		}
		
		if ($_POST['Update'])
		{	
			if ($_POST['name']){$name = mysqli_escape_string($connection, $_POST['name']);} else {$name = mysqli_escape_string($connection, $row['Name']);}
			if ($_POST['goal']){$goal = mysqli_escape_string($connection, $_POST['goal']);} else {$goal = mysqli_escape_string($connection, $row['Goal']);}
			if ($_POST['purpose']){$purpose = mysqli_escape_string($connection, $_POST['purpose']);} else {$purpose = mysqli_escape_string($connection, $row['Purpose']);}

			mysqli_query($connection, "UPDATE Charity_event SET Name = '$name', Goal = $goal, Purpose = '$purpose' where Ch_ID = $ID and Charity_Organizator_C_ID = $user");

			header("Location: ch_org.php?message=Successfully Updated");
			}
		
	}
	else 
	{
		header("Location: ch_org.php?message=Such item was not found among charities you organized");
	}

?>