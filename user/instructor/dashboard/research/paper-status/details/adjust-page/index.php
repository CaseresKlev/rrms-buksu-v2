<?php

include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/preload.php";
if(!isset($_SESSION['uid'])  || !$_SESSION['type'] ==="INSTRUCTOR" || !isset($_POST)){
	header("Location: " . PROJECT_ROOT . "404.php");
	exit();
}

$dbconfig = new dbconfig();
$con = $dbconfig ->getCon();
print_r($_POST);

$query = "UPDATE `comments` SET `adjustment` = ? WHERE `comments`.`id` = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("si", $_POST['page'], $_POST['id']);
if(!$stmt->execute()){
	header("Location: ../". $_POST['prev'] ."&msg=We are very sorry, but something went wrong while submiting your adjustment. We will fix it soon!&alertType=danger");
}
header("Location: ../". $_POST['prev'] ."&msg=Success!&alertType=success");

$con->close();
?>