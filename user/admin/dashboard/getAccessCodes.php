<?php

session_start();
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

	//while($i<=5){
	include_once 'connection.php';
	$dbconfig = new dbconfig();
	$conn = $dbconfig->getCon();
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
			//array_push(array, var)

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