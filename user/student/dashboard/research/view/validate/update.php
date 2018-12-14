<?php
	//echo $_POST['pointer'];
	session_start();
	if(isset($_SESSION['uid']) && isset($_POST['value']) && isset($_POST['pointer']) && $_POST['book_id']){
			
		$value = $_POST['value'];
		$book_id = $_POST['book_id'];

		$pointer = $_POST['pointer'];
		$feed = (object)[];
		$feed->status="error";
		$query = "";

		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
		$dbconfig = new dbconfig();
    	$con = $dbconfig ->getCon();

    	$param = 0;

		if($pointer==="department"){
			$query = "UPDATE `book` SET `department` = ? WHERE `book`.`book_id` = ?";	
			$param = 2;
		}elseif ($pointer==="keywords") {
			$query="UPDATE `book` SET `keywords` = ? WHERE `book`.`book_id` = ?";
			$param = 2;
		}elseif ($pointer==="abstract") {
			$query="UPDATE `book` SET `abstract` = ? WHERE `book`.`book_id` = ?";
			$param = 2;
		}elseif ($pointer==="downloadable") {
			$query = "UPDATE `book` SET `dowloadable` = ? WHERE `book`.`book_id` = ?";
			$param = 2;
		}elseif($pointer=="references"){
			$temp = explode("-", $value);

			if($temp[1]==="delete"){
				$query = "DELETE FROM `ref` WHERE `ref`.`id` = ?";
				$stmt = $con->prepare($query);
				$stmt->bind_param("s",$temp[0]);
				//echo $temp[0];
			}

			//$query = "UPDATE `book` SET `dowloadable` = ? WHERE `book`.`book_id` = ?";
			$param = 1;
		}



		if($param==1){
			

		}elseif($param==2){
			$stmt = $con->prepare($query);
			$stmt->bind_param("si",$value, $book_id);

		}

		
		if($stmt->execute()){
			$feed->status="success";
		}else{
			$feed->status="error";
		}

		echo json_encode($feed);
  
	}else{

	$feed->status="The Server connot process your request";
	echo json_encode($feed);
	}

?>