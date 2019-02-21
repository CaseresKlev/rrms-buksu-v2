<?php
	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
	include PROJECT_ROOT_NOT_LINK . "user/admin/dashboard/preload.php";
	if(!(isset($_SESSION['uid']))){
		exit();
	}

	if(!(isset($_POST['sender']) && !empty($_POST['sender']))){
		echo "error:error";
		exit();
	}

	$sender = $_POST['sender'];
	$dbconfig = new dbconfig();
  	$con = $dbconfig->getCon();

	$stmt = $con->prepare("SELECT `id` FROM `chat` WHERE (author1 = ? and author2 = ?) or (author1 = ? and author2 = ?)");
	$stmt->bind_param("iiii", $_SESSION['owner'], $sender, $sender, $_SESSION['owner']);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res->num_rows>0){
		$row = $res->fetch_assoc();
		echo "success:?c=" . $row['id'] . "&s=" . $sender;
	}else{
		$stmt = $con->prepare("INSERT INTO `chat` (`id`, `author1`, `author2`) VALUES (NULL, ?, ?)");
		$stmt->bind_param("ii", $_SESSION['owner'], $sender);
		if($stmt->execute()){
			echo "success:?c=" . $stmt->insert_id . "&s=" . $sender;
		}else{
			echo "Error:Something went wrong to your request. Try again later.";
		}
	}
	//print_r($_POST);

?>