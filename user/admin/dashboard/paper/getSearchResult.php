<?php

	session_start();
	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
	if(!isset($_SESSION['uid'])){
		header("Location: " . PROJECT_ROOT . "404.php");
		exit();
	}

	if(!isset($_POST['key']) || empty($_POST['key'])){
		header("Location: " . PROJECT_ROOT . "404.php");
		exit();
	}
	include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
    $dbconfig = new dbconfig();
    $con = $dbconfig ->getCon();

	$query = "SELECT DISTINCT(`book_id`), `book_title` FROM `book` WHERE `book_title` LIKE ? or `keywords` LIKE ? LIMIT 15";
	$k = '%' . $_POST['key'] . '%';
	$stmt = $con->prepare($query);
	$stmt->bind_param("ss", $k, $k);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res->num_rows>0){
		while($row = $res->fetch_assoc()){
			echo '<a href="?bid='. $row['book_id'] .'" class="list-group-item list-group-item-action text-info">'. $row['book_title'] .'</a>';
		}
	}else{
		echo '<div class="alert alert-danger border-left-danger">No result found!</div>';
	}

	//echo "success:147";

	//print_r($_POST);
	//header("Location: ../?bid=147");
?>