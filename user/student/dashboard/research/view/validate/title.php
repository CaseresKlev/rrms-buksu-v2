<?php
	/*$im = new imagick('https://www.cs.uky.edu/~keen/115/Haltermanpythonbook.pdf');
	$im->setImageFormat('jpg');
	header('Content-Type: image/jpeg');
	echo $im;*/
	session_start();
	//print_r($_SESSION);
	if(isset($_POST['bookid']) && isset($_SESSION['uid'])){
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include (PROJECT_ROOT_NOT_LINK . "includes/connection.php");

		$dbconfig = new dbconfig();
		$con = $dbconfig->getCon();
		$id = $_POST['bookid'];
		$title = $_POST['txt-title'];
		//echo "$title";

		$query = "SELECT `id` FROM `junc_authorbook` WHERE `book_id` = ? and `aut_id`=?";
		$stmt = $con->prepare($query);
		$stmt->bind_param("ii", $id, $_SESSION['owner']);
		$stmt->execute();

		$result = $stmt->get_result();
		if($result->num_rows>0){
			$stmt = $con->prepare("UPDATE `book` SET `book_title` = ? WHERE `book`.`book_id` = ?");
			$stmt->bind_param("si", $title, $id);
			if(!$stmt->execute()){
				header("Location: ../?book=$id&msg=Transaction successful!<br> Your Research was Updated!&alertType=success");;
			}else{
				header("Location: ../?book=$id&msg=Transaction successful!<br> Your Research was Updated!&alertType=success");
			}
		}else{
			echo "Not";
		}
		

		//print_r($_SESSION);
	}else{
		echo "Error";
	}

?>
