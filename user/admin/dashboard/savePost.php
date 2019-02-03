<?php


session_start();




include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
include PROJECT_ROOT_NOT_LINK . "includes/connection.php";
//print_r($_SESSION);
if(isset($_SESSION['uid']) && $_SESSION['type']==="admin" && !empty(isset($_POST['PostTitle']))){

	$dbconfig = new dbconfig();
  	$con = $dbconfig->getCon();
  	//print_r($_POST);


  	$featured = 0;
  	$cover = "";
  	$user = ucwords($_SESSION['type']);
    $title = "";
    $html = "";
    $onEdit = false;
    $OrigCover = "";
    $post_id = "";
    if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
      //echo "EDIT DETECTED";
      echo "gggg-" . $_POST['post_id'];
      $stmt = $con->prepare("SELECT * FROM `post` WHERE `id` = ?");
      $stmt->bind_param("i", $_POST['post_id']);
      $stmt->execute();
      $res = $stmt->get_result();
      $post = $res->fetch_assoc();
      $OrigCover = $post['cover'];
      $post_id = $post['id'];
      $onEdit = true;
    }


  	if(!empty($_POST['featured'])){
  		  $file = $_FILES['feauturedCover'];
              //print_r($file);
        $tempfile = $_FILES['feauturedCover']['tmp_name'];
        $filename = $_FILES['feauturedCover']['name'];
        $filesize = $_FILES['feauturedCover']['size'];
        $filetype = $_FILES['feauturedCover']['type'];
        $error = $_FILES['feauturedCover']['error'];
        $fileext = explode(".",$filename);
        $extension = strtolower(end($fileext));

        $fileAllowed = array('jpg', 'png', 'jpeg');
        $finalLocation = $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER;
        //
        $year = date('Y');
        $size = 6000000;
        if(!in_array($extension, $fileAllowed) || $filesize>$size){
        	header("Location: banner.php?msg=<strong>Error:</strong> The Featured Cover is NOT VALID<br>Pls. submit: jpg, jpeg or png file only. Maximum file Size: 6MB.&alertType=danger");
        	exit();
        }

        $newfile = uniqid('',true) . "." . $extension;
        $dbloc = "post/Feautured_Cover/" . $year . "/";
        $finalLocation .= $dbloc;

        if(!checkPath($finalLocation)){
          mkdir($finalLocation,  0777, true);
        }

         if(!move_uploaded_file($tempfile, $finalLocation . $newfile)){
         	header("Location: banner.php?msg=<strong>Error:</strong> Unhandled Exception;<br>We are very sorry but something went wrong while uploading your file!<br>Reference: [CANNOT_MOVE_FILE] &alertType=danger");
         	exit();
         }

         $cover = $dbloc . $newfile;
         $featured = 1;
        echo $cover;
        //exit();
  	}
    //echo "vvvv-" . $onEdit;
    //exit();
  if(!$onEdit){
    $query = "INSERT INTO `post` (`id`, `post_tittle`, `post_body`, `post_date`, `post_user`, `feautured`, `cover`, `location`) VALUES (NULL, ?, ?, CURRENT_TIMESTAMP, ?, ?, ?, 'post/')";

    $stmt = $con->prepare($query);
    $stmt->bind_param("sssis", $_POST['PostTitle'], $_POST['html'], $user, $featured, $cover);
    if($stmt->execute()){
      header("Location: banner.php?msg=Post was published!");
    }
  }else{
    $query = "UPDATE `post` SET `post_tittle` = ?, `post_body` = ?, `feautured` = ?, `cover` = ? WHERE `post`.`id` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssisi", $_POST['PostTitle'], $_POST['html'], $featured, $cover, $post_id);
    //print_r($stmt);
    //echo "PostID: " . $post_id;
    //exit();
    if($stmt->execute()){
      header("Location: banner.php?msg=Post was Updated!");
    }

    if($OrigCover!==""){
      unlink(PROJECT_ROOT_NOT_LINK . $OrigCover);
    }


  }
	
	

}else{
	header("Location: " . PROJECT_ROOT);
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