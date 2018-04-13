<?php
	include('../JhhamesPhp/database.php');
	include('../JhhamesPhp/sessions.php');
	 $connect = connect_db('dashboard');

	 function exists_email($email, $tablename)
	 {
		$connect = connect_db('dashboard');
		$sql = "SELECT * FROM $tablename where email = '$email' ";
		$query = mysqli_query($connect, $sql) or die(mysqli_query($connect));

		if (mysqli_num_rows($query)> 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	 }


	 if(!isset($_SESSION['admin_name']) && !isset($_SESSION['admin_email']) )
	 {
	 	$_SESSION['errorMessage'] = "Login is required to access the page";
	 	redirect_to('login.php');	
	 }

	 if(post('add_admin') != NULL)
	 {
	 	$name = mysqli_real_escape_string($connect,post('name'));
	 	$email = mysqli_real_escape_string($connect, post('email'));
	 	$password = mysqli_real_escape_string($connect, post('password'));

	 	if(exists_email($email, 'admin'))
	 	{
	 		$_SESSION['errorMessage'] = "Admin email already Exist";
	 	}
	 	else
	 	{

		 	$admin_details = array(
		 		'name' => $name,
		 		'email' => $email,
		 		'password' => $password
		 	);

		 		$add_admin = insert($admin_details, $connect, 'admin');

		 		if($add_admin)
		 		{
		 			$_SESSION['successMessage'] = "Admin Added";
		 		}
	 	}
	 }

	 if(post('delete') !== null)
	 {
	 	$id = post('delete');

		$sql = "DELETE FROM `admin` where id = '$id' ;";
		$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

		if($query)
		{
			$_SESSION['successMessage'] = "Admin Deleted";
		}
		else
		{
			$_SESSION['errorMessage'] ="Error occured, TRY AGAIN!!!";
		}
	 }

	 // if(post('active') !== null)
	 // {
	 // 	$id = post('active');

		// $sql = "UPDATE `Subscribers` SET subscription = 'active' where id = $id;";
		// $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

		// if($query)
		// {
		// 	$_SESSION['successMessage'] = "Subscriber Activated";
		// }
		// else
		// {
		// 	$_SESSION['errorMessage'] ="Error occured, TRY AGAIN!!!";
		// }
	 // }


	 if(isset($_SESSION['admin_name'])  && isset($_SESSION['admin_email']) )
	 {
	 	$sql = "SELECT * from `admin`";

	 	$select_admin = fetch_custom($connect, $sql);
	 }
?>

<!DOCTYPE html>
<html>
<head>
	<title>
Admin Dashboard
	</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="j../s/bootstrap.min.js"></script>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/mystyles.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<h4> User Dashboard</h4> <p>
					<ul  class="nav nav-pills nav-stacked" id="side_Menu">
						<li><a href="index.php"><span class="glyphicon glyphicon-th"> </span> Dashboard </a> </li>
						<li><a href="subscribers.php"><span class="glyphicon glyphicon-user"> </span> Subscribers </a> </li>
						<li class="active"><a href="admin.php"><span class="glyphicon glyphicon-user"> </span> Admins </a> </li>
						<li><a href="edit.php"><span class="glyphicon glyphicon-book"> </span> Edit text </a> </li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout </a> </li>
					</ul>
			</div>
			<div class="col-md-10" style="padding-top: 1px;">
				<div class="row">
						<h1 id="headtext">Admin List</h1>
						<?= error(); ?>
						<?= success(); ?>

				</div>
				<div class="table-responsive" style="margin-top: 3%">
				<table class="table table-striped table-hover table-responsive" style="width: 100%; margin: auto;">
					<thead class="thead-dark">
					<tr>
						
						<th>
							Name 
						</th>
						<th>
							Email address 
						</th>
						<th>
							Action
						</th>
					</tr>
					</thead> 
					<tbody>
					<?php  

						if(isset($select_admin) && $select_admin != NULL )
						{
							while ($row = mysqli_fetch_array($select_admin))
							{
					
								if($row['email'] == $_SESSION['admin_email'])
								{

					?>				
					<tr>
						<td>
							<?= $row['name'] ?>
						</td>
						<td>
							<?= $row['email'] ?>
						</td>
						<td>
							<b> You </b>
						</td>
					</tr>
					<?php
								}
								else
								{
					?>

					<tr>
						<td>
							<?= $row['name'] ?>
						</td>
						<td>
							<?= $row['email'] ?>
						</td>
						<td>
							<form method="POST">
								<button class="btn btn-danger" value="<?= $row['id'] ?>" type="submit" name="delete" > Delete</button>
							</form>
						</td>
					</tr>


					<?php
								}
							}
						}
					?>
					</tbody>
					
				</table>
				</div>
				<hr>
				<div class="col-md-4" style="margin-top: 4%">
					<form action="" method="POST">
						<h4 style="background-color: #637281; padding: 2%">Add an Admin</h4>
						<div class="form-group">
							<label for="name"> <b> Name:</b> </label>
							<input type="text" name="name" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="email"> <b> Email:</b> </label>
							<input type="email" name="email" id="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="pass"> <b> Password:</b> </label>
							<input type="text" name="password" id="pass" class="form-control">
						</div>

						<input type="submit" name="add_admin" class="btn btn-block" value="ADD">
						
					</form>
				</div>
			</div>
			</div>

	</div>
	<footer class="page-footer stylish-color-dark font-small" id="footer" style="background: #010101; color: white; height: 100px;">
		<div class="container-fluid">
		<div class="footer-copyright text-center">
			&copy; FJhhames 2018
		</div>
		</div>
	</footer>
</body>

<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="../fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
<script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>


</html>