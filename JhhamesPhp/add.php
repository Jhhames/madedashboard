<?php
	
	$email =$_SESSION['email'];
	$sql_5 = "SELECT * FROM `dashtable` WHERE (owner = '$email' AND status = 'slide') ORDER BY id DESC";
	$fetch_5 = fetch_custom($connect, $sql_5);

	$number_of_slides = mysqli_num_rows($fetch_5);

if(post('add') !== null)
	 {
	 	$id = post('add');

			if ($number_of_slides < 5)
			{
				$sql = "UPDATE `dashtable` SET status = 'slide' where id = $id;";
				$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

				if($query)
				{
					$_SESSION['successMessage'] = "Picture added to slide successfully";
				}
				else
				{
					$_SESSION['errorMessage'] ="Error occured, TRY AGAIN!!!";
				}
			}
			else
			{
				$_SESSION['errorMessage'] = "Slideshow is full already, You cant add more than 5 pictures to slideshow";
			}	
	 }


?>