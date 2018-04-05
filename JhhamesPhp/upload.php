<?php
if ((post('upload')!== null) && (post('desc')!== null))
	{
		 	$name = $_FILES['image']['name'];
		 	$tmp_loc =$_FILES['image']['tmp_name'];
		 	$type = $_FILES['image']['type'];
		 	$size = $_FILES['image']['size'];
			
			if(($type !== 'image/png') && ($type != 'image/jpg') && ($type != 'image/jpeg') )
			{
				$_SESSION['errorMessage'] ="You need to select a PNG or JPG or JPEG picture.";
				$_SESSION['errorMessage'] .= " You selceted a file ".$type;
			}
			else
			{
				$errorforupload = $_SESSION['errormessage'] = "unable to upload image, Check that the size is right";
				$upload = move_uploaded_file($tmp_loc, 'uploads/'.$name) or die($errorforupload);
					if($upload)
					{
						$file_url = 'http://localhost/dashboard1/uploads/'.$name;
						$description = post('desc');
						$file_name = $name;

						$array = array (
							'id' => ' ' ,
							'url' => $file_url,
							'name' => $file_name,
							'owner' => $_SESSION['email'],
							'description' => $description,
							'owner' => $_SESSION['email'],
							'status' => 'not-slide'

						);

							if(insert($array, $connect, 'dashtable'))
							{
								$_SESSION['successMessage'] = "Picture Upload to gallery successful";
							}
							else
							{
								$_SESSION['errorMessage'] = "Unable to upload to database";
							}
					}
			}

	}

?>