<?php 
$npass = $_POST['ncpsw'];
$gname = $_POST['gname'];
$old = $_POST['opsw'];

 //$echo $npass;

	include("connection.php");
  $dbconfig = new dbconfig();
  $conn = $dbconfig->getCOn();
  $query = "UPDATE `account` SET `password` = '$npass' WHERE `account`.`g_name` ='$gname' and account.password = '$old'";
  $result = $conn->query($query);
  if($result){
  	echo "Password Change Successful!";
  }else{
  	echo "There is an error in updating your password";
  }

?>