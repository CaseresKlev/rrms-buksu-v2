<?php

	$book_id = 2;
    include $_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/connection.php";
    $dbconfig= new dbconfig();
    $con= $dbconfig -> getCon();

    echo $_POST['refrences'];

    if(isset($_POST['refrences'])){
    	$query = 'UPDATE `book` SET `refrences` = ? WHERE `book`.`book_id` = 2';
    	$stmt = $con->prepare($query);
    	$stmt->bind_param("s", $_POST['refrences']);

    	if($stmt->execute()){
    		echo "Done";
    	}else{
    		echo "Error";
    	}
    }

?>