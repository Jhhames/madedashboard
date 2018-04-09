<?php
	include('JhhamesPhp/database.php');
	include('JhhamesPhp/sessions.php');
	 $connect = connect_db('dashboard');

	 if(!isset($_SESSION['owner_name']) && !isset($_SESSION['email']) )
	 {
	 	$_SESSION['errorMessage'] = "Login is required to access the page";
	 	redirect_to('register.php');	
	 }

	 $email = $_SESSION['email'];
	 $sql = "SELECT * from `dashtable` where owner = '$email' ";

	 $select_pictures = fetch_custom($connect, $sql); 

	 $num_pictures = mysqli_num_rows($select_pictures);

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


  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
    
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
						<li><a href="upload.php"><span class="glyphicon glyphicon-upload"> </span> Upload </a> </li>
						<li><a href="subscription.php"><span class="glyphicon glyphicon-user"> </span> Subscription </a> </li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout </a> </li>
					</ul>
			</div>
			<div class="col-md-10">
				<?php
				echo success();
				echo error();
				?>
				<div class="row text-center" >
					<h1 id="headtext"><?= $_SESSION['designer_name'] ?>  </h1>
					
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
									<?= $_SESSION['owner_name'] ?>
								</td>
							</tr>
							<tr>
								<td>
									<strong> Gallery</strong>	
								</td>

								<td>
									<?=	$num_pictures ?>
								</td>
							</tr>	
							<tr>
								<td>
									<strong> subscription </strong>	
								</td>

								<td>
									<span class="bg-success"><?= $_SESSION['subscription'] ?> </span>
								</td>
							</tr>	
						
												
						</table>
							
					</div>
				</div>
					

			</div>
			</div>

	</div>
	<footer class="page-footer stylish-color-dark font-small fixed-bottom" id="footer" style="background: #010101; color: white; height: 100px;">
		<div class="container-fluid">
		<div class="footer-copyright text-center">
			&copy; FJhhames 2018
		</div>
		</div>
	</footer>
</body>
</html>