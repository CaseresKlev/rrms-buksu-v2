<?php


if(isset($_POST['action'])){
		date_default_timezone_set("Asia/Manila");
		
		$action = $_POST['action'];
		//echo "$action";
		//echo "$datenow $issn $journal $type $date $book_id $status";
		//echo "Save";
		if($action==="save"){

			$issn = $_POST['issn'];
			$journal = $_POST['journal'];
			$type = $_POST['type'];
			$date = $_POST['date'];
			$book_id = $_POST['book_id'];
			$status = $_POST['status'];
			$datenow = date('Y-m-d H:i:s');


			
	    	

	    	//echo $query;
	    	
	    		include_once 'connection.php';
	    		$dbconfig = new dbconfig();
				$conn = $dbconfig->getCon();
				$query = "UPDATE `book` SET `status` = '$status' WHERE `book`.`book_id` = $book_id";
				//echo $query;
				$result2 = $conn->query($query);


				if($result2){
					$conn = $dbconfig->getCon();
	        		$query = "INSERT INTO `bookhistory` (`id`, `book_id`, `book_stat`, `date`) VALUES (NULL, '$book_id', '$status', '$datenow')";
	        		$result3 = $conn->query($query);
	        		if($result3){
	        			$history_id = "";
	        			$dbconfig = new dbconfig();
	    				$conn = $dbconfig->getCon();
	    				$query = "SELECT id FROM `bookhistory` WHERE `book_id` = $book_id and `date` = '$datenow'";
	    				$result = $conn->query($query);
	    				if($result->num_rows>0){
	    					$row88 = $result->fetch_assoc();
	    					$history_id= $row88['id'];
	    				}
	    				//echo "history_id = $history_id";
	        			$dbconfig = new dbconfig();
	    				$conn = $dbconfig->getCon();
	    				$query = "INSERT INTO `published` (`id`, `book_id`, `issn`, `journal`, `type`, `history`, `date`) VALUES (NULL, '$book_id', '$issn', '$journal', '$type', '$history_id', '$date')";
	    				$result = $conn->query($query);


	        			echo "Save Changes Done.";
	        		}else{
	        			echo "No changes has been made.";
	        		}
					
				}else{
					echo "No changes has been made.";
				}
	    		//echo "Update Successful!";
	    	
		}elseif ($action==="update") {
			$pub_id = $_POST['pub_id'];
			include_once 'connection.php';
			$dbconfig = new dbconfig();
			$conn = $dbconfig->getCon();

			$issn = $_POST['issn'];
			$journal = $_POST['journal'];
			$type = $_POST['type'];
			$date = $_POST['date'];

	        $query = "UPDATE `published` SET `issn` = '$issn', `journal` = '$journal', `type` = '$type', `date` = '$date' WHERE `published`.`id` = $pub_id";
	        $result3 = $conn->query($query);
	        if($result3){
	        	echo "Save Changes Done.";
	        }else{
	        	echo "No changes has been made.";
	        }
		}else{
			$pub_id = $_POST['pub_id'];
			$history = $_POST['history'];
			include_once 'connection.php';
			$dbconfig = new dbconfig();
			$conn = $dbconfig->getCon();
	        $query = "DELETE FROM `published` WHERE `published`.`id` = $pub_id";
	        $result3 = $conn->query($query);
	        if($result3){
	        	$dbconfig = new dbconfig();
				$conn = $dbconfig->getCon();
		        $query = "DELETE FROM `bookhistory` WHERE `bookhistory`.`id` = $history";
		        $result5 = $conn->query($query);
	        	echo "Deleted.";
	        }else{
	        	echo "No changes has been made.";
	        }
		}
		
}

	
	
	

?>