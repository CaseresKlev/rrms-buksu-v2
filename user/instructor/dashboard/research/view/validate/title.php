<?php
	/*$im = new imagick('https://www.cs.uky.edu/~keen/115/Haltermanpythonbook.pdf');
	$im->setImageFormat('jpg');
	header('Content-Type: image/jpeg');
	echo $im;*/
	session_start();
	//print_r($_SESSION);
	if(isset($_POST['bookid']) && isset($_SESSION['uid'])){
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
		include (PROJECT_ROOT_NOT_LINK . "includes/connection.php");

		$dbconfig = new dbconfig();
		$con = $dbconfig->getCon();
		$id = $_POST['bookid'];
		$title = $_POST['txt-title'];

		//$temp = explode(" ", $title);
		//$
		//preg_replace("/ /", "-", $title);
		$loc =  str_replace(':', '-', $title);
		$loc =  str_replace('/', '-', $loc);
		$loc =  str_replace(' ', '-', $loc);
		$loc =  str_replace(';', '-', $loc);
		$loc =  str_replace('\\', '-', $loc);
		$loc =  str_replace('|', '-', $loc);
		$loc =  str_replace('[', '-', $loc);
		$loc =  str_replace(']', '-', $loc);
		//echo $loc;

		
		//echo "$title";

		$query = "SELECT `id` FROM `junc_authorbook` WHERE `book_id` = ? and `aut_id`=?";
		$stmt = $con->prepare($query);
		$stmt->bind_param("ii", $id, $_SESSION['owner']);
		$stmt->execute();

		$result = $stmt->get_result();
		if($result->num_rows>0){


			$query = "SELECT YEAR(`pub_date`) as year, `aut_type` as type, link FROM `book` WHERE book.book_id = ?";
			$stmt = $con->prepare($query);
			$stmt->bind_param("i", $id);

			$year = "";
			$type = "";
			$webLink = "";
			if($stmt->execute()){
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();
				$webLink = $row['link'];
				$year = $row['year'];
				$type = $row['type'];
			}

			//echo " -----> " . $webLink;
			

			
			$stmt = $con->prepare("UPDATE `book` SET `book_title` = ?, `link` = ? WHERE `book`.`book_id` = ?");
			$stmt->bind_param("ssi", $title, $loc, $id);

			if(!$stmt->execute()){
				header("Location: ../?book=$id&msg=Transaction failed!<br> Your Research was NOT Updated! ". $loc ."&alertType=danger");
			}else{

				$old = PROJECT_ROOT_NOT_LINK . "research/" . $year . "/" . $type . "/" . $webLink;
				$new = PROJECT_ROOT_NOT_LINK . "research/" . $year . "/" . $type . "/" . $loc;
				//echo $dir;

				$errorCurrent = false;
				$stmt2 = $con->prepare("INSERT INTO `push_notification` (`id`, `receiver`, `bookid`, `description`, `sender`, `link`, `date`, `seen`)
SELECT null, junc_authorbook.aut_id, ?, 'Updated the title of your research.', ?, ?, CURRENT_TIMESTAMP, '0' from junc_authorbook where junc_authorbook.book_id = ? and junc_authorbook.aut_id != ?");
				
				$loclink = PROJECT_ROOT . "user/[xxxxx]/dashboard/research/view/?book=" . $id;
				$stmt2->bind_param("iisii", $id, $_SESSION['owner'], $loclink,  $id, $_SESSION['owner']);
				if(!$stmt2->execute()){
					$errorCurrent = true;
				}
				if(file_exists($old)){
					//echo "Exist";
					if(rename($old, $new)){
						header("Location: ../?book=$id&msg=Transaction successful!<br> Your Research was Updated!&alertType=success");
					}else{
						echo "Old: " . $old . "\n";
						echo "New: " . $new . "\n";
						//header("Location: ../?book=$id&msg=Transaction failed!<br> Your Research was NOT Updated! Error while renaming.&alertType=danger");
					}
				}else{
					if(!$errorCurrent){
						header("Location: ../?book=$id&msg=Transaction failed!<br> Your Research was NOT Updated!&alertType=danger");
					}else{
						echo "<h1>error on Current modification.";
					}
					
				}
				
			}
		}else{
			echo "Not";
		}
		

		//print_r($_SESSION);
	}else{
		header("Location: ../?book=$id&msg=Transaction failed!<br> Your Research was NOT Updated!&alertType=error");
	}

?>
