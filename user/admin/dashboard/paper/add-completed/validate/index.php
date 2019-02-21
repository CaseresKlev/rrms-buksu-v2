<?php
	
	session_start();
	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
	if(!isset($_SESSION['uid'])){
		header("Location: " . PROJECT_ROOT . "404.php");
		exit();
	}

            
    $deptName = "Uncategorized";
    $deptID = 0;
    $title = "";
    $link = "";

    if(count($_POST)<1){
    	header("Location: " . PROJECT_ROOT . "404.php");
		exit();
    }
    //echo ;
    include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
    $dbconfig = new dbconfig();
    $con = $dbconfig ->getCon();
    
    //print_r($_POST);
    $deptID = $_POST['department'];
    $title = $_POST['title'];
    
    echo $deptID;
    
    $link = str_replace(' ', '-', $title);
    $link = preg_replace('/[^a-zA-Z0-9-]/', '', $link);
    echo " " . $title  . " " . $link;

    //exit();
    $stmt = $con->prepare("INSERT INTO `book` (`book_id`, `book_title`, `abstract`, `pub_date`, `department`, `keywords`, `refrences`, `rev_count`, `status`, `enabled`, `views_count`, `cited`, `cover`, `docloc`, `link`, `aut_type`, `dowloadable`, `refkey`) VALUES (NULL, ?, '', CURRENT_TIMESTAMP, ?, '', '', '0', 'Unpublished', '1', '0', '0', '', '', ?, 'instructor', '0', '')");
    $stmt->bind_param("sis", $title, $deptID, $link);
    $stmt->execute();
    $book_id = $stmt->insert_id;
    echo " BookID: " . $book_id;

    $file2write = '<?php    
        include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/page_template/research/entry.php");

      ?>';

    $result = $con->query("SELECT YEAR(`pub_date`) as year, `aut_type`, `link`  FROM `book` WHERE book_id = " . $book_id);
    $filePath = "";
    if($result->num_rows>0){
      $row = $result->fetch_assoc();
      $filePath.= $_SERVER['DOCUMENT_ROOT'] . "/rrms-buksu/research/". $row['year'] . "/" . $row['aut_type'] . "/" . $row['link'] . "/index.php";
      $aut_type = $row['aut_type'];
      $year =  $row['year'];
      //echo $filePath;
      if(file_force_contents($filePath, $file2write)){
      	header("Location: " . PROJECT_ROOT . "user/admin/dashboard/paper/add-completed/?msg=The Paper was added.&alertType=info&bid=" . $book_id);
      }
    } else{
      echo '<h3>We are sorry. Something went wrong. Go <a href="'. PROJECT_ROOT .'">home</a></h3> <em> Caused by: Submiting your Document.</em>';
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

            
	
	
?>