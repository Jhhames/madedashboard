<?php
	include('JhhamesPhp/database.php');
	include('JhhamesPhp/sessions.php');
	 $connect = connect_db('dashboard');
	include('JhhamesPhp/remove.php'); 
	include('JhhamesPhp/add.php'); 

	 if(!isset($_SESSION['owner_name']) && !isset($_SESSION['email']) )
	 {
	 	$_SESSION['errorMessage'] = "Login is required to access the page";
	 	redirect_to('register.php');	
	 }

	if(post('delete') !== null)
	{
		$id = post('delete');
		$sql = "DELETE FROM `dashtable` where id = $id";

			$query = mysqli_query($connect, $sql);

			if($query)
			{
				$_SESSION['successMessage'] = "Picture Delete successful";
			}
			else
			{
				$_SESSION['errorMessage'] = "Unable to delete. TRY AGAIN ". mysqli_error($connect);
			}

	}

	$email = $_SESSION['email'];

	$sql = "SELECT * FROM `dashtable` where owner = '$email' ORDER BY id DESC ";
	$fetch = fetch_custom($connect, $sql); 

	$sql_5 = "SELECT * FROM `dashtable` WHERE (owner = '$email' AND status = 'slide') ORDER BY id DESC";
	$fetch_5 = fetch_custom($connect, $sql_5);

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
						<ul  class="nav nav-pills nav-stacked nav-back-collapse" id="side_Menu">
							<li>   <a href="index.php"><span class="glyphicon glyphicon-th"> </span> Dashboard </a> </li>
							<li class="active"><a href="gallery.php"><span class="glyphicon glyphicon-picture"> </span> Gallery </a> </li>
							<li><a href="upload.php"><span class="glyphicon glyphicon-upload"> </span> Upload </a> </li>
							<li><a href="subscription.php"><span class="glyphicon glyphicon-user"> </span> Subscription </a> </li>
							<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout </a> </li>
						</ul>
				</div>
				<div class="col-md-10" style="padding-top:;">
					<div class="row">
						<h3 id="headtext"> All uploads</h3>
					</div>
					<div class="row" style="padding: 10px;">

						<?php

						echo success();		
						echo error();		
									if (isset($fetch) && !empty($fetch))
									{
										while ($row = mysqli_fetch_array($fetch))
										{
								?>
						<div class="col-md-3" style="margin-bottom:10px; ">
								<div class="thumbnail">
									<a class="fancybox" rel="group" href="<?=$row['url'] ?>"><div id="hoverimage"> <img src="<?=$row['url'] ?>" id="images" alt="IMAGE"></div>	</a>						
								</div>
								<p class="caption"> <?= $row['description'] ?> <?php if ($row['status'] == 'slide') {
									echo "<span class='glyphicon glyphicon-play'></span>";
								} ?> <br>
									<form method="POST">
										<button class="btn btn-danger" name="delete" type="submit" value="<?= $row['id'] ?>">
											Delete
										</button >

										<button class="btn btn-success" name="add" type="submit" value="<?=$row['id'] ?>">
											Add to Slide
										</button>
									</form>	
								</p>
						</div> 

								<?php		
										}
									}
									else
									{
										echo "NO PICTURES IN GALLERY";
									}
								?>	

						
					</div>

					<div class="row">
						<h3 id="headtext"> Images in Slide</h3>
						
					</div>

					<div class="row" style="padding:10px">
						<?php
	// $fetch_5 = fetch_order_limit_where('dashtable', $connect, 'DESC', 'status', 'slide');

									if ($fetch_5)
									{
										while ($row = mysqli_fetch_array($fetch_5))
										{
								?>
						<div class="col-md-2">
								<div class="thumbnail">
									<a class="fancybox" rel="group" href="<?=$row['url'] ?>"><div id="hoverimage">
									 <img src="<?=$row['url'] ?>" id="images" alt="IMAGE"></div>	</a>						
								</div>
								<p class="caption"> <?= $row['description'] ?>
									<br>
									<form method="POST">
										<button type="submit" name="remove" value="<?= $row['id'] ?>" class="btn btn-info">
											Remove from slide
										</button>
									</form>	
								</p>
						</div> 

								<?php		
										}
									}
								?>	

						
					</div>
					<div class="row">
						<div id="myslider" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">

								<?php
								$slide_to = 0;
									while ($slide_to < 5) {
										if($slide_to == 0)
										{
											$class = 'active';
										}
										else
										{
											$class = '';
										}
								?>
									<li data-target="#myslider" class="<?= $class ?>" data-slide-to="<?= $slide_to ?>"></li>
									
								<?php	
									$slide_to ++;	
									}
								?>
							</ol>
							
						
						 <div class="carousel-inner" role="listbox">

 						<?php
 							include('test.php');
 						?>
								
						</div>
							<a class="carousel-control left" href="#myslider" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left">
									
								</span>
							</a>
							<a class="carousel-control right" href="#myslider" data-slide="next" >
								<span class="glyphicon glyphicon-chevron-right">
									
								</span>
							</a>	
						</div>
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