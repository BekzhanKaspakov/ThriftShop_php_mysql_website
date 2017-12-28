<?php 
	require"donator.php";
	$ID = mysqli_escape_string($connection, $_POST['ID']);
	$user = mysqli_escape_string($connection, $_SESSION['userID']);
	$result = mysqli_query($connection, "SELECT * from Donated_item D where I_ID = $ID and Donator_D_ID = $user ");
	$exists = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	if ($exists>0){
		if ($_POST['Delete'])
		{
			if ($row['Status'] != 'Sold'){
				mysqli_query($connection, "DELETE FROM Donated_item where I_ID = $ID and Donator_D_ID = $user");
				header("Location: donator.php?message=Successfully deleted");
			} 
			else
			{
				header("Location: donator.php?message=Your item was already sold");
			}
			
		}
		
		if ($_POST['Update'] and $row['Status']!='Sold')
		{	
			if ($_POST['name']){$name = mysqli_escape_string($connection, $_POST['name']);} else {$name = mysqli_escape_string($connection, $row['Name']);}
			if ($_POST['price']){$price = mysqli_escape_string($connection, $_POST['price']);} else {$price = mysqli_escape_string($connection, $row['Price']);}
			if ($_POST['size']){$size = mysqli_escape_string($connection, $_POST['size']);} else {$size = mysqli_escape_string($connection, $row['Size']);}

			mysqli_query($connection, "UPDATE Donated_item SET Name = '$name', Price = $price, Size = $size where I_ID = $ID and Donator_D_ID = $user");

			header("Location: donator.php?message=Successfully Updated");
		} else {
			header("Location: donator.php?message= Info of sold items cannot be changed");
		}
	}
	else 
	{
		header("Location: donator.php?message=Such item was not found among your donations");
	}

 ?>