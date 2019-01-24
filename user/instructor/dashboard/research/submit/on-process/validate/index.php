<?php 


session_start();
//print_r($_SESSION);
if(isset($_SESSION['uid']) && $_SESSION['type'] === "INSTRUCTOR"){
	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  	include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';

  	$dbconfig = new dbconfig();
	$con = $dbconfig ->getCon();
  	$query = "INSERT INTO `book` (`book_id`, `book_title`, `abstract`, `pub_date`, `department`, `keywords`, `refrences`, `rev_count`, `status`, `enabled`, `views_count`, `cited`, `cover`, `docloc`, `link`, `aut_type`, `dowloadable`, `refkey`) VALUES (NULL, ? , '', CURRENT_TIMESTAMP, ?, '', '', '0', ?, '0', '0', '0', '', '', '', ?, '0', '')";
  	$stmt = $con->prepare($query);
  	print_r($_POST);
  	$type = strtolower($_SESSION['type']);
  	$stmt->bind_param("siss", $_POST['title'], $_POST['department'], $_POST['status'], $type);
  	if(!$stmt->execute()){
  		$errorno = $stmt->errno;
  		if($errorno == 1062){
  			header("Location: ../?msg=Error! Duplicate title detected.<br>Your research title already existed. Try to see your research list if this research existed. If not, and you are sure that this is your research. Please contact the Research Unit.&alertType=danger");
  		}else{
  			header("Location: ../?msg=Were are so Sorry. <br>But Something Went wrong to your request. We will fix it soon.&alertType=danger");
  		}
  		exit();
  		
  		//exit();
  	}

  	//print_r($stmt);
  	$insertedID = $stmt->insert_id;
  	$authorAr = $_POST['author'];

  	foreach ($authorAr as $author) {
  		$stmt = $con->prepare("INSERT INTO `junc_authorbook` (`id`, `book_id`, `aut_id`) VALUES (NULL, ?, ?)");
  		$stmt->bind_param("ii", $insertedID, $author);
  		if(!$stmt->execute()){
  			$errorno = $stmt->errno;
  			if($errorno != 1062){
  				header("Location: ../?msg=Were are so Sorry. <br>But Something Went wrong to your request. We will fix it soon.&alertType=danger");
  			}
  		}
  	}

  	$stmt = $con->prepare("INSERT INTO `bookhistory` (`id`, `book_id`, `book_stat`, `date`) VALUES (NULL, ?, ?, CURRENT_TIMESTAMP)");

  	$stmt->bind_param("is", $insertedID, $_POST['status']);
  	$stmt->execute();

  	print_r($stmt);
  	
  	$stmt->prepare("INSERT INTO `paper_trail` (`id`, `book_id`, `p_sat_id`, `file_loc`, `requirements`, `isdone`, `date`) VALUES (NULL, ?, '1', '', '1', '1', CURRENT_TIMESTAMP)");
  	$stmt->bind_param("i", $insertedID);
  	$stmt->execute();
  	header("Location: " . PROJECT_ROOT . "/user/instructor/dashboard/research/?msg=Success! You have added your new research.&alertType=danger");
}
//print_r($_POST);
//$authorAr = $_POST['author'];
//print_r($authorAr);


 ?>