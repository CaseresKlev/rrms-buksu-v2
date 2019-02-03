<?php
session_start();
//print_r($_SESSION);
//exit();
if(!(isset($_SESSION['uid']) && $_SESSION['type'] === "admin")){
	echo("<h1>404: The Page you are looking for is not found on this server.</h1>");
	exit();
}

if(isset($_GET['post_id']) && !empty($_GET['post_id'])){
	include_once 'connection.php';
	$dbconfig = new dbconfig();
	$con = $dbconfig->getCon();
	$stmt = $con->prepare("DELETE FROM `post` WHERE `post`.`id` = ?");
	$stmt->bind_param("i", $_GET['post_id']);
	if($stmt->execute()){
		header("Location: post.php?msg=The post was deleted!&alertType=info");
	}
	echo $_GET['post_id'];
}


?>