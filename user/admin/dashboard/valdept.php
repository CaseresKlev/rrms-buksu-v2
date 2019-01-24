<?php

if (isset($_POST)){
  $task=$_POST['task'];



    if ($task==="add") {
      $dept= $_POST['dept'];
      $coll= $_POST['college'];


      include_once 'connection.php';
      $dbconfig=new dbconfig();
      $conn=$dbconfig->getCon();

      $query="INSERT INTO `department` (`id`, `cat_name`, `college`) VALUES (NULL, '$dept', '$coll')";

      $result= $conn->query($query);

      if ($result) {
        echo "Successfully Added!";
      }

    }elseif ($task==="del") {
      $dept= $_POST['dept'];


      include_once 'connection.php';
      $dbconfig=new dbconfig();
      $conn=$dbconfig->getCon();

      $query="DELETE FROM `department` WHERE cat_name='$dept'";
     


      $result= $conn->query($query);

      if ($result) {
        echo "Successfully Deleted!";
      }
    }



}



?>
