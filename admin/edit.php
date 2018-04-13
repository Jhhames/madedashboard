<?php
	include('../JhhamesPhp/database.php');
	include('../JhhamesPhp/sessions.php');
	 $connect = connect_db('dashboard');

	 if(!isset($_SESSION['admin_name']) && !isset($_SESSION['admin_email']) )
	 {
	 	$_SESSION['errorMessage'] = "Login is required to access the page";
	 	redirect_to('login.php');	
	 }

	 if(isset($_SESSION['admin_name'])  && isset($_SESSION['admin_email']) )
	 {
	 	$email = $_SESSION['admin_email'];
	 	$sql = "SELECT * from `admin` where email ='$email'";

	 	$select_admin = fetch_custom($connect, $sql);
	 }


	 if(post('save') !== NULL )
	 {
	 
	
	 	$head = post('head');
	 	$about = post('about');
	 	$event = post('event');
	 	$talk = post('talk');

	 	$sql = "UPDATE `edits` SET head = '$head', about = '$about', event = '$event', talk = '$talk' WHERE id = 1 ";
	 	$save = fetch_custom($connect, $sql);

	 		if($save)
	 		{
	 			$_SESSION['successMessage'] = "Edit Successful";
	 		}
	 		else
	 		{
	 			// echo mysqli_error($connect);
	 		}

	 }


	 $sql = "SELECT * FROM `edits` WHERE id = 1";
	 $select = fetch_custom($connect, $sql);

	 $row = mysqli_fetch_array($select);

	 $dbhead = $row['head'];
	 $dbabout = $row['about'];
	 $dbevent = $row['event'];
	 $dbtalk = $row['talk'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>
Edit homepage data
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
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<h4> User Dashboard</h4> <p>
					<ul  class="nav nav-pills nav-stacked" id="side_Menu">
						<li>   <a href="index.php"><span class="glyphicon glyphicon-th"> </span> Dashboard </a> </li>
						<li><a href="subscribers.php"><span class="glyphicon glyphicon-user"> </span> Subscribers </a> </li>
						<li><a href="admin.php"><span class="glyphicon glyphicon-user"> </span> Admins </a> </li>
						<li class="active"><a href="edit.php"><span class="glyphicon glyphicon-book"> </span> Edit text </a> </li>
						<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout </a> </li>
					</ul>
			</div>
			<div class="col-md-10" style="padding-top:;">
				<div class="row">
						<h1 id="headtext">Admin <?= $_SESSION['admin_name'] ?></h1>

						<?= error(); ?> <?= success(); ?>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
					<strong>Edit Homepage data </strong>	
					</div>
					<div class="panel-body">
						<form action="" method="POST">
							<div class="form-group">
								<label for="head"><h3> Head text </h3> </label>
								<textarea name="head" id="head" class="form-control" required> <?= $dbhead ?> </textarea>
							</div>

							<div class="form-group">
								<label for="about"><h3> About us</h3> </label>
								<textarea name="about" id="about" class="form-control" required> <?= $dbabout ?> </textarea>
							</div>

							<div class="form-group">
								<label for="event"><h3> About Event</h3> </label>
								<textarea name="event" id="event" class="form-control" required> <?= $dbevent ?></textarea>
							</div>

							<div class="form-group">
								<label for="talk"><h3> What Designer's are saying </h3> </label>
								<textarea name="talk" id="talk" class="form-control" required> <?= $dbtalk ?> </textarea>
							</div>

							<button  type="submit" class="btn btn-secondary btn-block" name="save">
								<span class="glyphicon  glyphicon-save"> </span> Save
							</button>
						</form>

					</div>
				

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
<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>


</html>