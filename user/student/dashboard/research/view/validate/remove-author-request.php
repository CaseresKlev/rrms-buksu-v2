<?php
	session_start();
	//echo $_POST['request_id'];
	if(isset($_SESSION['uid']) ){
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include (PROJECT_ROOT_NOT_LINK . "includes/connection.php");
		$dbconfig = new dbconfig();
		$con = $dbconfig->getCon();
		$feed = (object)[];
		$feed->status="";
		//echo $_POST['request_id'];
		$stmt = $con->prepare("DELETE FROM `on_update_author` WHERE `on_update_author`.`id` = ?");
		$stmt->bind_param("i", $_POST['request_id']);
		if($stmt->execute()){
			$feed->status="success";
		}else{
			$feed->status="error";
		}

		echo json_encode($feed);
	}

?>