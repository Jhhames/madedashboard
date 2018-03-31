<?php
	function text_error()
	{
	if(isset($_SESSION['textError'])){
	$output = "<div class=\"alert alert-danger\" >";
	$output .= htmlentities($_SESSION['textError']);
	$output .= "</div>";
	$_SESSION['textError'] = NULL;

	return $output;
	}
	}


	function val_text($index)
	{
		if(empty($_POST[$index]))
		{	
			$form_value = $_POST[$index];
			$_SESSION['textError'] = "This field cannot be empty";
		}else
		{
			$index = $_POST[$index];

			if (!preg_match( "/^[A-Za-z. ]*$/", $index))
			{
				$_SESSION['textError'] = "This field should only contai letters and white spaces";	
			}
		}

	}	

	function form_value()
	{
		if(isset($form_value))
		{
			return $form_value;
		}
	}


?>