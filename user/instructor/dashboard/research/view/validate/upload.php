<?php
	session_start();
	/*echo "Seesion id: " . $_SESSION['uid'] ."\n";
	print_r($_FILES['file']);
	echo "\nBook_ID: " . $_POST['book_id'];
	echo "\nAction : " . $_POST['file-action'];
	*/
	if(isset($_SESSION['uid']) && $_FILES['file'] && $_POST['book_id'] && $_POST['file-action']){
		

	   //print_r($file);
		include $_SERVER['DOCUMENT_ROOT'] . "/rrms-buksu/includes/path.php";
		include PROJECT_ROOT_NOT_LINK . "includes/connection.php";

		$book_id = $_POST['book_id'];
		$action = $_POST['file-action'];

		
		$dbconfig = new dbConfig();
		$con = $dbconfig ->getCon();

		$stmt = $con->prepare("SELECT `cover`, `docloc`, `aut_type`, YEAR(`pub_date`) as year FROM `book` WHERE `book_id` = ?");
		if(!$stmt->bind_param("i", $book_id)){

			header("Location: ../?book=" . $book_id . "&msg=Error occured while uploading your file!&alertType=danger");
		}
		if(!$stmt->execute()){
			header("Location: ../?book=" . $book_id . "&msg=Error occured while uploading your file!&alertType=danger");
		}


		$result = $stmt->get_result();
		//echo $result->num_rows;
		if(!$result->num_rows>0){
			header("Location: ../?book=" . $book_id . "&msg=The Research you are refering to is not available!<br> It may happen that one of the author or the Administrator remove your Research. Please Contact the administrator.&alertType=danger");
		}


		$row = $result->fetch_assoc();
		if($action==="file"){
			$oldFileTemp = explode("/", $row['docloc']);
			$oldFile = $oldFileTemp[count($oldFileTemp) - 1];
		}else if($action==="cover"){
			$oldFileTemp = explode("/", $row['cover']);
			$oldFile = $oldFileTemp[count($oldFileTemp) - 1];
		}else{
			header("Location: ../?book=" . $book_id . "&msg=Error occured while uploading your file!&alertType=danger");
		}
		
		$finalLocation = "";


		if($action!==""){

			$finalLocation = $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER;
			//echo $finalLocation;

			if(!empty($_FILES['file'])){

		        $file = $_FILES['file'];
		        //print_r($file);
			    $tempfile = $_FILES['file']['tmp_name'];
			    $filename = $_FILES['file']['name'];
			    $filesize = $_FILES['file']['size'];
			    $filetype = $_FILES['file']['type'];
			    $error = $_FILES['file']['error'];
			    $fileext = explode(".",$filename);
			    $extension = strtolower(end($fileext));


		        if($action==="file"){
		        	$fileAllowed = array('pdf');
		        }else if($action==="cover"){
		        	$fileAllowed = array('jpg', 'png', 'jpeg');
		        }else{
		        	header("Location: ../?book=" . $book_id . "&msg=Invalid file submitted!&alertType=danger");
		        }

		        	
		        

		        if(in_array($extension, $fileAllowed)){
		            if($error===0){
		            	
		            	$size = 0;

		            	if($action==="file"){
		            		$size = FILE_UPLOAD_SIZE;
		            	}else if($action==="cover"){
		            		$size = COVER_UPLOAD_SIZE;
		            	}else{
		            		echo "something happend in file";
		            		//header("Location: ../?book=" . $book_id . "&msg=Error occured while uploading your file!&alertType=danger");
		            	}




		                //2MB Allowed
		                if($filesize<$size){
		                    $newfile = uniqid('',true) . "." . $extension;

		                    $dbloc = "";

		                    if($action==="file"){
			            		$dbloc = "book/" . $row['aut_type'] . "/". $row['year'] . "/";
			            	}else if($action==="cover"){
			            		$dbloc = "research/" . $row['year'] . "/" . $row['aut_type'] . "/cover/";
			            	}else{
			            		echo "ggggggg";
			            		//header("Location: ../?book=" . $book_id . "&msg=Error occured while uploading your file!&alertType=danger");
			            	}

		                    
		                    $finalLocation .= $dbloc; 
		                   

		                    if(!checkPath($finalLocation)){
		                    	mkdir($finalLocation,  0777, true);
		                    }

	                   		if($action==="cover"){
	                   			$destination_img = 'destination.jpg';
	                   			$d = compress($tempfile, $tempfile, 40);
	                   		}
		                    	

							
								//print_r($d);
		                     
		                    if(move_uploaded_file($tempfile, $finalLocation . $newfile)){
		                      $final = $dbloc . $newfile;

		                      if($action==="file"){
		                      	 $stmt = $con->prepare("UPDATE `book` SET `docloc` = ? WHERE `book`.`book_id` = ?");
		                      	}else if($action==="cover"){
		                      		$stmt = $con->prepare("UPDATE `book` SET `cover` = ? WHERE `book`.`book_id` = ?");
		                      	}
		                      
		                       $stmt->bind_param("si", $final, $book_id);
		                       
		                       if($stmt->execute()){
		                       	$remove = $finalLocation . $oldFile;
		                       	if(!unlink($remove)){}
		                       	//echo $finalLocation . $oldFile;
		                       		header("Location: ../?book=" . $book_id . "&msg=Success! you Updated your Research.&alertType=success");
		                       }

		                    } else{
		                    	echo "Error";
		                    }
		                    
		                }else{
		                	header("Location: ../?book=" . $book_id . "&msg=Error! You Exceeded to the maximum size!&alertType=danger");
		                }
		            }else{
		            	header("Location: ../?book=" . $book_id . "&msg=Error! There was an error Uploading your Cover!&alertType=danger");
		            }
			    }else{
			        header("Location: ../?book=" . $book_id . "&msg=Error! The file you uploaded is not valid!&alertType=danger");
			    }
		    }else{
		         $fileLoc = "cover/default-book-cover.png";
		    }

		}else{
			header("Location: ../?book=" . $book_id . "&msg=yyyyThe Research you are refering to is not available!<br> It may happen that one of the author or the Administrator remove your Research. Please Contact the administrator.&alertType=danger");
		}
	    
	}else{
		header("Location: ../?book=" . $book_id . "&msg=zzzzzThe Research you are refering to is not available!<br> It may happen that one of the author or the Administrator remove your Research. Please Contact the administrator.&alertType=danger");
	}

 
function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}



	/** 
 * recursively create a long directory path
 */
function checkPath($path) {
	//echo $path;
    if (is_dir($path)){
    	//echo "Dir excist";
    	return true;	
    } else{
    	return false;
    }
    
}
	
?>