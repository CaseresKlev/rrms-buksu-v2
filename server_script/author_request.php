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
			}else if($_POST['action']==="confirm"){
				$stmt = $con->prepare("SELECT `action`, `book_id`, `author` FROM `on_update_author` WHERE `id` = ?");
				$stmt->bind_param("i", $_POST['param']);
				if($stmt->execute()){
					$result = $stmt->get_result();
					if($result->num_rows>0){
						$resRow = $result->fetch_assoc();
						if($resRow['action']==="added"){
							$result = $con->query("INSERT INTO `junc_authorbook` (`id`, `book_id`, `aut_id`) VALUES (NULL, ". $resRow['book_id'] .",". $resRow['author'] .")");
							if($result){
								$result = $con->query("DELETE FROM `on_update_author` WHERE `on_update_author`.`id` = " . $_POST['param']);
								if($result){
									echo "success:You were added as author to this research";
								}
							}else{
								echo "error:Cannot add research to the author";
							}
						}else if($resRow['action']==="remove"){
							$result = $con->query("DELETE FROM `junc_authorbook` WHERE aut_id = " . $resRow['author'] . " and " . "book_id = " . $resRow['book_id']);

							if($result){
								$result = $con->query("DELETE FROM `on_update_author` WHERE `on_update_author`.`id` = " . $_POST['param']);
								if($result){
									echo "success:You are removed as author to this research";
								}else{
									echo "error:Cannot delete researc to the author";
								}
							}else{
								echo "error:Cannot add research to the author";
							}

							
						}
					}else{
						echo "error:You cannot complete the action. This may happen when the author cancel his request";
					}
				}else{
					echo "error:You cannot complete the action. The request was canceled by the sender.";
				}
			}

			$con->close();
		}else{
			echo "error:No post detected";
		}
	}else{
		echo "error:you must login first";
	}


?>