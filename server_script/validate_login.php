<?php
  session_start();
// remove all session variables


  $uname = $_POST['username'];
  $upass = $_POST['password'];
  //echo "Data: " . $uname . " " . $upass;
 // $old = $_POST['opsw'];



  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  include (PROJECT_ROOT_NOT_LINK . "includes/connection.php");
  $dbconfig = new dbconfig();
  $con = $dbconfig->getCon();
  $stm = $con->prepare('SELECT `id`, `g_name`, `u_name`,  `activate`, `type`, `adviser`,`alias`, author.a_id, CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1, 1), ". ", author.a_lname, " ", author.a_suffix) as name FROM `account` INNER JOIN author on author.login = account.id WHERE u_name COLLATE latin1_general_cs LIKE ? AND password COLLATE latin1_general_cs LIKE ?');

  $stm->bind_param("ss", $uname, $upass);

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

    echo "Success:Login";
    //header("Location: index.php");
  }else {
    echo "Error:Your username and password do not match! Please try again.";
  } 

  $stm->close();
  $con->close();
 ?>
