<?php
	include('../JhhamesPhp/database.php');
	include('../JhhamesPhp/sessions.php');
	 $connect = connect_db('dashboard');

	 if(!isset($_SESSION['admin_name']) && !isset($_SESSION['admin_email']) )
	 {
	 	$_SESSION['errorMessage'] = "Login is required to access the page";
	 	redirect_to('login.php');	
	 }

	 if(post('deactive') !== null)
	 {
	 	$id = post('deactive');

		$sql = "UPDATE `subscribers` SET subscription = 'inactive' where id = '$id';";
		$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

		if($query)
		{
			$_SESSION['successMessage'] = "Subscriber Deactivated";
		}
		else
		{
			$_SESSION['errorMessage'] ="Error occured, TRY AGAIN!!!";
		}
	 }

	 if(post('active') !== null)
	 {
	 	$id = post('active');

		$sql = "UPDATE `subscribers` SET subscription = 'active' where id = '$id' ;";
		$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

		if($query)
		{
			$_SESSION['successMessage'] = "Subscriber Activated";
		}
		else
		{
			$_SESSION['errorMessage'] ="Error occured, TRY AGAIN!!!";
		}
	 }


	 if(isset($_SESSION['admin_name'])  && isset($_SESSION['admin_email']) )
	 {
	 	$sql = "SELECT * from `subscribers`";

	 	$select_subs = fetch_custom($connect, $sql);
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
						<li class="active"><a href="subscribers.php"><span class="glyphicon glyphicon-user"> </span> Subscribers </a> </li>
						<li><a href="admin.php"><span class="glyphicon glyphicon-user"> </span> Admins </a> </li>
						<li><a href="edit.php"><span class="glyphicon glyphicon-book"> </span> Edit text </a> </li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout </a> </li>
					</ul>
			</div>
			<div class="col-md-10" style="padding-top: 1px;">
				<div class="row">
						<h1 id="headtext">Subscribers List</h1>
						<?= error(); ?>
						<?= success(); ?>

				</div>
				<div class="table-responsive">
				<table class="table table-striped table-hover table-responsive" style="width: 100%; margin: auto;">
					<thead class="thead-dark">
					<tr>
						<th>
							Designer 
						</th>
						<th>
							Owner 
						</th>
						<th>
							Email address 
						</th>
						<th>
							Subscription
						</th>
						<th>
							Action
						</th>
					</tr>
					</thead> 
					<tbody>
					<?php  

						if(isset($select_subs) && $select_subs != NULL )
						{
							while ($row = mysqli_fetch_array($select_subs))
							{
					?>
					<tr>
						<td>
							<?= $row['designer_name'] ?>
						</td>
						<td>
							<?= $row['owner_name'] ?>
						</td>
						<td>
							<?= $row['email'] ?>
						</td>
						<td>
							<?= $row['subscription'] ?>
						</td>
						<td>
							<form action="" method="POST"> 
								<button type="submit" name="active" class="btn btn-success" value="<?= $row['id'] ?>" > Activate
								</button>
							
								<button type="submit" name="deactive" class="btn btn-danger" value="<?= $row['id'] ?>" > De-Activate
								</button>
							</form>
						</td>
					</tr>
					<?php
							}
						}
					?>
					</tbody>
					
				</table>
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