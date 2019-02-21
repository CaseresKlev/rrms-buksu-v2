<?php
$currentDIR = "";
$cur = "research";
$loaded = false;
  session_start();
  $book_id ="";
  $book_title = "";

  if(isset($_SESSION['uid']) && isset($_GET['book_id'])){
    $book_id = $_GET['book_id'];
  }else{
    header("Location: admindashboard.php");
  }

  $accname = $_SESSION['gname'];
  $acctype = $_SESSION['type'];
  if($acctype==="admin"){
    //echo "Admin ANG NAKALOGIN";
  }else if($acctype==="INSTRUCTOR"){
    //echo "Instructor ang naka login";

    header("Location: instructordashboard.php");
  }else if($acctype==="student"){
    header("Location: index.php");
  }

  include_once 'connection.php';
  $dbconfig = new dbconfig();
  $con = $dbconfig->getCon();
  $query = "SELECT book_id, book_title, cited, enabled FROM `book` WHERE book_id=" .$book_id;
  $result = $con->query($query);
  if($result->num_rows>0){
    $row = $result->fetch_assoc();
    $book_title = $row['book_title'];
    $book_id = $row['book_id'];
  }




  ?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Administrator </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-min-4.1.0.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- scrollbar -->
    <link rel="stylesheet" href="css/custom_scroll.css">

    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>

