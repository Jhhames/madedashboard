<?php


function connect_db($database)
{
	$connect = mysqli_connect('localhost', 'root', '', $database) or die('unable to make databse connection');
	return $connect;
}

function post($var)
{
	$connect = connect_db('dashboard');
	if(isset($_POST[$var]))
	{
		return trim(mysqli_real_escape_string($connect, $_POST[$var]));
	}
}

function insert($array,$connect,$tablename)
{
	$columns = implode(", ",array_keys($array));
	// $escaped_values = array_map('mysqli_real_escape_string', array_values($array));
	$values  = implode("', '", $array);

	$sql = "INSERT INTO `$tablename`($columns) VALUES ('$values'); ";
	$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	return $query;
} 


function fetch_custom($connect, $sql)
{
	$query = mysqli_query($connect,$sql) or die(mysqli_error($connect));
	return $query;
}


  


?>