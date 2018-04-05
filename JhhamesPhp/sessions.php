<?php
	session_start();
	ob_start();

	function session($var)
	{
		return $_SESSION[$var];
	}

	function error()
	{
		if(isset($_SESSION['errorMessage'])){
			$output = "<div class=\"alert alert-danger alert-dismissible\" >";
			$output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
			$output .= htmlentities($_SESSION['errorMessage']);
			$output .= "</div>";
			$_SESSION['errorMessage'] = NULL;

			return $output;
		}
	}

	function success()
	{
		if(isset($_SESSION['successMessage'])){
			$output = "<div class=\"alert alert-success alert-dismissible\" >";
			$output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";			
			$output .= htmlentities($_SESSION['successMessage']);
			$output .= "</div>";
			$_SESSION['successMessage'] = NULL;

			return $output;
		}		
	}

	function redirect_to($location)
	{
		header("location:$location");
	}

?>