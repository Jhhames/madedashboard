<?php

$array = array(
		'id' => ' ',
		'name' => 'name',
		'class1' => 'class1',
		'class2' => 'class2',
		'class3' => 'class3',
		'class4' => 'class4'
		);
$columns = implode(", ",array_keys($array));
	// $escaped_values = array_map('mysqli_real_escape_string', array_values($array));
	$values  = implode("', '", $array);

	echo "('$values')". "<br>";
	echo ($columns);
		?>

