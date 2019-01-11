<?php
	
	session_start();
	if(isset($_SESSION['uid'])){
		//echo $_SESSION['owner'];
		if($_POST){

			include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
			include (PROJECT_ROOT_NOT_LINK . "includes/connection.php");
			$dbconfig = new dbconfig();
			$con = $dbconfig->getCon();

			//echo "action: " . $_POST['action'] . " on: " . $_POST['param'];
			if($_POST['action']==="cancel"){
				$stmt = $con->prepare("DELETE FROM `on_update_author` WHERE `on_update_author`.`id` = ?");
				$stmt->bind_param("i", $_POST['param']);
				if($stmt->execute()){
					echo "success:";
				}else{
					echo "error:Something went wrong to your request";
				}
			}

			$con->close();
		}else{
			echo "No post detected";
		}
	}else{
		echo "you must login first";
	}


?>