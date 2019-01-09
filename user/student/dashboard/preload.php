<?php

  session_start();
  

  include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
  include PROJECT_ROOT_NOT_LINK . 'server_script/crypt.php';
  if(isset($_SESSION['uid']) && $_SESSION['type']==="STUDENT"){
    //print_r($_SESSION);
  }else{
    header("Location: " . PROJECT_ROOT . "404.php" );
  }

    $accname = $_SESSION['gname'];
    $acctype = $_SESSION['type'];
    $uid = $_SESSION['uid'];


  ?>