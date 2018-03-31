<?php
	include('JhhamesPhp/database.php');
	include('JhhamesPhp/sessions.php');
	 $connect = connect_db('dashboard');
	include('JhhamesPhp/validation.php');
	
	if (post('signup') != null) {
		$designer = post('dname');
		$owner = post('oname');
		$email = post('email');
		$password = post('password');
		$url ="";
		$_SESSION['errorMessage'] = "unable to upload logo, Check that the size is right, you can upload later in the update profile page";
	 	
			if(post('logo') != null)
			{
				$name = $_FILES['logo']['name'];
			 	$tmp_loc =$_FILES['logo']['tmp_name'];
			 	$type = $_FILES['logo']['type'];
			 	$size = $_FILES['logo']['size'];
				if(($type != 'image/png') && ($type != 'image/jpg') && ($type != 'image/jpeg') )
				{
					$_SESSION['errorMessage'] ="You need to select a PNG or JPG or JPEG picture.";
					$_SESSION['errorMessage'] .= " You selceted a file ".$type;
					$_SESSION['errorMessage'] .= " you can upload later in the update profile page";
					$url = "";
				}
				else
				{
					$errorforupload = $_SESSION['errorMessage'] = "unable to upload logo, Check that the size is right, you can upload later in the update profile page";
					$upload = move_uploaded_file($tmp_loc, 'uploads/'.$name) or die($errorforupload);
						if($upload)
						{
							$file_url = 'http://localhost/dashboard1/uploads/'.$name;
							$description = post('desc');
							$file_name = $name;

							$url = $file_url;
							$_SESSION['errorMessage'] = "";
						}
						else
						{
							$_SESSION['errorMessage'] = "unable to upload logo, Check that the size is right, you can upload later in the update profile page";
							$url = "";
						}
				}
			}
			 	$array = array(
			 		'designer_name' => $designer,
			 		'owner_name'=> $owner,
			 		'email' => $email,
			 		'password' => $password,
			 		'subscription' => 'inactive',
			 		'logo' => $url
			 	);

			 	$to_db = insert($array,$connect, 'subscribers' );

			 	if ($to_db)
			 	{	
			 		$_SESSION['username'];
			 		$_SESSION['successMessage'] = "Registration successful , please check the subscription page for more info";
			 		redirect_to('index.php');
			 	}
			 	else
			 	{
			 		echo "Awon aye to get code yii";
			 	}
	 } 
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Registration panel
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/mystyles.css">
	<script type="text/javascript">
		$(function(){
			$('#signup_form').submit(function(event){
				var dname = $("#dname").val();
				var oname = $("#oname").val();
				var email = $("#email").val();
				var password1 = $("#password1").val();
				var vpword = $("#vpword").val();

				validateNameField(dname,event);
				validateOnameField(oname,event);
				validatePassField(password1,event);
				validateVerifyField(password1,vpword,event)

			}); 

		});

		function  validateNameField(name, event)
		{	
			if(name == "")
			{
				$('#name-feedback').text("This field can't be empty");
				event.preventDefault();
			}
			else if(!isValidName(name))
			{
				$("#name-feedback").text("Please Enter atleast two characters");
				event.preventDefault();
			}
			else
			{
				$("#name-feedback").text("");
			}

		}

		function  validateOnameField(name, event)
		{	
			if(name == "")
			{
				$('#oname-feedback').text("This field can't be empty");
				event.preventDefault();
			}
			else if(!isValidName(name))
			{
				$("#oname-feedback").text("Please Enter atleast two characters");
				event.preventDefault();
			}
			else
			{
				$("#oname-feedback").text("");
			}

		}
		function  validatePassField(password, event)
		{	
			if(password == "")
			{
				$('#pass-feedback').text("Password fields can't be empty");
				event.preventDefault();
			}
			else if(!isLong(password))
			{
				$('#pass-feedback').text("Password Field must contain atleast 6 characters");
				event.preventDefault();
			}
			else
			{
				$("#pass-feedback").text("");
			}

		}

		function  validateVerifyField(password, vpassword, event)
		{	
			if(password != vpassword)
			{
				$('#verify-feedback').text("Verify password didn't match the password field ");
				event.preventDefault();
			}
			else
			{
				$("#verify-feedback").text("");
			}

		}

		function isValidName(name)
		{
			return name.length >= 2;
		}

		function isEmpty(password)
		{
			return password.trim() == "";
		}

		function isLong(password)
		{
			return password.length > 6;
		}

	</script>
</head>
<body style="background-color: #f9f9f9" >
	<div class="container" style="padding-top: 100px; margin: auto">
		<ul class="nav nav-tabs" >
			<li style="width: 50%"> <a href="#signup" data-toggle="tab"><strong> Sign Up</strong> </a> </li>
			<li class="active" style="width: 50%"> <a href="#login" data-toggle="tab"> <b> Sign In </b> </a> </li>
		</ul>
		
		<div class="tab-content" style="background-color: white ;" >
			<div class="tab-pane fade" id="signup" >
				<div class="row" style="padding:10px">
					<form method="POST" style="padding: 10px ;" id="signup_form">
						<div class="form-group">
							<label for="dname"> Desiger name<br> <span style="color: red;" id="name-feedback"></span> </label>
							<input class="form-control" type="text" name="dname" id="dname" placeholder="Enter Deisgner company name" >
						</div>

						<div class="form-group">
							<label for="oname"> Owner's name <br> <span style="color: red;" id="oname-feedback"></span> </label>
							<input  class="form-control" type="text" name="oname" id="oname" placeholder="Enter company owner's name"  />
						</div>

						<div class="form-group">
							<label for="email1"> Email Address</label><br>
							<input class="form-control" type="email" name="email" id="email1"  placeholder="Enter owner/company mail Address" />
						</div>

						<div class="form-group">
							<label for="password1"> Password <br> <span style="color: red;" id="pass-feedback"></span> </label><br>
							<input class="form-control" type="password" name="password" id="password1"  placeholder="Enter Password" />
						</div>

						<div class="form-group">
							<label for="vpword">Retype Password <br> <span style="color: red;" id="verify-feedback"></span> </label><br>
							<input class="form-control" type="password" name="vpword" id="vpword"  placeholder="Verify Password" />
						</div>

						<div class="form-group">
							<label for="logo"> Upload Designer's Logo (optional)</label>
							<input type="file" name="logo" id="logo">
						</div>

						<input type="submit" class="btn btn-primary btn-block" name="signup" value="Sign up" />
					</form>
				</div>
			</div>

			<div class="tab-pane fade in active " id="login">
				<div class="row" style="padding: 10px ; ">
					<form method="POST" style="padding: 10px ;">
						<div class="form-group">
							<label for="email"> Email </label><br>
							<input class="form-control" type="email" name="email" id="email">
						</div>

						<div class="form-group">
							<label for="password"> Password </label><br>
							<input class="form-control" type="password" name="password" id="password">
						</div>
						<input type="submit" class="btn btn-primary btn-block" name="login" value="Sign in" />
					</form>
				</div>
			</div>
		</div>

	</div>


</body>
</html>