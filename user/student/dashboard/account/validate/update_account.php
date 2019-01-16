<?php

	session_start();

	if(isset($_SESSION)){
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include PROJECT_ROOT_NOT_LINK . "includes/connection.php";
		$dbconfig = new dbconfig();
  		$con = $dbconfig->getCon();

  		$msg = "";
  		$error = false;

		if(isset($_POST)){
			$stmt = $con->prepare("SELECT `id` FROM `acesskey` WHERE `acesskey`  COLLATE latin1_general_cs like ? and `type` = 'INSTRUCTOR'  and `used` = 0");
			$stmt->bind_param("s", $_POST['accesscodes']);
			if($stmt->execute()){
				$result = $stmt->get_result();
				//print_r($result);
				//echo $result->num_rows;
				if($result->num_rows>0){
					$accessRow = $result->fetch_assoc();

					if($accessRow['id']>0){
						$accessKeyID = $accessRow['id'];
						$stmt = $con->prepare("UPDATE `account` SET `type` = 'INSTRUCTOR' WHERE `account`.`id` = ?");
						$stmt->bind_param("i", $_SESSION['uid']);
						if($stmt->execute()){
							$stmt = $con->prepare("UPDATE `acesskey` SET `used` = '1' WHERE `acesskey`.`id` = ?");
							$stmt->bind_param("i", $accessKeyID);
							$stmt->execute();
							header("Location: /../rrms-buksu/login.php");
						}else{
							$msg = "Your access code is valid but we are not able to update your account. <br>We will fix it soon!";
							$error = true;
						}
						
						//print_r($_SESSION);

					}else{
						$msg = "The access code is not valid or expired.<br>Ask the administrator for VALID Access Code";
						$error = true;
					}
				}else{
					$msg = "The access code is not valid or expired.<br>Ask the administrator for VALID Access Code";
					$error = true;
				}
				
				
			}else{
				$msg = "Something went wrong. We Cannot Complete your request.";
				$error = true;
				echo $msg;
			}
		}else{
			header("Location: " . "/../rrms-buksu/404.php");
		}

		$alertType = "success";

		if($error==true){
			$alertType = "danger";
		}

		$con->close();

		//header("Location: ../?msg=" . $msg . "&alertType=" . $alertType);
	}else{
		header("Location: " . "/../rrms-buksu/404.php");
	}

?>