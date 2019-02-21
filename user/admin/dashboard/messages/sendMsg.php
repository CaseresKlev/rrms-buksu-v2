<?php

include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
include PROJECT_ROOT_NOT_LINK . "user/admin/dashboard/preload.php";

if(!(isset($_SESSION['uid']))){
	exit();
}


if(!isset($_POST['c_id'])){
	exit();
}
//echo "cid valid";
$c_id = $_POST['c_id'];

if(!(isset($_POST['msg']) && !empty($_POST['msg']) )){
	echo "failed";
	exit();
}
//echo "msg and r valid";
$msg = $_POST['msg'];
//print_r($_POST);
if(!(isset($_POST['r']) && !empty($_POST['r']) )){
	echo "failed";
	exit();
}

$receiver = $_POST['r'];

//echo "Chat ID: $c_id <br>To: $receiver <br> Msg: $msg <br>Sender: " . $_SESSION['owner'];

$dbconfig = new dbconfig();
$con = $dbconfig->getCon();

$stmt = $con->prepare("INSERT INTO `messages` (`id`, `chat_id`, `receiver`, `sender`, `msg`, `date`, `seen`) VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP, '0')");
$stmt->bind_param("iiis", $c_id, $receiver, $_SESSION['owner'], $msg);
if($stmt->execute()){
	echo "success";
}else{
	echo "failed";
}

?>