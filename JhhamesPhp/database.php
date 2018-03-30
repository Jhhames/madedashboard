<?php

function post($var)
{
	if(isset($_POST[$var]))
	{
		return $_POST[$var];
	}
}

function connect_db($database)
{
	$connect = mysqli_connect('localhost', 'root', '', $database) or die('unable to make databse connection');
	return $connect;
}

function insert($array,$connect,$tablename)
{
	$columns = implode(", ",array_keys($array));
	// $escaped_values = array_map('mysqli_real_escape_string', array_values($array));
	$values  = implode("', '", $array);

	$sql = "INSERT INTO `$tablename` VALUES ('$values'); ";
	$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	return $query;
} 

function fetch($tablename,$connect)
{
	$sql = "SELECT * FROM $tablename";
	$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	return $query;
}

function fetch_order($tablename,$connect, $order)
{
	$sql = "SELECT * FROM $tablename
			ORDER BY id $order ";
	$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	return $query;
}

function fetch_order_limit($tablename,$connect, $order,$limit)
{
	$sql = "SELECT * FROM $tablename
			ORDER BY id $order
			LIMIT $limit ";
	
	$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	return $query;
}

function fetch_order_limit_where($tablename,$connect, $order,$wherevariable, $wherevalue)
{
	$sql = "SELECT * FROM $tablename	
			WHERE $wherevariable = '$wherevalue'
			ORDER BY id $order";
	
	$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	return $query;
}



?>