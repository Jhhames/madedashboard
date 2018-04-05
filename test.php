<?php
	// include('JhhamesPhp/database.php');
	// include('JhhamesPhp/sessions.php');
	//        $connect = connect_db('dashboard');

$sql_5 = "SELECT * FROM `dashtable` WHERE (owner = '$email' AND status = 'slide') ORDER BY id DESC";
$fetch_5 = fetch_custom($connect, $sql_5);

$slide_to = 0;
	while ($row = mysqli_fetch_array($fetch_5)) {
		if($slide_to == 0)
		{
			$class = 'active';
		}
		else
		{
			$class = '';
		}
?>
	<div class="item <?= $class?>">
	<img src="<?= $row['url'] ?>" width="100%s" alt="<?= $row['description'] ?>" style="height: 500px;" >
		<div class="carousel-caption">
			<h3 style="font-family: monospace;"> <?= $row['description'] ?> </h3>
		</div>
	</div>									
<?php	
	$slide_to ++;	
	}
?>