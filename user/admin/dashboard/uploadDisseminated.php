<?php
date_default_timezone_set("Asia/Manila");

//print_r($_POST);
//print_r($_FILES);
//exit();

if(isset($_POST['dis-type']) && isset($_GET['action'])){
        session_start();
        $action = $_GET['action'];
        //echo "$action";
        $error = 0;
        $error2 = 0;
		$distype = $_POST['dis-type'];
		$discon = $_POST['dis-con'];
		$conven = $_POST['con-ven'];
		$disdate = $_POST['disdate'];
		
		$book_id = $_POST['book_id'];

        //echo "$distype $discon $conven $ disdate $ book_id";
		//print_r($files);
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
        $finalLocation = $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER;
        if(isset($_FILES['myFile'])){

            $files = $_FILES['myFile'];
            $count = count($_FILES['myFile']['tmp_name']);
            //echo "$count";
            
            for($i=0;$i<$count;$i++) {
                $file_name = $_FILES['myFile']['name'][$i];
                //echo "$file_name";
                //exit();
                $fileTemp = $_FILES['myFile']['tmp_name'][$i];
                $file_type = $_FILES['myFile']['type'][$i];
                $file_error = $_FILES['myFile']['error'][$i];
                $file_size = $_FILES['myFile']['size'][$i];


                $fileext = explode(".",$file_name);
                $extension = strtolower(end($fileext));
                $finalname = uniqid('',true) . "." . $extension;
                $aut_type = "admin";
                //$replaced = str_replace(" ","-",$discon);
                $replaced = preg_replace("/[^a-zA-Z]/", "-", $discon);
                //echo "$replaced";
                $dbloc = "revisions/" . $aut_type . "/". date('Y') . "/" . $replaced . "/";
                $finalLocation .= $dbloc;
                //echo $finalLocation;
                
                if(!checkPath($finalLocation)){
                  mkdir($finalLocation,  0777, true);
                }
                //echo $finalLocation . $finalname;
                //exit();
                if(move_uploaded_file($fileTemp, $finalLocation . $finalname)){

                    include_once 'connection.php';
                    $dbconfig = new dbconfig();
                    $conn = $dbconfig->getCon();
                    //$query = "INSERT INTO `documents` (`id`, `book_id`, `documents`, `orig_name`) VALUES (NULL, '$book_id', '$finalname', '$file_name')";
                    $query = "INSERT INTO `documents` (`id`, `book_id`, `documents`, `orig_name`, `submitted_by`, `description`, `date`) VALUES (NULL, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
                    $desc = "Supporting document for Dessimination.";
                    $stmt = $conn->prepare($query);
                    $linkFile = $dbloc . $finalname;
                    $stmt->bind_param("issss", $book_id, $linkFile, $file_name, $aut_type, $desc);
                    $stmt->execute();
                    //echo $query;
                    //$result = $conn->query($query);
                    $result = $stmt->get_result();
                    

                      //echo "Upload Done";
                }

                //echo "File: " . $i . ": " . $finalname ;
            }
        }

        if($action==="save"){
            include_once 'connection.php';
            $datenow = date('Y-m-d H:i:s');
            $dbconfig = new dbconfig();
            $conn = $dbconfig->getCon();
            $query = "INSERT INTO `bookhistory` (`id`, `book_id`, `book_stat`, `date`) VALUES (NULL, '$book_id', 'Disseminated', '$datenow')";
            $result55 = $conn->query($query);
            if($result55){
                $datenow = date('Y-m-d H:i:s');
                $dbconfig = new dbconfig();
                $conn = $dbconfig->getCon();
                $query = "SELECT * FROM `bookhistory` WHERE `book_id` = $book_id and `date` = '$datenow'";
                $result56 = $conn->query($query);
                if($result56->num_rows>0){
                    $row56 = $result56->fetch_assoc();
                    $history = $row56['id'];
                    $dbconfig = new dbconfig();
                    $conn = $dbconfig->getCon();
                    $query = "INSERT INTO `disseminated` (`id`, `book_id`, `type`, `convension`, `location`, `history`, `date`) VALUES (NULL, '$book_id', '$distype', '$discon', '$conven', '$history', '$disdate')";
                    $result57 = $conn->query($query);
                    //echo $query;
                    if($result57){
                        echo "Success!";
                    }else{
                        echo "Error: " . mysql_error();
                    }
                }
            }
        
            
        if($error ===0){
        }else{
            echo "There is Error uploading your Files";
        }
    }else{
            include_once 'connection.php';
            $datenow = date('Y-m-d H:i:s');
            $dbconfig = new dbconfig();
            $conn = $dbconfig->getCon();
            $dis_id = $_GET['dis_id'];
            //echo "$dis_id";
            $query = "UPDATE `disseminated` SET `type` = '$distype', `convension` = '$discon', `location` = '$conven', `date` = '$disdate' WHERE `disseminated`.`id` = $dis_id";
            //echo $query;
            $result55 = $conn->query($query);
            if($result55){
                echo "Update Successfull!";
            }else{
                echo "Error: " .mysql_error();
            }
        
            
        if($error ===0){
        }else{
            echo "There is Error uploading your Files";
        }
    }
            
		

        

		
}


if(isset($_POST['dis_id'])){
    $dis_id = $_POST['dis_id'];
   //echo "$dis_id";
   include_once 'connection.php';
   $dbconfig = new dbconfig();
    $conn = $dbconfig->getCon();
    $query = "SELECT `history` FROM `disseminated` WHERE `id` = $dis_id";

    $result = $conn->query($query);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $history = $row['history'];


        $conn = $dbconfig->getCon();
        $query = "DELETE FROM `disseminated` WHERE `disseminated`.`id` = $dis_id";
        $result22 = $conn->query($query);
        if($result22){
            $conn = $dbconfig->getCon();
            $query = "DELETE FROM `bookhistory` WHERE `bookhistory`.`id` = $history";
            $result23 = $conn->query($query);
            if($result23){
                echo "Deleted.";
            }else{
                echo "Error: " . mysql_error();
            }
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