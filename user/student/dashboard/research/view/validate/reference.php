<?php

	session_start();
	/*
	if(isset($_POST['form-ref-id']) && isset($_SESSION)){
		$id = $_POST['form-ref-id'];
		$title = $_POST['ref-title'];
		$link = $_POST['ref-link'];
		$citation = $_POST['ref-citation'];
		$book_id = $_POST['b_id'];
		//echo $id . " " . $title . " " . $link . " !" . $citation . "!" . $book_id;

		$link = str_replace("http://", "", $link);
		$link = str_replace("https://", "", $link);
		$link = "http://" . $link;
		


		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
		$dbconfig = new dbconfig();
    	$con = $dbconfig ->getCon();

    	function insertReference($bid, $t_title, $l_link){
    		$dbconfig = new dbconfig();
    		$con = $dbconfig ->getCon();
			$stmt = $con->prepare("INSERT INTO `ref` (`id`, `reftitle`, `link`) VALUES (NULL, ?, ?)");
			$stmt->bind_param("ss", $t_title, $l_link);
			


			if($stmt->execute()){
				
				$ref_id =  $con->insert_id;
				$stmt = $con->prepare("INSERT INTO `junk_bookref` (`id`, `book_id`, `webref_id`) VALUES (NULL, ?, ?)");
				$stmt->bind_param("ii", $bid, $ref_id);

				if($stmt->execute()){
					$s = "Location: ../?book=". $bid ."&msg=Transaction Sucessful!&alertType=success";
				}else{
					$s = "Location: ../?book=". $bid ."&msg=Transaction Faild!<br>Some Error Occured!&alertType=danger";
				}

				header($s);
			}else{
				$s = "Location: ../?book=". $bid ."&msg=Transaction Faild!<br>Some Error Occured!&alertType=danger";
				header($s);
			}
		}


		if($id>0){
			$stmt = $con->prepare("UPDATE `ref` SET `reftitle` = ?, `link` = ? WHERE `ref`.`id` = ?");
			$stmt->bind_param("ssi", $title, $link, $id);

			if($stmt->execute()){
				$s = "Location: ../?book=". $book_id ."&msg=Transaction Sucessful!&alertType=success";
				header($s);
			}else{
				$s = "Location: ../?book=". $book_id ."&msg=Transaction Faild!<br>Some Error Occured!&alertType=danger";
				header($s);
			}


		}else if($id==0){
			insertReference($book_id, $title, $link);

		}else{
			//COLLATE latin1_general_cs
			$stmt = $con->prepare('SELECT CONCAT(author.a_lname, ", ", SUBSTRING(author.a_mname, 1, 1) ) as "name", YEAR(book.pub_date) as date, book.book_title, book.link, book.aut_type FROM junc_authorbook INNER JOIN author on author.a_id = junc_authorbook.aut_id INNER JOIN book on book.book_id = junc_authorbook.book_id WHERE book.refkey COLLATE latin1_general_cs like ?');
			$stmt->bind_param("s", $citation);
			if($stmt->execute()){

				$result = $stmt->get_result();

				$str = "";
				$yr ="";
				$cit_title="";
				$link = "";
				$r_type = "";
				if($result->num_rows>0){
					while ($row = $result->fetch_assoc()) {
						$str .= $row['name'] . ", ";
						$yr = $row['date'];
						$cit_title = $row['book_title'];
						$link = $row['link'];
						$r_type = $row['aut_type'];
					}
					$address = "http://" . $_SERVER['HTTP_HOST'] . "/rrms-buksu/research/" . $yr ."/" . $r_type . "/" . $link; 
					$str .=$yr . ". " . $cit_title;
					//echo '<a href="'. $address .'">'. $address .'</a>';
					//echo $str; 

					insertReference($book_id, $str, $address);

				}else{
					echo "citation not valid";
				}

			}
			

		}


	}

	*/

	if(isset($_POST['b_id']) && isset($_SESSION['uid'])){
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
		$dbconfig = new dbconfig();
    	$con = $dbconfig ->getCon();
    	$stmt = $con->prepare("UPDATE `book` SET `refrences` = ? WHERE `book`.`book_id` = ?");
    	$stmt->bind_param("si", $_POST['edit-references'], $_POST['b_id']);
    	if($stmt->execute()){
    		echo $_POST['edit-references'];
    		header("Location: ../?book=". $_POST['b_id'] ."&msg=Transaction Sucessful! You updated your References&alertType=success");
    	}else{
    		header("Location: ../?book=". $_POST['b_id'] ."&msg=Something went wrong while updating your References!&alertType=danger");
    	}
    	
    	$con->close();
	}else{
		header("Location: ../");
	}

?>