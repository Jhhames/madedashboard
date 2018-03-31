<?php
	$fetch_5 = fetch_order_limit_where('dashtable', $connect, 'DESC', 'status', 'slide');
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

<!-- <?php

	if(isset($_POST['submit']))//the index of the $_POST here should 
	{
		$email = $_POST['email']; //the index here is the name of your email input field
		$name =$_POST['name'];
		$comment = $_POST['comment'];

		$connect = mysqli_connect('hostname', 'db_username','db_password', 'db_name') or die('error connecting to database'); //the code wont work untill you enter the right parameters for the database connection

		//because of the die function, the code will run uo to this level only if database connection is succesful
		$sql = "INSERT into `the_name_of_the_table_storing_your_comments_in_db`(name_column,email_column,comment_column) VALUES($name','$email','$comment');";
		//if you have a table already in the database the above queury would insert the three variables into respective columns specified in the column bracket

		$query = mysqli_query($connect, $sql) or die(mysqli_error($connect)); // to execute the query, pass two paramters to this function, database connection and query 

			if($query) //if the execution is true
			{
				echo "Comment Added";
			}
			else
			{
				//no need to echo any error message, the die function takes care of that
			}	
	}
	else
	{

	}
?> -->