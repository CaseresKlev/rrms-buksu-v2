<?php
	session_start();
	if(isset($_POST['key']) && isset($_SESSION['uid'])){
		$key = "%" . $_POST['key'] ."%";
		$book_id = $_POST['book_id'];
		//echo $key;
		//$book_id = 2;

		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include (PROJECT_ROOT_NOT_LINK . "includes/connection.php");
		$dbconfig = new dbconfig();
		$con = $dbconfig->getCon();
		$query = 'SELECT DISTINCT(author.a_id), CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1, 1), ". ", author.a_lname, " ", author.a_suffix)as name  FROM author WHERE author.a_id NOT IN (SELECT junc_authorbook.aut_id FROM junc_authorbook WHERE junc_authorbook.book_id = ? ) and (author.a_fname LIKE ? or author.a_mname LIKE ? or author.a_lname LIKE ?)';
		//echo $query;
		
		//echo $query;
		$stmt=$con->prepare($query);
		$stmt->bind_param("isss", $book_id, $key, $key, $key);
		$stmt->execute();
		$result = $stmt->get_result();
		$out = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($out);
		//echo $result->num_rows;
	/*	if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				//print_r($row);

			}
			echo json_encode($row);
		}else{
			echo "Cannot found";
		}*/
		//$row = $result->fetch_assoc();
		//print_r($row);
	}else{
		echo "Not Arrived";
	}

?>