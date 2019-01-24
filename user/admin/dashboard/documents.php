<?php

  session_start();

  $book_id = "";
  if(isset($_SESSION['uid']) && $_GET['book_id']){
    //print_r($_SESSION);
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

    //header("Location: instructordashboard.php");
  }else if($acctype==="STUDENT"){
    header("Location: index.php");
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
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4>Research Record Mangement System</h4>
            </div>
            <?php
              if ($acctype==="INSTRUCTOR") {
                echo '<ul class="list-unstyled components">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Research</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="instructordashboard.php">Finished Reserch</a>
                            </li>
                            <li>
                                <a href="instructor-on-process-paper.php">On-Process Research</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="accesscode_instruct.php" class="dropdown-toggle">Access Codes</a>
                        <!--<ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Page 1</a>
                            </li>
                            <li>
                                <a href="#">Page 2</a>
                            </li>
                            <li>
                                <a href="#">Page 3</a>
                            </li>
                        </ul>-->
                    </li>
                    <li>
                        <a href="book_reports.php?title=&dept=&status=&author=&from=0&to=2018">Reports</a>
                    </li>

                </ul>';
              } else {
                echo '<ul class="list-unstyled components" style="margin-left: 10%">
                    <li class="active">
                        <a href="admindashboard.php">Research
                          <i class="fas fa-circle fa-xs" style="color:red"></i>
                        </a>

                        <!--<ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">Home 1</a>
                            </li>
                            <li>
                                <a href="#">Home 2</a>
                            </li>
                            <li>
                                <a href="#">Home 3</a>
                            </li>
                        </ul>-->
                    </li>
                    <li>
                        <a href="updateAcc.php">Update Account</a>
                    </li>
                    <li>
                        <a href="accesscode.php" >Access Codes</a>
                        <!--<ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Page 1</a>
                            </li>
                            <li>
                                <a href="#">Page 2</a>
                            </li>
                            <li>
                                <a href="#">Page 3</a>
                            </li>
                        </ul>-->
                    </li>
                    <li>
                        <a href="book_reports.php?title=&dept=&status=&author=&from=0&to=2018" target="_blank">Reports</a>
                    </li>
                    <li>
                        <a href="dept.php">Department</a>
                    </li>
                </ul>';
              }
              ?>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg" style="background: #CDCDD8">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="nav navbar-nav ml-auto">
                          <li class="nav-item hover">
                              <a class="nav-link" href="index.php">Home</a>
                          </li>
                          <li class="nav-item hover">
                              <a class="nav-link" href="inbox.php">
                                  <i class="fas fa-envelope fa-lg"> </i>
                                  Inbox
                                  <i class="fas fa-circle fa-xs" style="color:red"></i>
                              </a>
                          </li>
                          <li class="nav-item hover">
                              <a class="nav-link" href="new-login.php">Logout</a>
                          </li>
                          <!--<li class="nav-item">
                              <a class="nav-link" href="#">Page</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Page</a>
                          </li>-->
                      </ul>
                    </div>
                </div>
            </nav>


           <!---- PLACE YOUR DIVS HERE --->

            <div class="container">
                <?php
                include_once 'connection.php';
                $dbconfig = new dbconfig();
                    $con= $dbconfig -> getCon();
                  $query= "SELECT `documents`, `orig_name` FROM `documents` WHERE `book_id` = $book_id ";
                  $result2 = $con -> query($query);
                  if($result2->num_rows>0){
                    echo '<div class="row">
                      <div class="col-md-12" style="font-size: 18pt; font-weight: bold;">
                      My Files and Certificates
                      </div>

                      <div class="col-md-12" style="width: 100%; height: 2px; background-color: blue;"></div>
                        <br>

                        <div class="col-md-12">
                          <em style="color: red;">
                              <ul>';
                    while ($row=$result2->fetch_assoc()) {
                      echo '<li><a href="'. $row['documents'] .'">'. $row['orig_name'] .'</a></li>';
                    }
                    echo '</ul>
                          </em>

                        </div>


                    </div>

                  </div><br>';
                  }

                  ?>
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
