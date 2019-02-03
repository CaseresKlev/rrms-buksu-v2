<?php
	
	session_start();
	//print_r($_SESSION);
	if(isset($_SESSION['uid'])){
		$error = false;
		$msg = "";
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include PROJECT_ROOT_NOT_LINK . "includes/connection.php";
		$dbconfig = new dbconfig();
  		$con = $dbconfig->getCon();
		//echo "Hellow";
		if(isset($_POST)){
			//print_r($_POST);
			$query = "SELECT COUNT(`id`) as count FROM `account` WHERE id = ? and `password` COLLATE latin1_general_cs like ?";
			$stmt = $con->prepare($query);
			$stmt->bind_param('is', $_SESSION['uid'], $_POST['curpass']);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();
				if($row['count']>0){
					$stmt = $con->prepare("UPDATE `account` SET `password` = ? WHERE `account`.`id` = ?");
					$stmt->bind_param("si", $_POST['matchpass'], $_SESSION['uid']);
					if($stmt->execute()){
						$msg = "Success! Your password was updated!<br>For security, try to <a class='badge badge-warning' href='". PROJECT_ROOT ."login.php'>Relogin</a>";
					}else{
						$error = true;
						$msg = "Failed to update your password. We will fix it soon!";
					}
				}else{
					$error = true;
					$msg = "The password didnt match!";
				}

			}else{
				$error = true;
				$msg = "Error executing command!";
			}
		}

		$con->close();
		$alertType = "";
		if($error){
			$alertType = "danger";
		}else{
			$alertType = "success";
		}
		header("Location: ../?msg=" . $msg . "&alertType=" . $alertType);
		exit();
	}else{
		header("Location: " . "/../rrms-buksu/404.php");
	}

?>