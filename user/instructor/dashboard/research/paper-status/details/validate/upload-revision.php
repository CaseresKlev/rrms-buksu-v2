<?php
	session_start();
	print_r($_SESSION);
	//exit();
	if(!empty($_FILES['file']) && isset($_SESSION['uid']) && isset($_POST['trailID'])){
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  		include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
  		$dbconfig = new dbconfig();
    	$con = $dbconfig ->getCon();

		$file = $_FILES['file'];
		//print_r($file);
		$tempfile = $_FILES['file']['tmp_name'];
        $filename = $_FILES['file']['name'];
        $filesize = $_FILES['file']['size'];
        $filetype = $_FILES['file']['type'];
        $error = $_FILES['file']['error'];
        $fileext = explode(".",$filename);
        $extension = strtolower(end($fileext));

        $fileAllowed = array('pdf');


        $finalLocation = $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER;


        $stmt = $con->prepare("SELECT `id`, `book_id`, `p_sat_id`, `file_loc`, `requirements`, `isdone`, YEAR(date) as 'year' FROM `paper_trail` WHERE `id` = ?");
        $stmt->bind_param("i", $_POST['trailID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        //print_r($row);
        $year = $row['year'];
        $origFile = $row['file_loc'];
        echo $origFile;
        //exit();
        

        if(in_array($extension, $fileAllowed)){
          $size = FILE_UPLOAD_SIZE;
          ///echo "Size: " . $size;
          if($filesize<$size){
            
            $newfile = uniqid('',true) . "." . $extension;
            $dbloc = "revisions/" . $year . "/". $_SESSION['alias'] . "/";
            $finalLocation .= $dbloc; 

            if(!checkPath($finalLocation)){
              mkdir($finalLocation,  0777, true);
            }


            if(move_uploaded_file($tempfile, $finalLocation . $newfile)){
              $final = $dbloc . $newfile;

              
              $stmt= $con->prepare("UPDATE `paper_trail` SET `file_loc` = ?, `file_alias` = ?, `requirements` = '1' WHERE `paper_trail`.`id` = ?");
              
              $stmt->bind_param("ssi", $final, $filename, $_POST['trailID']);
               
               if($stmt->execute()){
                //$remove = $finalLocation . $oldFile;
                //if(!unlink($remove)){}
                  //echo $finalLocation . $oldFile;
                  //header("Location: ../?book=" . $book_id . "&msg=Success! you Updated your Research.&alertType=success");
                //echo "Success updating book";
               }else{
                $error = $error + 1;
                $errorMsg .= "Something went wrong while uploading your file. em> Caused by: We do not received the document.</em>";
               }
               

            
               echo "<h1>Uploaded</h1>";
               if($origFile!==""){
               	$deleteFile = PROJECT_ROOT_NOT_LINK . $origFile;
               	echo $deleteFile;
               	unlink($deleteFile);
               }

               $stmt=$con->prepare("INSERT INTO `documents` (`id`, `book_id`, `documents`, `orig_name`, `submitted_by`, `description`) VALUES (NULL, ?, ?, ?, ?, ?)");
               $description = "Submitted for Paper Revision";
               $stmt->bind_param("issss", $row['book_id'], $final, $filename, $_SESSION['gname'], $description);
               $stmt->execute();

           	} else{
              $error = $error + 1;
              $errorMsg .= "Something went wrong while uploading your file. em> Caused by: We cannot move your file.</em>";
            }




          }else{
            $error = $error + 1;
            $errorMsg .= "File exceeds the maximum file size limit. You can upload valid cover just click \"Change File Button\"";
          }
        }

	}



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