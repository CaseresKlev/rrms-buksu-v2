<?php
	/*$im = new imagick('https://www.cs.uky.edu/~keen/115/Haltermanpythonbook.pdf');
	$im->setImageFormat('jpg');
	header('Content-Type: image/jpeg');
	echo $im;*/
	
	//echo $dt->format('Y-m-d H:i:s');
	session_start();
	//print_r($_SESSION);
	if(isset($_POST['author']) && isset($_SESSION['uid'])){
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include (PROJECT_ROOT_NOT_LINK . "includes/connection.php");

		$dbconfig = new dbconfig();
		$con = $dbconfig->getCon();
		$author = $_POST['author'] . "-". $_SESSION['owner'];
		
		//echo $author;
		$temp = array();

		$temp = explode("-", $author);
		$action_temp = $temp[0];
		$author_id = $temp[1];
		$book_id = $temp[2];


		echo "Author to remove: " . $author_id;
		echo " Book id: " . $book_id;
		echo " By: " . $_SESSION['owner'];
		//print_r($temp);

		$action = "";
		if($action_temp==="remove"){
			$action = "remove";
		}else{
			$action = "added";
		}

		//print_r($temp);


		$query = "INSERT INTO `on_update_Author` (`id`,`action`, `author`, `book_id`, `referer`) VALUES (NULL, ?, ?, ?, ?)";

		$stmt = $con->prepare($query);
		 
		$stmt->bind_param("siii", $action, $author_id, $book_id, $_SESSION['owner']);
				echo $query;

		if($stmt->execute()){
			$myObj->status = "success";


			echo $myJSON;
			header("Location: ../?book=$book_id&msg=Transaction successful!<br> But needs an approval. We will notify the author for this changes!&alertType=success");
		}else{
			$errno = $stmt->errno;
			if($errno==1062){
				header("Location: ../?book=$book_id&msg=Transaction Failed!<br> We already sent Notification to the author for this changes. Please wait for his/her confirmation.&alertType=danger");
			}
			//header("Location: ../?book=$book_id&msg=Transaction Failed! But needs an approval. We will notify the author for this changes!&alertType=danger");
		}
		/*if($result->num_rows>0){
			$stmt = $con->prepare("UPDATE `book` SET `book_title` = ? WHERE `book`.`book_id` = ?");
			$stmt->bind_param("si", $title, $id);
			if(!$stmt->execute()){
				echo "Not Successfull";
			}else{
				//header("Location: " . $_SERVER['HTTP_REFERER'] . "Successfully save" . "&alertType=success");
			}
		}else{
			echo "Not";
		}
		
		*/
		//print_r($_SESSION);
	}else{
		echo "Error: Something happed.";
	}


?>
