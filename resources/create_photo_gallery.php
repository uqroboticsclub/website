<?php
	extract($_POST);
	$error=array();
	$extension=array("jpeg","jpg","png","gif");
	foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
	    $file_name=$_FILES["files"]["name"][$key];
	    $file_tmp=$_FILES["files"]["tmp_name"][$key];
	    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
	    if(in_array($ext,$extension)) {
	        if(!file_exists("../assets/project_photos/".$txtGalleryName."/".$file_name)){
	            move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../assets/project_photos/".$txtGalleryName."/".$file_name);
	            
	            // Add the photo to the database
				session_start();
				
				$con = mysqli_connect('localhost','timhadwe_admin','5Awr2juW','timhadwe_uqrobotics_projectspace');
				if(!$con){
					echo "ERROR";
					return;
				}
				
				
				// Get the user email
				$user_email = $_SESSION['email'];
				$project_id = $_POST['id'];
				
				if(!isset($user_email)){
					// Not logged in therefore return to index (for now)
					header("Location: ../index.php?errorcode=1");
					return;
				}
				
				echo $file_name;
				
				if($stmt = $con->prepare("INSERT INTO Project_Image (image_url, project_id) VALUES (?, ?)")){
				   $stmt->bind_param("ss", $file_name, $project_id);
				   $stmt->execute();
				   echo "Success";
				}
				
				mysqli_close($con);
	
	        }
	    } else {
	    	// Wrong file extention
	        array_push($error,"$file_name, ");
	    }
	}
	
	header("Location: ../index.php");
?>