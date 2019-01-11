<?php
	session_start();
	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
	include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
  	include PROJECT_ROOT_NOT_LINK . 'server_script/crypt.php';
  	 $dbconfig = new dbconfig();
  	$con = $dbconfig ->getCon();

	if(isset($_SESSION['uid'])){
		//print_r($_POST);
		if($_POST){
			$stmt = $con->prepare("UPDATE `notification` SET `isShow` = ? WHERE `author_id` = ?");
			$stmt->bind_param("ii", $_POST['show'], $_SESSION['owner']);
			if($stmt->execute()){
				echo "Success";
			}else{
				echo "Failed";
			}
		}
	}


?>