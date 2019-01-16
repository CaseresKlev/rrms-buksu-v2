<?php

	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
	include PROJECT_ROOT_NOT_LINK . "server_script/crypt.php";

	//print_r($_FILES['myFile']);
	
   /* $tempfile = $_FILES['myFile']['tmp_name'];
    $filename = $_FILES['myFile']['name'];
    $filesize = $_FILES['myFile']['size'];
    $filetype = $_FILES['myFile']['type'];*/
	$fname  = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname =  $_POST['lname'];
	$suf = $_POST['suf'];
	$contact = $_POST['profileContact'];
	$email = $_POST['profileEmail'];
	$address =  $_POST['profileAddress'];
	$bib =  $_POST['profileBib'];
	$msg = "";
	$error = 0;
	//echo "$suf";
	session_start();
	//print_r($_SESSION);

	if(isset($_SESSION['uid']) && $_GET['t'] && $_SESSION['type']==="INSTRUCTOR"){
		$session_id = $_SESSION['uid'];
		$t_id = $_GET['t'];

		include PROJECT_ROOT_NOT_LINK . "includes/connection.php";
		$dbconfig = new dbconfig();
		$con = $dbconfig->getCon();
		

		$query = "UPDATE `author` SET `a_fname` = ?, `a_mname` = ?, `a_lname` = ?, `a_suffix` = ?, `bib` = ?, `a_add` = ?, `a_contact` = ?, `a_email` = ? WHERE `author`.`a_id` = ?";

		if(!($stm = $con->prepare($query))){
			$msg = "?updateProfileMessage=Something went wrong. We will fix it as soon as posible. Thank you for your understanding.";
			$error = 1;
		}

		if(!$stm->bind_param("ssssssssi", $fname , $mname, $lname, $suf, $bib, $address, $contact, $email, $_SESSION['owner'])){
			$msg = "?updateProfileMessage=Something went wrong. We will fix it as soon as posible. Thank you for your understanding.";
			$error = 1;
		}

		if(!$stm->execute()){
			//$msg .= "Error exeuting: " . $stm->error;
			$msg = "?updateProfileMessage=Something went wrong. We will fix it as soon as posible. Thank you for your understanding.";
			$error = 1;
		}else{
			$msg = "?updateProfileMessage=Your Profile was Updated!";
		}

		if($error){
			header("Location: ../" . $msg . "&alertType=error");
		}else{
			header("Location: ../" . $msg . "&alertType=success");
		}
		$stm->close();
		$con->close();
		//echo ;

	}

//$key is our base64 encoded 256bit key that we created earlier. You will probably store and define this key in a config file.

/*
//our data to be encoded
$password_plain = 'abc123';
echo $password_plain . "<br>";

//our data being encrypted. This encrypted data will probably be going into a database
//since it's base64 encoded, it can go straight into a varchar or text database field without corruption worry

//$password_encrypted = data_encrypt($password_plain, $key);
//echo $password_encrypted . "<br>";
echo data_encrypt($password_plain, $key);
//now we turn our encrypted data back to plain text
$password_decrypted = data_decrypt($password_encrypted, $key);
echo $password_decrypted . "<br>";
	
*/
?>