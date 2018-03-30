<?php
if(post('remove') !== null)
	 {
	 	$id = post('remove');

		$sql = "UPDATE `dashtable` SET status = 'not-slide' where id = $id;";
		$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

		if($query)
		{
			$_SESSION['successMessage'] = "Picture removed from slide successfully";
		}
		else
		{
			$_SESSION['errorMessage'] ="Error occured, TRY AGAIN!!!";
		}
	 }

?>