<!-- <?php
	include('JhhamesPhp/database.php');
	include('JhhamesPhp/sessions.php');
	 $connect = connect_db('dashboard');

	if((post('submit') !== null ))
	{
		$name = post('name');
		$class1 = post('class1');
		$class2 = post('class2');
		$class3 = post('class3');
		$class4 = post('class4');

		$array = array(
		'id' => ' ',
		'name' => $name,
		'class1' => $class1,
		'class2' => $class2,
		'class3' => $class3,
		'class4' => $class4
		);

		if(insert($array, $connect, 'dashtable'))
		{
			$_SESSION['successMessage'] = "Data added to database";
		}
		else
		{
			$_SESSION['errorMessage'] = "Error!!";
		}
	}

?> -->

<!DOCTYPE html>
<html>
<head>
	<title>
		Dashboard index 
	</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script> -->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/mystyles.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row" style="height: 100%">
			<div class="col-md-2">
				<h4> User Dashboard</h4> <p>
					<ul  class="nav nav-pills nav-stacked" id="side_Menu">
						<li class="active">   <a href="index.php"><span class="glyphicon glyphicon-th"> </span> Dashboard </a> </li>
						<li><a href="gallery.php"><span class="glyphicon glyphicon-picture"> </span> Gallery </a> </li>
						<li><a href="Upload.php"><span class="glyphicon glyphicon-upload"> </span> Upload </a> </li>
						<li><a href="subscription.php"><span class="glyphicon glyphicon-user"> </span> Subscription </a> </li>
						<li><a href=""><span class="glyphicon glyphicon-log-out"> </span> Logout </a> </li>
					</ul>
			</div>
			<div class="col-md-10">
				<?php
				echo success();
				echo error();
				?>
				<div class="row text-center" >
					<h1 id="headtext">K - COUTURE  </h1>
					
				</div>
				<div class="row" style="padding: 5px">
					<div class="col-md-5">
						<center id="hoverimage"> <img src="images/download.png" style="margin: auto; border-radius: 150px;">		</center>			
					</div>
					<div class="col-md-7" style="margin-top:">
							<table class="table table-striped table-hover" style="height: 100%">
							
							<tr style="background-color: #820192; text-align: center; color: white">
								<th colspan="2">
									User Profile
								</th>
								
							</tr>
							<tr>
								<td style="width: 30%">
									<strong>Company owner</strong>
								</td>
								<td>
									Enioluwa
								</td>
							</tr>
							<tr>
								<td>
									<strong> Gallery</strong>	
								</td>

								<td>
									18 Pictures
								</td>
							</tr>	
							<tr>
								<td>
									<strong> subscription </strong>	
								</td>

								<td>
									<span class="bg-success">Active </span>
								</td>
							</tr>	
							<tr>
								<td>
									<strong> subscription </strong>	
								</td>

								<td>
									Active
								</td>
							</tr>	
							<tr>
								<td>
									<strong> subscription</strong>	
								</td>

								<td>
									Active
								</td>
							</tr>
												
						</table>
							
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
</html>