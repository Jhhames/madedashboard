<?php
	include('JhhamesPhp/database.php');
	include('JhhamesPhp/sessions.php');
	 $connect = connect_db('dashboard');

	if(!isset($_SESSION['owner_name']) && !isset($_SESSION['email']) )
	{
		$_SESSION['errorMessage'] = "Login is required to access the page";
		redirect_to('register.php');	
	}

	include('JhhamesPhp/upload.php');
    
    $email = $_SESSION['email'];
	$sql = "SELECT * FROM `dashtable` where owner = '$email' ORDER BY id DESC LIMIT 6 ";
    $fetch= fetch_custom($connect, $sql);
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
				<h4><strong>User Dashboard</strong> </h4> <p>
					<ul  class="nav nav-pills nav-stacked" id="side_Menu">
						<li>   <a href="index.php"><span class="glyphicon glyphicon-th"> </span> Dashboard </a> </li>
						<li><a href="gallery.php"><span class="glyphicon glyphicon-picture"> </span> Gallery </a> </li>
						<li class="active"><a href="upload.php"><span class="glyphicon glyphicon-upload"> </span> Upload </a> </li>
						<li><a href="subscription.php"><span class="glyphicon glyphicon-user"> </span> Subscription </a> </li>
						<li><a href="logout.php"> <span class="glyphicon glyphicon-log-out"> </span> Logout </a> </li>
					</ul>
			</div>
			<div class="col-md-10">

				<div class="row" >
					<h2 id="headtext">Add Photos to your gallery</h2>
				</div>
			
				<h3>Last Uploads </h3>
				<div class="row">
				<?php
				echo success();
				echo error();

				?>
					<?php		
						if ($fetch)
						{
							while ($row = mysqli_fetch_array($fetch))
							{
					?>
								<div class="col-md-2">
										<div class="thumbnail">
											<a class="fancybox" rel="group" href="<?=$row['url'] ?>"><div id="hoverimage"> <img src="<?=$row['url'] ?>" id="images" alt="IMAGE"></div>	</a>						
										</div>
										<p class="caption"> <?= $row['description'] ?></p>
								</div> 

					<?php		
							}
						}
					?>	
								
				</div>	
				<div class="row">
				<h4 id="headtext"> Upload New <span class="glyphicon glyphicon-plus"></span></h4>
					
				</div>		

				<div class="row" style="padding: 10px;">
						
						<div  class="table-responsive">
						<form action="#" method="POST" enctype="multipart/form-data">
					<table class="table table-striped" style="width: 100%">
							<tr>
									<td width="20%">
										<label for="image">
										Choose a Picture to Upload:
										</label>
									</td>
									<td>
										<input type="file" id="image" name="image" required>
									</td>
									
							</tr>
							<tr>
									<td>
										<label for="desc">
										Picture Description:
										</label>
									</td>
									<td>
										<input type="text" name="desc" id="desc" style="width:100%" required placeholder="Write a short description of the picture">
									</td>
									
							</tr>
							<tr>
								<td colspan="2">
									<button type="submit" class="btn btn-success btn-block" name="upload" > Upload </button>
								</td>
							</tr>
						</table>
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
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>

</html>