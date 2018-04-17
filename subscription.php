<?php
	include('JhhamesPhp/database.php');
	include('JhhamesPhp/sessions.php');
	 $connect = connect_db('dashboard');
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Dashboard index 
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/mystyles.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<h4> User Dashboard</h4> <p>
					<ul  class="nav nav-pills nav-stacked" id="side_Menu">
						<li>   <a href="index.php"><span class="glyphicon glyphicon-th"> </span> Dashboard </a> </li>
						<li><a href="gallery.php"><span class="glyphicon glyphicon-picture"> </span> Gallery </a> </li>
						<li><a href="upload.php"><span class="glyphicon glyphicon-upload"> </span> Upload </a> </li>
						<li class="active"><a href="Subscription.php"><span class="glyphicon glyphicon-user"> </span> Subscription </a> </li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout </a> </li>
					</ul>
			</div>
			<div class="col-md-10" style="padding-top: px;">
				<div class="row">
						<h1 id="headtext">Subsription </h1>
				</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<b> Subscription details </b> &nbsp; Your subscription is currently <?= $_SESSION['subscription'] ?>
							</div>
							<div class="panel-body">
								I can type whatever you want to tell them about subscription here including the account to transfer to 
							, amount to transfer and all.

							</div>
							<div class="panel-footer">
								<form action="/process" method="POST" >
								  <script
								    src="https://js.paystack.co/v1/inline.js" 
								    data-key="pk_test_6111466383fd76616698800665c28cfc335d50eb"
								    data-email="customer@email.com"
								    data-amount="10000"
								    
								  >
								  </script>
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