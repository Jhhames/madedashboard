<?php
 include('JhhamesPhp/sessions.php');

	session_destroy();
	redirect_to('register.php');

?>