</head>
<body>
	<div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

        <?php include 'toggle_menu.php'; ?>


           <!---- PLACE YOUR DIVS HERE --->
           <div class="container">
               <div class="col-md-12"> <h3><?php echo $book_title ?></h3></div>
                 <?php
                  $dbconfig = new dbconfig();
                  $con = $dbconfig->getCon();
                  $query = "SELECT author.a_id, CONCAT(author.a_lname, ', ' , SUBSTRING(author.a_fname, 1, 1), ';') as 'author' FROM author INNER JOIN junc_authorbook on junc_authorbook.aut_id = author.a_id WHERE junc_authorbook.book_id=" . $book_id;
                  $result = $con->query($query);
                  if($result->num_rows>0){
                      $row = $result->fetch_assoc();
                      echo'<div class="col-md-12" ><b style="color: gray"> '. $row['author'] .' </b></div>';
                  }
                 ?>
               <br>
               <br>
               <div class="row">
                    <div class="col-md-12" ><h4>Status</h4></div>
                </div>
           </div>

           <div class="container">
               <div class="row">
                <table class="table">
                    <thead>
                      <tr>
                        <td scope="col">Step</td>
                        <td scope="col">Status</td>
                        <td scope="col">Action</td>
                      </tr>

                    </thead>
                    <tbody>

                      <?php

                          $max = 2;
                          include_once 'connection.php';
                          $dbconfig = new dbconfig();
                          $con = $dbconfig->getCon();
                          $query = "SELECT Max(paper_stat.id) as 'lates' FROM paper_stat INNER JOIN paper_trail on  paper_trail.p_sat_id = paper_stat.id WHERE paper_trail.book_id = $book_id";
                          $result = $con->query($query);

                          if($result->num_rows>0){
                            $row = $result->fetch_assoc();
                            if($row['lates']===NULL){
                              echo '<tr><td colspan="3"><div class="alert alert-danger" role="alert">We cannot find complete status of this research. This may happen when this research was upload by a student or uploaded as finished research by the author.</div></td></tr>';
                              exit();
                            }
                            $max = $row['lates'];
                          }
                         


                         include_once 'connection.php';
                          $dbconfig = new dbconfig();
                          $con = $dbconfig->getCon();
                          $query = "SELECT paper_stat.id as 'step-id', CONCAT('Step ' , paper_stat.id, ': ', paper_stat.title) as 'step', paper_stat.id as 'count', paper_stat.hassub FROM paper_stat";
                          $result = $con->query($query);
                          if($result->num_rows>0){
                            while ($row=$result->fetch_assoc()) {

                              if($row['count']<=$max){

                                  $stat_ = "";
                                  $tmp = "";

                                  include_once 'connection.php';
                                  $dbconfig = new dbconfig();
                                  $con = $dbconfig->getCon();
                                  //$query3 = "SELECT paper_trail.id, paper_trail.isdone FROM paper_trail WHERE paper_trail.p_sat_id = " . $row['count'] . " and paper_trail.book_id = $book_id";

                                  $query3 = "SELECT paper_trail.id, paper_trail.isdone, (SELECT CASE WHEN EXISTS (SELECT pn.bookid from push_notification pn where pn.bookid = paper_trail.book_id and paper_trail.p_sat_id =  pn.trail and pn.seen = 0) THEN 'UPDATED' else '' END) as updated FROM paper_trail WHERE paper_trail.p_sat_id = " . $row['count'] . " and paper_trail.book_id = " . $book_id;
                                  //echo $query3;
                                  //echo $query3;
                                  $result3 = $con->query($query3);
                                    if($result3->num_rows>0){
                                       $row3 = $result3->fetch_assoc();
                                        $stat_ = $row3['isdone'];
                                    }

                                    if($stat_==="1"){
                                      $tmp = "Done";
                                    }else{
                                      $tmp = "On-Going";
                                    }


                                echo '<tr>
                        <td scope="col" style="width: 75%"><a href="admin-view-full-status.php?trail=' . $row3['id'] . '&book_id='. $book_id .'"><em class="btn btn-primary btn-md" style="width: 100%; text-align: left; style=" >'. $row['step'] .'<sup class="badge badge-danger ml-3">'. $row3['updated'] .'</sup></em></a></td>
                        <td scope="col" style="width: 20%">
                          <select class="form-control" id="select-'. $row['count'].'">
                            <option>'. $tmp .'</option>
                          </select>
                        </td>
                        <td scope="col" style="width: 5%%"><button class="btn btn-danger btn-md" name="'. $row['count'] .'-' . $row3['id'] . '-' . $row['step-id']. '" id="btn[]">Edit</button></td>
                      </tr>';
                              }else{

                                if($row['count']==$max+1 && $tmp==="Done"){
                                  echo '<tr>
                        <td scope="col" style="width: 75%"><em class="btn btn-warning btn-md" style="width: 100%; text-align: left; color: black" disabled="true">'. $row['step'] .'</em></td>
                        <td scope="col" style="width: 20%">
                          <select class="form-control" id="select-'. $row['count'].'">
                            <option></option>
                            <option>Done</option>
                          </select>
                        </td>
                        <td scope="col" style="width: 5%%"><button class="btn btn-success btn-md" name="'. $row['count'] .'-' . $row3['id'] . '-' . $row['step-id']. '" id="btn[]">Save</button></td>
                      </tr>';
                    }else{

                      if($max>=9){
                        echo '<tr>
                        <td scope="col" style="width: 75%"><em class="btn btn-warning btn-md" style="width: 100%; text-align: left; color: black" disabled="true">'. $row['step'] .'</em></td>
                        <td scope="col" style="width: 20%">
                          <select class="form-control" id="select-'. $row['count'].'">
                            <option></option>
                            <option>Done</option>
                          </select>
                        </td>
                        <td scope="col" style="width: 5%%"><button class="btn btn-success btn-md" name="'. $row['count'] .'-' . $row3['id'] . '-' . $row['step-id']. '" id="btn[]">Save</button></td>
                      </tr>';
                      }else{
                        echo '<tr>
                        <td scope="col" style="width: 75%"><em class="btn btn-default btn-md" style="width: 100%; text-align: left; style=" disabled="true">'. $row['step'] .'</em></td>
                        <td scope="col" style="width: 20%">
                          <select class="form-control" disabled="true">
                            <option></option>
                            <option>Done</option>
                          </select>
                        </td>
                        <td scope="col" style="width: 5%%"><button class="btn btn-default btn-md" disabled="true" id="btn[]">Save</button></td>
                      </tr>';
                      }

                    }

                              }


                            }
                          }

                      ?>




                    </tbody>

                  </table>
               </div>
           </div>













           <!---- AYAW NAG LAPAS DIRI --->
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <!-- Popper.JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min-4.1.0.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    <script src="js/searchdoc.js"></script>


</body>
</html>
