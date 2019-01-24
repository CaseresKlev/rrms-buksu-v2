<?php

  session_start();
  $book_id ="";
  $book_title = "";
  $trail_id = "";
  $step ="";
  if(isset($_SESSION['uid']) && $_GET['trail'] && $_GET['step']){
    $trail_id = $_GET['trail'];
    
    $step = $_GET['step'];

    
    include_once 'connection.php';
    $dbconfig = new dbconfig();
    $conn = $dbconfig->getCon();
    $query = "SELECT `book_id` FROM paper_trail WHERE paper_trail.id = $trail_id";
    //echo $query;
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    date_default_timezone_set("Asia/Manila");
    $dateTime = date('Y-m-d H:i:s');
    //echo $row['book_id'];

    $required = "";
    $conn = $dbconfig->getCon();
    $query = "SELECT `hasrequired` FROM `paper_stat` WHERE `id` = $step";
    //echo $query;
    $result = $conn->query($query);
    if($result->num_rows>0){
      $row99 = $result->fetch_assoc();
      $required = $row99['hasrequired'];
    }


    $book_id = $row['book_id'];
    $conn = $dbconfig->getCon();
    if($required===""){
      $query = "INSERT INTO `paper_trail` (`id`, `book_id`, `p_sat_id`, `file_loc`, `requirements`, `isdone`, `date`) VALUES (NULL, '$book_id', '$step', '', '1', '1', '$dateTime')";
      //echo $query;
      $result = $conn->query($query);
    }else{
      $query = "INSERT INTO `paper_trail` (`id`, `book_id`, `p_sat_id`, `file_loc`, `requirements`, `isdone`, `date`) VALUES (NULL, '$book_id', '$step', '', '0', '1', '$dateTime')";
      //echo $query;
      $result = $conn->query($query);
    }
    


    $book_id_redirect = "";
    $trail_id_redirect = "";
    $conn = $dbconfig->getCon();
    $query = "SELECT * FROM `paper_trail` WHERE `book_id` = $book_id and `p_sat_id` = $step";
   // echo $query;
    $result = $conn->query($query);
    if($result->num_rows>0){
      $rowdd = $result->fetch_assoc();
      $trail_id_redirect = $rowdd['id'];
      $book_id_redirect = $rowdd['book_id'];
    }








    
    
    //echo $trail_id;
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
  $conn = $dbconfig->getCon();
  $query = "SELECT book_id, book_title, cited, enabled FROM `book` WHERE book_id=" .$book_id;
  $result = $conn->query($query);
  if($result->num_rows>0){
    $row = $result->fetch_assoc();
    $book_title = $row['book_title'];
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
    <link rel="stylesheet" href="css/temp.css">
    <!-- Custom Theme Style -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/custom.min.css">

</head>

<body class="nav-md" >
  <p id="trail_id"><?php echo $trail_id_redirect; ?></p>
  <p id="book_id"><?php echo $book_id_redirect; ?></p>
  <script type="text/javascript">
    var trail_id_redirect = document.getElementById("trail_id").innerHTML;
    var book_id_redirect = document.getElementById("book_id").innerHTML;
    //alert(trail_id_redirect + " " + book_id_redirect);
    window.location.replace("admin-view-full-status.php?trail=" + trail_id_redirect + "&book_id=" + book_id_redirect);
  </script>
    <div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a class="site_title"><span> Research Record Management System </span></a>
					</div>
					<div class="clearfix"></div>
			<!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="img/final.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span> <?php echo strtoupper($accname) ?> </span>
                <h2> <?php echo strtoupper($acctype) ?> </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <div class="nav side-menu">
					<ul><a class= "dashboard-active" href="admindashboard.php"> RESEARCH </span></a></ul>
					<ul><a href="updateAcc.php"> UPDATE ACCOUNT </a></ul>
					<ul><a href="accesscode.php"> ACCESS CODE </a> </ul>
                        <?php
                            $d = Date('Y-m-d');
                            $yr = explode("-", $d);


                            echo '<ul><a href="book_reports.php?title=&dept=&status=&author=&from=0&to=' . $yr[0] . '" target="_blank"> REPORTS </a> </ul>';
                          ?>

          <ul><a href="dept.php">DEPARTMENT </a> </ul> </br>
					<ul><a href="index.php"> Back to Home </a> </ul>

                </div>
              </div>

            </div>
          </div>
        </div>


        <?php
          $paper_stat = "";
          $date = "";
          $desc = "";
          //$trail_id = "";
          $origin = "";
          include_once 'connection.php';
          $dbconfig = new dbconfig();
          $conn = $dbconfig->getCon();
          $query = "SELECT paper_trail.id, book.book_title, paper_stat.title, paper_trail.origin, paper_stat.Description, isdone, date FROM paper_trail INNER JOIN book on book.book_id = paper_trail.book_id INNER JOIN paper_stat on paper_stat.id = paper_trail.p_sat_id WHERE paper_trail.book_id = " . $book_id . " and paper_trail.p_sat_id = ". $step;
          //echo $query;

          $result = $conn ->query($query);
          if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $paper_stat = $row['title'];
            $date = $row['date'];
            $desc = $row['Description'];
            $trail_id = $row['id'];
            $origin = $row['origin'];
          }
          
        ?>



        <!-- page content -->
        <div class="right_col" role="main" style= "min-height: 712px;">
			<div id= "admin-frm-search" class= "frm-search" style= "font-size: 18px">
        <div class="container">
          <div class="row">
            <div class="col-md-12" style="font-size: 22pt"><b><i> <?php echo $book_title ?></i> </b></div>
            <div class="col-md-12" ><b style="color: gray"> gggg </b></div>
          </div>
          <br>
          <br>
          

				<!-- -->

        <div id= "instructor-div-voidmain" class= "div-voidmain">
          <div class="container">
            <div class="row">
              <table class="table">
                <thead>
                  <tr>
                    <h3><?php 
                    //$date =  date('l d F Y');
                    $long = strtotime($date);
                    $date = date('F d, Y', $long);
                    $time = date('h:i:s a', $long);

                    echo 'Paper status: <em style="font-size: 18pt; font-weight: bold">' . $paper_stat . '</em>' ?></h3>
                    
                    
                  </tr>
                  <tr>
                    <td scope="col">Description</td>
                    <td scope="col"><?php echo($desc)?></td>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                  
                  
                  <?php

                    
                  ?>

                  
                  
                </tbody>
                
              </table>
              <br>
              
              
              <div class="container" >
                <div class="row" style="">
                  <div class="col-md-6" style="font-size: 16pt; font-weight: bold;">
                    Summary of Comments and Suggestion
                  </div>
                  <div class="col-md-6" style="margin-bottom: 5px">
                    <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#modaladdnew"> Add new comments</button>
                  </div>
                  <div  class="container">
                    
                  </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                  <table class="table" style="border: 1px solid black; border-collapse: collapse;">
                    
                    
                      <?php
                      $dbconfig= new dbconfig();
                      $con= $dbconfig -> getCon();
                      $query= "SELECT * FROM `comments` WHERE `trail_id` = $trail_id";
                      $result = $con -> query($query);
                      if($result->num_rows>0){

                        echo '<thead>
                      <tr>
                        <td scope="col" style="width: 30%; border: 1px solid black; border-collapse: collapse;" ><b>Parts of Manuscript</b></td>
                        <td scope="col" style="width: 50%; border: 1px solid black; border-collapse: collapse;"><b>Comments / Suggestion</b></td>
                        <td scope="col" style="width: 15%; border: 1px solid black; border-collapse: collapse;"><b>Page</b></td>
                        <td scope="col" style="width: 5%; border: 1px solid black; border-collapse: collapse;" colspan="3"><b>Action</b></td>
                        </tr>
                    </thead><tbody>';
                    
                        while ($rowCom = $result->fetch_assoc()) {
                          
                          echo '<tr style="border-collapse: collapse;">
                                  <td scope="col" style=" border: 1px solid black; border-collapse: collapse;">'. $rowCom['parts'] .'</td>
                                  <td scope="col" style=" border: 1px solid black; border-collapse: collapse;">'. $rowCom['comments'] .'
                              </td>
                              <td scope="col" style=" border: 1px solid black; border-collapse: collapse;"> <input class="form-control input-md" id="pageno" type="text" style="font-weight: bold; pattern="[0-9-]{3}" name="'. $book_id .'"readonly value="'. $rowCom['page'] .'">
                              </td>
                              <td scope="col" style="width: 5%; border: 1px solid black; border-collapse: collapse;"><button class="btn btn-danger btn-md" id="page-edit" name="'. $trail_id .'">Edit</button>
                              </td>
                              </tr>';
                      }
                        echo "</tbody>";
                      }else{
                        echo '<thead>
                      <tr>
                        <td scope="col" style="width: 100%; border: 1px solid black; border-collapse: collapse;" ><center>No Comments yet.</center></td>
                        <td scope="col" style="width: 5%; border: 1px solid black; border-collapse: collapse;"><button class="btn btn-danger btn-md" id="page-edit" name="'. $trail_id .'">Edit</button></td>
                        </tr>
                    </thead>';
                      }
                    ?>
                      
                   
                </table>
                </div>
                <div class="row">
                  <button class="btn btn-success" style="float: right;">Save Paper Status</button>
                </div>
              </div>

              <!--login modal-->
                <div class="modal fade" id="modaladdnew" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="modal-title">Add new Comments / Suggestions</h4>
                        </div>
                        <div class="modal-body">
                          <form action="/action_page.php">
                            <div class="container">
                              <div class="form-group">
                                <label for="origin">Originator:</label>
                                
                                    <?php 
                                      $dbconfig= new dbconfig();
                                      $con= $dbconfig -> getCon();
                                      $query= "SELECT * FROM `comments` WHERE `trail_id` = $trail_id";
                                      $result = $con -> query($query);  

                                        if($result->num_rows>0){
                                          $row = $result->fetch_assoc();
                                          echo '<select class="form-control" id="origin" style=" height: auto;line-height: 14px;">
                                        <option>'. $row['origin'] .'</option>
                                    </select>';
                                        }else{
                                          echo '<select class="form-control" id="origin" style=" height: auto;line-height: 14px;">
                                        <option>Research Committee</option>
                                        <option>Internal Reviewers</option>
                                        <option>Panel of Experts</option>
                                        <option>Research Ethics Committee</option>
                                    </select>';
                                        }
                                    ?>
                                
                              </div>
                              <div class="form-group">
                                <label for="parts-man">Parts of Manuscript:</label>
                                <textarea class="form-control" rows="2" id="parts-man"></textarea>
                              </div>
                              <div class="form-group">
                                <label for="comments">Comments / Suggestions:</label>
                                <textarea class="form-control" rows="2" id="comments"></textarea>
                              </div>
                              <div class="form-group">
                                <label for="page-num">Page:</label>
                                <input type="text" class="form-control" id="page-num">
                              </div>
                             
                            
                            </div>

                            
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-success" id="btn-save" <?php echo ' name="' . $trail_id . '"';?> >Save Comments</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                
                <br>
                <br>
                <br>
            </div>
            
          </div>
          
        

       </div>

          <!-- top tiles -->
          <div class="row tile_count"></div>









			</div>
          <!-- top tiles -->
          <div class="row tile_count"></div>
          <!-- /top tiles -->
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

      </div>
    </div>


    <!-- Custom Theme Scripts -->
<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="js/custom.min.js"></script>

    <script src="js/searchdoc.js"></script>

  </body>
</html>
s