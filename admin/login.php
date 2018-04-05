<?php
	include('../JhhamesPhp/database.php');
	include('../JhhamesPhp/sessions.php');
	$connect = connect_db('dashboard');

	 if(isset($_SESSION['admin_name']) && isset($_SESSION['admin_email']) )
	 {
	 	$_SESSION['successMessage'] = "You're already logged in";
	 	redirect_to('index.php');	
	 }

	if(post('login') != null)
	{
		$email = mysqli_real_escape_string($connect,post('email'));
		$password = mysqli_real_escape_string($connect,post('password'));

		$sql = "SELECT * FROM `admin` where email ='$email' && password = '$password' ";

		$log_check = fetch_custom($connect, $sql);

		if(mysqli_num_rows($log_check) > 0)
		{
			while($row = mysqli_fetch_array($log_check))
			{
				$_SESSION['id_admin'] = $row['id'];
				$_SESSION['admin_name'] = $row['name'];
				$_SESSION['admin_email'] = $row['email'];
				$_SESSION['logedin_admin'] = TRUE;

				redirect_to('index.php');
			}
		}
		else
		{
			$_SESSION['errorMessage'] = "Invalid Username Or Password";
		}
	}





?>	

<!DOCTYPE html>
<html>
<head>
	<title>
		Admin Login panel
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/mystyles.css">

</head>
<body style="background-color: #f9f9f9" >

<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4" style="background-color: white; margin-top:5%; box-shadow: 0px 0px 25px gray">
			<div class="row" style="">
				<div style="background-color: #637281;margin-top: 0; padding: 3%">
					<h2 style="color: white; font-weight:bold;text-align: center;"> Admin Login</h2>
				</div>
					<div class="row" style="padding-left: 5%; padding-right: 5%;"> 
						<div style="margin: auto">
							<?= error(); ?> 
						</div>
					</div>
					<form method="POST" style="padding: 10px ;">
						<div class="form-group">
							<label for="email"> Email </label><br>
							<input placeholder="Enter your email Address" required class="form-control" type="email" name="email" id="email">
						</div>

						<div class="form-group">
							<label for="password"> Password </label><br>
							<input placeholder="Enter Password" required class="form-control" type="password" name="password" id="password" >
						</div>
						<input type="submit" class="btn btn-primary btn-block" name="login" value="Sign in" />
					</form>
				</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>

</body>

</html>
