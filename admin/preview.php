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
	 	// $email = $_SESSION['admin_email'];
	 $sql = "SELECT * FROM `edits` WHERE id = 1";
	 $select = fetch_custom($connect, $sql);

	 $row = mysqli_fetch_array($select);

	 $dbhead = $row['head'];
	 $dbabout = $row['about'];
	 $dbevent = $row['event'];
	 $dbtalk = $row['talk'];

	 }

 	 $sql = "SELECT * FROM `sponsors`";
	 $sponsors_select = fetch_custom($connect, $sql);

	 $sql = "SELECT * FROM `subscribers` WHERE subscription = 'active' ";
	 $sub_select = fetch_custom($connect, $sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>
Admin Dashboard
	</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.8.0/slick.css"/>

	 <link rel="stylesheet" type="text/css" href="../css/slick.css"/>
	   <link rel="stylesheet" type="text/css" href="../css/slick-theme.css"/>

	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/mystyles.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<!-- <div class="col-md-2">
				<h4> User Dashboard</h4> <p>
					<ul  class="nav nav-pills nav-stacked" id="side_Menu">
						<li class="active">   <a href="index.php"><span class="glyphicon glyphicon-th"> </span> Dashboard </a> </li>
						<li><a href="subscribers.php"><span class="glyphicon glyphicon-user"> </span> Subscribers </a> </li>
						<li><a href="admin.php"><span class="glyphicon glyphicon-user"> </span> Admins </a> </li>
						<li><a href="edit.php"><span class="glyphicon glyphicon-book"> </span> Edit text </a> </li>
						<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout </a> </li>
					</ul>
			</div> -->
			<div class="col-md-12" style="padding-top: 1px;">
				<div class="row">
						<h1 id="headtext" class="text-capitalize text-center"><?= $dbhead ?></h1>

				</div>
				<!-- <?= error(); ?> <?= success(); ?> -->
				<div class="panel panel-default">
					<div class="panel-heading">
						About Event 
					</div>
					<div class="panel-body">
						<?= $dbevent ?>
					</div>
				

				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						Our Sponsors 
					</div>
					<div class="panel-body">
						<?php
							if(isset($sponsors_select) && mysqli_num_rows($sponsors_select)> 0)
							{
								while ($row = mysqli_fetch_array($sponsors_select))
								{
									
						?>
						<!-- <span class="col-sm-1"> -->
								<span id="hoverimage">
									<img width="60px" height="60px" src="<?= $row['url'] ?>" class="img-rounded" alt="Sponsors logo">
								</span>
							
						<!-- </span> -->

						<?php

								}
							}
							else
							{
						?>
						<button class="disabled btn btn-default">
							No Logos uploaded yet
						</button>	
						<?php
							}
						?>
					</div>
				

				</div>

				<div class="panel panel-info">
					<div class="panel-heading">
						Our Deisgners 
					</div>
					<div class="panel-body">
						<div class="row">	
							<div class="col-md-4"></div>
							<div class="col-md-4 slide-image"  id="hoverimage">
						<?php
							if(isset($sub_select) && mysqli_num_rows($sub_select)>0)
							{
								while($row = mysqli_fetch_array($sub_select))
								{
						?>
								<div style="margin: 2%;">
									<div class="thumbnail" style="margin: 2%;" > <img src="<?=$row['logo'] ?>" width="100%"> </div>
										 <p class="caption"> <?= $row['designer_name'] ?></p>
								</div>
						<?php
								}
							}

						?>
		
							</div>
						</div>

					</div>
				

				</div>


				<div class="panel panel-default">
					<div class="panel-heading">
						About Us 
					</div>
					<div class="panel-body">
						<?= $dbabout ?>
					</div>
				

				</div>


				<div class="panel panel-default">
					<div class="panel-heading">
						What designers are saying 
					</div>
					<div class="panel-body">
						<?= $dbtalk ?>
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

<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="../fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
<script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.8.0/slick.min.js"></script>

  <script type="text/javascript" src="../js/slick.min.js"></script>
  <script type="text/javascript" src="../js/slick.js"></script>

<style type="text/css">
	.slide-image img {
		height: 100px;
		/*width: 200%;*/
		/*border-radius: 30px;*/
	}
.thumbnail {
    background-color: rgba(0, 0, 0, 0.1);
}
</style>
<script type="text/javascript">

// $('.slide-image').slick();

$('.slide-image').slick({
  autoplay:true,
  autoplaySpeed: 2000,
  dots: true,
  pauseOnHover: true,
  focusOnHover: true,
  centerMode: true,
  infinite: true,
  adpativeHeight: false,
  centerPadding: '60px',
  slidesToShow: 1,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 2
      }
    }
  ]
});

					
</script>

</body>



</html>