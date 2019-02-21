<?php

	session_start();
	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
	if(!isset($_SESSION['uid'])){
		header("Location: " . PROJECT_ROOT . "404.php");
		exit();
	}

	if(count($_POST)<1){
    	header("Location: " . PROJECT_ROOT . "404.php");
		exit();
    }

    $bid = $_POST['bid'];
    $aid = $_POST['a_id'];
    //print_r($_POST);
    include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
    $dbconfig = new dbconfig();
    $con = $dbconfig ->getCon();

    $stmt = $con->prepare('INSERT INTO `junc_authorbook` (`id`, `book_id`, `aut_id`) VALUES (NULL, ?, ?)');
    $stmt->bind_param("ii", $bid, $aid);
    if(!$stmt->execute()){
    	echo "Something went wrong to your request. We will fix it soon.";
    }else{
    	echo "success";
    }

?>