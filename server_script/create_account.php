<?php

	if(isset($_POST)){
		print_r($_POST);
		include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  		include (PROJECT_ROOT_NOT_LINK . "includes/connection.php");
		$query = "SELECT * FROM `acesskey` WHERE `acesskey` COLLATE latin1_general_cs LIKE ? and `used` = 0";

		$dbconfig = new dbconfig();
  		$con = $dbconfig->getCon();

  		$stmt = $con->prepare($query);
  		$stmt->bind_param("s", $_POST['access_code']);
  		if(!$stmt->execute()){
  			header("Location: ../create-account.php?msg=We apologize, but something went wrong to your request.<br>We will fix it soon!&alertType=danger");
  			print_r($stmt);
  			exit();
  		}

  		$result = $stmt->get_result();
  		if($result->num_rows<=0){
  			header("Location: ../create-account.php?msg=The access code is not valid or expired.<br>Please provide valid access code!&alertType=danger");
  			exit();
  		}

  		$row = $result->fetch_assoc();
  		$usrType = $row['type'];
  		$giver = $row['ins_id'];
  		$accessID = $row['id'];

      
      $contact = "09" . $_POST['contact'];
      $fname = ucwords($_POST['fname']);
      $mname = ucwords($_POST['mname']);
      $lname = ucwords($_POST['lname']);
      $suf = ucwords($_POST['suffix']);
      $alias = $fname . "-" . $mname . "-" . $lname . "-" . $suf;
      $address = ucwords($_POST['address']);


  		
  		$stmt->prepare("INSERT INTO `account` (`id`, `g_name`, `u_name`, `password`, `activate`, `type`, `adviser`, `alias`, `date`) VALUES (NULL, '', ?, ?, '1', ?, ?, ?, CURRENT_TIMESTAMP)");
  		$stmt->bind_param("sssis", $_POST['uname'], $_POST['upass'], $usrType, $giver, $alias);
  		if(!$stmt->execute()){
  			//print_r($stmt);
  			exit();
  		}

  		//print_r($stmt);
  		
  		$lastInserID = $stmt->insert_id;
  		$stmt = $con->prepare("INSERT INTO `author` (`a_id`, `a_fname`, `a_mname`, `a_lname`, `a_suffix`, `bib`, `a_add`, `a_contact`, `a_email`, `a_pic`, `login`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, '', ?)");
  		$stmt->bind_param("ssssssssi", $fname, $mname, $lname, $suf, $_POST['biography'], $address, $contact, $_POST['email'], $lastInserID);
  		if(!$stmt->execute()){
  			print_r($stmt);
  			$con->query("DELETE FROM `account` WHERE `account`.`id` = " . $lastInserID);
  		}

  		
  		
  		$result = $con->query("DELETE FROM `acesskey` WHERE `acesskey`.`id` = " . $accessID);


  		header("Location: ../?msg=Welcome&to=" . $fname . " " . $lname);


  		session_start();
  		$stm = $con->prepare('SELECT `id`, `g_name`, `u_name`, `activate`, `type`, `adviser`, `alias` , author.a_id, CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1, 1), ". ", author.a_lname, " ", author.a_suffix) as name FROM `account` INNER JOIN author on author.login = account.id WHERE u_name COLLATE latin1_general_cs LIKE ? AND password COLLATE latin1_general_cs LIKE ?');

		$stm->bind_param("ss", $_POST['uname'], $_POST['upass']);

		$stm->execute();
		$result = $stm->get_result(); 
		if ($result->num_rows>0) {
		   	while ($row=$result->fetch_assoc()) {
		      $_SESSION['uid'] = $row['id'];
		      $_SESSION['gname'] = $row['u_name'];
		      $_SESSION['stat']= $row['activate'];
		      $_SESSION['type'] = $row['type'];
		      $_SESSION['adviser'] = $row['adviser'];
		      $_SESSION['owner'] = $row['a_id'];
		      $_SESSION['name'] = $row['name'];
          $_SESSION['alias'] = $row['alias'];
		      //echo $row['g_name'];
		    }
		}
  		exit();
		
		
	}
?>