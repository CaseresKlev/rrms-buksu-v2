<?php

//echo $_POST['count'];
//exit();

	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");  
	include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/preload.php";
	if(isset($_SESSION['uid']) && isset($_POST['count'])){
		//echo "Good to Go";
	}else{
		header("Location: " . PROJECT_ROOT ."404.php");
	}


	$count = $_POST['count'];
	$temptype = $_SESSION['type'];
	$id = $_SESSION['uid'];
	//print_r($$temptype);
	$type = null;
	if($temptype==="INSTRUCTOR"){
		$type = "STUDENT";
	}else if($temptype==="admin"){
		$type = "INSTRUCTOR";
		$id = 0;
	}
 
  	
	$dbconfig = new dbconfig();
	$conn = $dbconfig->getCon();

	$query = "SELECT count(`id`) as 'num' FROM `acesskey` WHERE `ins_id` = ? and `used` = 0";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_SESSION['uid']);
	$current = 0;
	if($stmt->execute()){
		$result = $stmt->get_result();
		$ac =$result->fetch_assoc();
		$current = $ac['num'];
	}else{
		echo "Not Executed";
		exit();
	}

	

	if($count>(50 - $current)){
		$count = 50 - $current;
	}


	$accesskey = array();

	for($i=1; $i<=$count; $i++){

		$key = getRandomString(8);
		$date = date("Y-m-d");


		
		$query = "INSERT INTO `acesskey` (`id`, `acesskey`, `type`, `used`, `date` , `ins_id`) VALUES (NULL, '$key', '$type', '0', '$date', '$id')";
		$result = $conn ->query($query);
		//echo $query;
		//echo $result;
		if($result){
			array_push($accesskey, $key);
		}
		
	}

	//print_r($accesskey);
	foreach ($accesskey as $key) {
		//echo $key . "-";
	}



	function getRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}
?>