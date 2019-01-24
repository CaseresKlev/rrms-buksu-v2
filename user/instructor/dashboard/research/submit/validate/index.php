<?php
	session_start();
  //print_r($_SESSION);
	//print_r($_SESSION);
  	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  	include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';

  	if(isset($_SESSION['uid'])){
      
  		if(isset($_POST)){
      $usrType = "";  
  			//print_r($_POST);
  			//$query = "INSERT INTO `book` (`book_id`, `book_title`, `abstract`, `pub_date`, `department`, `keywords`, `refrences`, `rev_count`, `status`, `enabled`, `views_count`, `cited`, `cover`, `docloc`, `link`, `aut_type`, `dowloadable`, `refkey`) VALUES (NULL, 'title', 'abstract', CURRENT_DATE, '1', 'keywords', 'ref', '0', '1', '1', '0', '0', '', '', '', '', '1', '')";

			$dbconfig = new dbconfig();
  		$con = $dbconfig ->getCon();
  		//$stmt = $con->prepare($query);
  		$isDownload = 0;
  		if(isset($_POST['isDownload'])){
  			$isDownload = 1;
  		}

    	$loc =  str_replace(':', '-', $_POST['title']);
			$loc =  str_replace('/', '-', $loc);
			$loc =  str_replace(' ', '-', $loc);
			$loc =  str_replace(';', '-', $loc);
			$loc =  str_replace('\\', '-', $loc);
			$loc =  str_replace('|', '-', $loc);
			$loc =  str_replace('[', '-', $loc);
			$loc =  str_replace(']', '-', $loc);
      //echo $loc;
      
      $book_id = $_POST['bookID'];
      //echo $book_id;
     // print_r($_POST);

      $isDownload = 0;
      if($_POST['isDownload']==="on"){
        $isDownload = 1;
      }

      //echo $isDownload;
      //exit();
      $query = "UPDATE `book` SET `abstract` = ?, `keywords` = ?, `refrences` = ?, `enabled` = '1', `link` = ?, `dowloadable` = ?, `aut_type` = ? WHERE `book`.`book_id` = ?";

      $aut_type = strtolower($_SESSION['type']);
      $stmt = $con->prepare($query);
      $stmt->bind_param("ssssisi", $_POST['abstract'], $_POST['keywords'], $_POST['references'], $loc, $isDownload, $aut_type, $book_id);
      if(!$stmt->execute()){
        header("Location: ../?msg=Something went wrong to your request. Be sure you filled out the form correctly.&alertType=danger");
        exit();
      }

      $file2write = '<?php    
                include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/page_template/research/entry.php");

              ?>';    
      $aut_type = "";
      $year = "";

      $result = $con->query("SELECT YEAR(`pub_date`) as year, `aut_type`, `link`  FROM `book` WHERE book_id = " . $book_id);
            $filePath = "";
      if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $filePath.= $_SERVER['DOCUMENT_ROOT'] . "/rrms-buksu/research/". $row['year'] . "/" . $row['aut_type'] . "/" . $row['link'] . "/index.php";
        $aut_type = $row['aut_type'];
        $usrType = $aut_type;
        $year =  $row['year'];
        //echo $filePath;
        file_force_contents($filePath, $file2write);
      } else{
        echo '<h3>We are sorry. Something went wrong. Go <a href="/../">home</a></h3> <em> Caused by: Submiting your Document.</em>';
      }
      if(isset($_FILES['cover']) && $_FILES['cover']['name']!==""){
              $file = $_FILES['cover'];
                //print_r($file);
              $tempfile = $_FILES['cover']['tmp_name'];
              $filename = $_FILES['cover']['name'];
              $filesize = $_FILES['cover']['size'];
              $filetype = $_FILES['cover']['type'];
              $error = $_FILES['cover']['error'];
              $fileext = explode(".",$filename);
              $extension = strtolower(end($fileext));

              $fileAllowed = array('jpg', 'png', 'jpeg');

              $finalLocation = $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER;
              $coverLoc = "";
             
              if(in_array($extension, $fileAllowed)){
                $size = COVER_UPLOAD_SIZE;

                 if($filesize<$size){
                  $newfile = uniqid('',true) . "." . $extension;
                  $dbloc = "research/" . $year . "/" . $aut_type . "/cover/";
                  $finalLocation .= $dbloc; 

                  if(!checkPath($finalLocation)){
                    mkdir($finalLocation,  0777, true);
                  }

                  $destination_img = 'destination.jpg';
                  $d = compress($tempfile, $tempfile, 40);

                  if(move_uploaded_file($tempfile, $finalLocation . $newfile)){
                    $coverLoc = $dbloc . $newfile;
                     

                  } else{
                    $error = $error + 1;
                    $errorMsg .= "Something went wrong while uploading your Cover. em> Caused by: Unable to upload your cover.</em>";
                  }



                 }else{
                  $error = $error + 1;
                  $errorMsg .= " Cover size is bigger than 2MB.";
                 }
              }else{
                $error = $error + 1;
                $errorMsg .= " Cover is not valid. We load the default cover you can upload valid cover just click \"Change Cover Button\" on the deatils of this research."; 
              }

            }else{
              $coverLoc = "default/cover/df-cover.png";
            }

            $fileAlias = "";
            
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

            $fileAllowed = array('pdf');
            
            $fileAlias = $filename;

            $finalLocation = $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER;
              if(in_array($extension, $fileAllowed)){
                $size = FILE_UPLOAD_SIZE;
                ///echo "Size: " . $size;
                if($filesize<$size){
                  
                  $newfile = uniqid('',true) . "." . $extension;
                  $dbloc = "book/" . $aut_type . "/". $year . "/";
                  $finalLocation .= $dbloc; 

                  if(!checkPath($finalLocation)){
                    mkdir($finalLocation,  0777, true);
                  }


                  if(move_uploaded_file($tempfile, $finalLocation . $newfile)){
                    $final = $dbloc . $newfile;

                  } else{
                    $error = $error + 1;
                    $errorMsg .= "Something went wrong while uploading your file. em> Caused by: We cannot move your file</em>";
                  }




                }else{
                  $error = $error + 1;
                  $errorMsg .= "File exceeds the maximum file size limit. You can upload valid cover just click \"Change File Button\"";
                }
              }else{
                $error = $error + 1;
                $errorMsg .= "File is not valid. You can upload valid cover just click \"Change File Button\"";
              }
            }
          
          $stmt = $con->prepare("UPDATE `book` SET `cover` =  ?, `docloc` = ? WHERE `book`.`book_id` = ?");
          $stmt->bind_param("ssi", $coverLoc, $final, $book_id);
          if(!$stmt->execute()){
            $errorMsg .= "The file was invalid. You can change the file anytime";
          }

          if($error<1){
            $errorMsg = "Success! You have have completed your research.";
          }

          $stmt = $con->prepare("UPDATE `paper_trail` SET `file_loc` = ?, `file_alias` = ?, `requirements` = '1' WHERE `paper_trail`.`id` = ?");
          $stmt->bind_param("ssi", $final, $fileAlias, $_POST['trailID']);
          $stmt->execute();
          
          $stmt = $con->prepare("INSERT INTO `bookhistory` (`id`, `book_id`, `book_stat`, `date`) VALUES (NULL, ?, ?, CURRENT_TIMESTAMP)");
          $stemp = "Completed";
          $stmt->bind_param("is", $book_id, $stemp);
          $stmt->execute();
          header("Location: " . PROJECT_ROOT . "user/" . $aut_type . "/dashboard/research/view/?book=" . $book_id . "&msg=" . $errorMsg);



        exit();
    		
    		if($stmt->execute()){
    			$book_id = mysqli_insert_id($con);
          $bh = "Unpublished";
          $stmt = $con->prepare("INSERT INTO `bookhistory` (`id`, `book_id`, `book_stat`) VALUES (NULL, ?, ?)");
          $stmt->bind_param("is", $book_id, $bh);
          if($stmt->execute()){
              $historyID = mysqli_insert_id($con);
              //echo "historyID: " . $historyID;
              if($_POST['status']==="Utilized"){
                $stmt = $con->prepare("INSERT INTO `utilize` (`id`, `book_id`, `orgname`, `orgaddress`, `date`, `history`) VALUES (NULL, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssi", $book_id, $_POST['util-org-name'], $_POST['util-org-address'], $_POST['util-org-date'], $historyID);
                if($stmt->execute()){
                  $utilword = "Utilized";
                  $stmt = $con->prepare("INSERT INTO `bookhistory` (`id`, `book_id`, `book_stat`) VALUES (NULL, ?, ?)");
                  $stmt->bind_param("is", $book_id, $utilword);
                  $stmt->execute();
                }
              }
          }
          
          $query = "INSERT INTO `junc_authorbook` (`id`, `book_id`, `aut_id`) VALUES (NULL, '". $book_id ."', '". $_SESSION['owner'] ."')";
          $res = $con->query($query);
          echo $query;
          echo "Result: " + $res;
          if($res){

            $file2write = '<?php    
                include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/page_template/research/entry.php");

              ?>';    
            $aut_type = "";
            $year = "";
            

            $result = $con->query("SELECT YEAR(`pub_date`) as year, `aut_type`, `link`  FROM `book` WHERE book_id = " . $book_id);
            $filePath = "";
            if($result->num_rows>0){
              $row = $result->fetch_assoc();
              $filePath.= $_SERVER['DOCUMENT_ROOT'] . "/rrms-buksu/research/". $row['year'] . "/" . $row['aut_type'] . "/" . $row['link'] . "/index.php";
              $aut_type = $row['aut_type'];
              $year =  $row['year'];
              //echo $filePath;
              file_force_contents($filePath, $file2write);
            } else{
              echo '<h3>We are sorry. Something went wrong. Go <a href="/../">home</a></h3> <em> Caused by: Submiting your Document.</em>';
            }

            $error = 0;
            $errorMsg = "";

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

            $fileAllowed = array('pdf');
            


            $finalLocation = $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER;
            if(in_array($extension, $fileAllowed)){
              $size = FILE_UPLOAD_SIZE;
              ///echo "Size: " . $size;
              if($filesize<$size){
                
                $newfile = uniqid('',true) . "." . $extension;
                $dbloc = "book/" . $aut_type . "/". $year . "/";
                $finalLocation .= $dbloc; 

                if(!checkPath($finalLocation)){
                  mkdir($finalLocation,  0777, true);
                }


                if(move_uploaded_file($tempfile, $finalLocation . $newfile)){
                  $final = $dbloc . $newfile;

                  
                  $stmt= $con->prepare("UPDATE `book` SET `docloc` = ? WHERE `book`.`book_id` = ?");
                  
                  $stmt->bind_param("si", $final, $book_id);
                   
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
                   

                } else{
                  $error = $error + 1;
                  $errorMsg .= "Something went wrong while uploading your file. em> Caused by: We cannot move your file</em>";
                }




              }else{
                $error = $error + 1;
                $errorMsg .= "File exceeds the maximum file size limit. You can upload valid cover just click \"Change File Button\"";
              }
            }else{
              $error = $error + 1;
              $errorMsg .= "File is not valid. You can upload valid cover just click \"Change Cover Button\"";
            }

            if(isset($_FILES['cover']) && $_FILES['cover']['name']!==""){
              $file = $_FILES['cover'];
                print_r($file);
              $tempfile = $_FILES['cover']['tmp_name'];
              $filename = $_FILES['cover']['name'];
              $filesize = $_FILES['cover']['size'];
              $filetype = $_FILES['cover']['type'];
              $error = $_FILES['cover']['error'];
              $fileext = explode(".",$filename);
              $extension = strtolower(end($fileext));

              $fileAllowed = array('jpg', 'png', 'jpeg');

              $finalLocation = $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER;

              echo "Exntension: " . $extension;
              if(in_array($extension, $fileAllowed)){
                $size = COVER_UPLOAD_SIZE;

                 if($filesize<$size){
                  $newfile = uniqid('',true) . "." . $extension;
                  $dbloc = "research/" . $year . "/" . $aut_type . "/cover/";
                  $finalLocation .= $dbloc; 

                  if(!checkPath($finalLocation)){
                    mkdir($finalLocation,  0777, true);
                  }

                  $destination_img = 'destination.jpg';
                  $d = compress($tempfile, $tempfile, 40);

                  if(move_uploaded_file($tempfile, $finalLocation . $newfile)){
                    $final = $dbloc . $newfile;

                    
                    $stmt = $con->prepare("UPDATE `book` SET `cover` = ? WHERE `book`.`book_id` = ?");
                    
                    $stmt->bind_param("si", $final, $book_id);
                     
                     if($stmt->execute()){
                      //$remove = $finalLocation . $oldFile;
                      //if(!unlink($remove)){}
                        //echo $finalLocation . $oldFile;
                        //header("Location: ../?book=" . $book_id . "&msg=Success! you Updated your Research.&alertType=success");
                      //echo "Success updating book";
                     }else{
                      $error = $error + 1;
                      $errorMsg .= "Something went wrong while uploading your Cover. em> Caused by: Updating Cover location.</em> $book_id: $final";
                     }
                     

                  } else{
                    $error = $error + 1;
                    $errorMsg .= "Something went wrong while uploading your Cover. em> Caused by: Unable to upload your cover.</em>";
                  }



                 }else{
                  $error = $error + 1;
                  $errorMsg .= " Cover size is bigger than 2MB.";
                 }
              }else{
                $error = $error + 1;
                $errorMsg .= " Cover is not valid. You can upload valid cover just click \"Change Cover Button\""; 
              }

            }else{

              $stmt = $con->prepare("UPDATE `book` SET `cover` = ? WHERE `book`.`book_id` = ?");
               $df_cover = "default/cover/df-cover.png";
              $stmt->bind_param("si", $df_cover , $book_id);
               
               if($stmt->execute()){
                //$remove = $finalLocation . $oldFile;
                //if(!unlink($remove)){}
                  //echo $finalLocation . $oldFile;
                  //header("Location: ../?book=" . $book_id . "&msg=Success! you Updated your Research.&alertType=success");
                //echo "Success updating book";
               }else{
                $error = $error + 1;
                $errorMsg .= "Something went wrong while uploading your Cover. Caused by: Updating Cover location 2.</em>";
               }
            }

            if($error>0){

              header("Location: " . PROJECT_ROOT . "user/" . strtolower($_SESSION['type']) . "/dashboard/research/view/?book=" . $book_id . "&msg=" . $errorMsg . "&alertType=danger" );

              //echo '<h3 class="p5">We have added your research but were not able to accept your file or cover since it is <em class="bg-danger">NOT VALID</em>. You can submit your valid file or cover <a href="'. PROJECT_ROOT . 'user/' . strtolower($_SESSION['type']) . '/dashboard/research/view/?book=' . $book_id .'">Here</h3>';
            }else{
              header("Location: " . PROJECT_ROOT . "user/" . strtolower($_SESSION['type']) . "/dashboard/research/view/?book=" . $book_id . "&msg=Congratulations! You had added a new research.<br>You can add another author to your research, just send them a request." . "&alertType=success" );
            }


          }




            
            //header("Location: " . PROJECT_ROOT . "user/" . strtolower($_SESSION['type']) . "/dashboard/research/view/?book=" . $book_id . "&msg=Congratulations! You had added a new research.<br>You can add another author to your research, just send them a request.&alertType=success");
          }else{
            $res = $con->query("DELETE FROM `book` WHERE `book`.`book_id` = " . $book_id);
            echo '<h3>We are sorry. Something went wrong. Go <a href="../">back</a></h3>Caused by: Updating Cover location. Book: ' . $book_id . '</em>';
          }

    			$con->close();
    		}else{
    			header("Location: ../?msg=Error: Duplicated research Title.<br>The research you are try to add already existed.&alertType=danger");
    		}
  		}
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


    function checkPath($path) {
  //echo $path;
      if (is_dir($path)){
        //echo "Dir excist";
        return true;  
      } else{
        return false;
      }
    
    }

    function checkFile($path) {
  //echo $path;
      if (is_file($path)){
        //echo "Dir excist";
        return true;  
      } else{
        return false;
      }
    
    }

    function file_force_contents($dir, $contents){
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        foreach($parts as $part){
            if(!is_dir($dir .= "$part/"))
               mkdir($dir);
                           
        }

        $saved_file = file_put_contents("$dir/$file", $contents);
        //echo "$dir/$file";
        if (($saved_file === false) || ($saved_file == -1)) {
          //print "Couldn't make file";
          return false;
        }else{
          return true;
        }
    }

function file_force_contents2($filename, $data, $per = 0755, $flags = 0) {
        $fn = "";
    if(substr($filename, 0, 1) === "/") $fn .= "/";
    $parts = explode("/", $filename);
        $file = array_pop($parts);
     
        foreach($parts as $part) {
            if(!is_dir($fn .= "$part")) mkdir($fn, $per, true);
        $fn .= "/";
    }

        file_put_contents($fn.$file, $data, $flags);   
}

	
?>