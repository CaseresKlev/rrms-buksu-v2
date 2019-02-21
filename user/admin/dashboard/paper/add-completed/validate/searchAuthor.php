<?php


	session_start();
	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
	if(!isset($_SESSION['uid'])){
		header("Location: " . PROJECT_ROOT . "404.php");
		exit();
	}

	if(!isset($_POST['key']) || empty($_POST['key']) || !isset($_POST['bid']) || empty($_POST['bid'])){
		header("Location: " . PROJECT_ROOT . "404.php");
		exit();
	}

	$k = $_POST['key'];
	$bid = $_POST['bid'];
	include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
    $dbconfig = new dbconfig();
    $con = $dbconfig ->getCon();
    $query = "SELECT a1.a_id, CONCAT(a1.a_fname, ' ', SUBSTRING(a1.`a_mname`, 1,1), '. ', a1.`a_lname`, ' ', a1.`a_suffix` ) as name FROM `author` a1 WHERE NOT EXISTS (SELECT ja.aut_id from junc_authorbook ja WHERE ja.book_id = ? and ja.aut_id = a1.a_id) and (`a_fname` like ? or `a_mname`like ? or `a_lname`like ?) ORDER BY `a_fname` ASC LIMIT 10";
	$stmt = $con->prepare($query);
	echo $query;
	//exit();
	$search = '%'. $k .'%';
	$stmt->bind_param('isss', $bid, $search, $search, $search);
	$stmt->execute();
	$res = $stmt->get_result();
  		if($res->num_rows>0){
  			while ($row=$res->fetch_assoc()) {
  				echo '<tr>
      <td>'. $row['name'] .'</td>
      <td><div class="btn btn-primary btn-sm" onclick="addThisAuthor('. $row['a_id'] .')">add</div></td>
    </tr>';
  			}
  		}else{
  			echo '<tr>
      <td colspan="2">No Author found. Please narrow your search. Search for field {<strong>Firstname, Middle Name, Lastname</strong>} only.</td>
    </tr>';
  		}

?>