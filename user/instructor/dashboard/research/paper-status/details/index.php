<?php
	$currentDIR =  "research";
  	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  	include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/preload.php";

    $accname = $_SESSION['gname'];
    $acctype = $_SESSION['type'];
    $uid = $_SESSION['uid'];

    $dbconfig = new dbconfig();
    $con = $dbconfig ->getCon();
    if(!isset($_GET['book']) || !isset($_GET['trail'])){
    	header("Location: " . PROJECT_ROOT . "404.php?msg=We cannot find or you do not have the previledge to access the page you are looking for.");
    }

    $query = "SELECT  paper_trail.p_sat_id, paper_trail.file_loc, paper_trail.requirements, paper_trail.isdone, paper_stat.hasrequired FROM paper_trail INNER JOIN paper_stat on paper_trail.p_sat_id = paper_stat.id WHERE paper_trail.id = ?";
  	$fileLoc = "";
  	$required = "";
   $step_z = "";

   $stmt = $con->prepare($query);
   $stmt->bind_param("i", $_GET['trail']);
   if(!$stmt->execute()){
   		header("Location: " . PROJECT_ROOT . "404.php?msg=We cannot find the page you are looking for.");
   }
   $result = $stmt->get_result();
   if($result->num_rows>0){
      $row0 = $result->fetch_assoc();
      $fileLoc = $row0['file_loc'];
      $required = $row0['hasrequired'];
      $step_z = $row0['p_sat_id'];
   }
   $str = explode("/", $fileLoc)


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
        <!-- jQuery CDN - Slim version (=without AJAX) -->
    <link rel="stylesheet" type="text/css" href="<?php echo(PROJECT_ROOT . "css/bootstrap-min-4.1.0.css"); ?>">
    <script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.slim.min.js")?> "></script>
    <script type="text/javascript" src="<?php echo(PROJECT_ROOT . "js/bootstrap.min-4.1.0.js") ?>"></script>
    
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/dashboard.css"); ?>">
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/Animate.css"); ?>">
    <!-- scrollbar -->
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/custom_scroll.css"); ?>">

    <script defer src="<?php echo(PROJECT_ROOT . "js/solid.js"); ?>"></script>
    <script defer src="<?php echo(PROJECT_ROOT . "js/fontawesome.js"); ?>"></script>
        <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
          position: fixed;
          left: 0px;
          top: 0px;
          width: 100%;
          height: 100%;
          z-index: 9999;;
          background: url(<?php echo PROJECT_ROOT . 'img/loader-64x/Preloader_3.gif'?> ) center no-repeat #fff;
        }
        </style>
        
</head>
<script type="text/javascript">
          $(window).on('load', function () {
      //alert("Window Loaded");
      // Animate loader off screen
            jQuery(".se-pre-con").hide();
      //$(".se-pre-con").fadeOut("slow");
        });
</script>

<body>
    <!-- Paste this code after body tag -->
    <div class="se-pre-con"></div>
    <!-- Ends -->
	<div class="wrapper">
        <!-- Sidebar  -->
        
         <?php  include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/sidebar.php"  ?>

        <!-- Page Content  -->
        <div id="content">
          <!-- Toggle Menu  -->
            <?php include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/toggle_menu.php"; ?>


           <!---- PLACE YOUR DIVS HERE --->

           
          <?php
          $paper_stat = "";
          $date = "";
          $desc = "";
          //$trail_id = "";
          $origin = "";
          $query = "SELECT paper_trail.id, paper_trail.file_alias, book.book_title, paper_stat.title, paper_stat.Description, isdone, date FROM paper_trail INNER JOIN book on book.book_id = paper_trail.book_id INNER JOIN paper_stat on paper_stat.id = paper_trail.p_sat_id WHERE paper_trail.id = ?";
          //echo $query;
          $file_alias = "";
          $stmt = $con->prepare($query);
          $stmt->bind_param("i", $_GET['trail']);
          if(!$stmt->execute()){
          	echo '<h1 class="text-center bg-danger text-white">The page you are looking for is not found on this server</h1>';
          	exit();
          }
          $result = $stmt->get_result();
          if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $paper_stat = $row['title'];
            $date = $row['date'];
            $desc = $row['Description'];
            $trail_id = $row['id'];
            $book_title = $row['book_title'];
            $file_alias = $row['file_alias'];
            //$origin = $row['origin'];
          }else{
          	echo '<h1 class="text-center bg-danger text-white">The page you are looking for is <br>NOT FOUND on this server!</h1>';
          	exit();
          }

        ?>
          <div class="container rounded" style="box-shadow: 0 5px 2px -2px gray;">
              <div class="row ml-1">
                <h5>Title: <?php echo $book_title ?></h5>
              </div>
              <div class="row ml-1">
                <h6>Author: 
                  <?php
                      $dbconfig= new dbconfig();
                      $con= $dbconfig -> getCon();
                      $query= "SELECT DISTINCT(a_id) as 'a_id' , a_lname as 'a_lname', SUBSTRING(a_fname, 1, 1) as 'a_fname' FROM author INNER JOIN junc_authorbook on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id =?";
                      $stmt = $con->prepare($query);
                      $stmt->bind_param("i", $_GET['book']);
                      if(!$stmt->execute()){
                        echo '<h1 class="text-center bg-danger text-white">The page you are looking for is not found on this server</h1>';
                  exit();
                      }
                      $result = $stmt->get_result();
                      $autorList ="";
                      if($result->num_rows>0){
                        while ($row1 = $result->fetch_assoc()) {
                        //  $autorList .= $row['a_lname'] . ", " . $row['a_fname'] . "; ";
                        ?>
                        <a class="navbar-link" href="<?php echo PROJECT_ROOT . "author/?aut_id=" . $row1['a_id']; ?>"><u>  <?php echo $row1['a_lname'] . ", " . $row1['a_fname'] . "; ";?></u>
                          </a>
                    <?php }
                  }else{
                    echo '<h1 class="text-center bg-danger text-white">The page you are looking for is not found on this server</h1>';
                exit();
                  } ?>

                </h6>
              </div>
              <div class="row ml-1 mt-5">
                <h5>Paper status: <?php echo $paper_stat; ?></h5>
              </div>
              <div class="row ml-1">
                <h6>Description: <?php echo($desc)?></h6>
              </div>
              <div class="row ml-1">
                <h6>Date: 
                  <?php 
                    //$date =  date('l d F Y');
                    $long = strtotime($date);
                    $date = date('F d, Y', $long);
                    $time = date('h:i:s a', $long);
                    echo $date . " at " . $time 
                  ?>
                  
                </h6>
              </div>

              <a href="../?book=<?php echo $_GET['book'] ?>"><div class="btn btn-primary float-right">View All Status</div></a>
          </div>
          <br>
          
          
          
              <?php
              
              
                
              if($required!==""){

                  if($required==="paper"){
                    
                      if($fileLoc===""){

                        echo '<p id="fileloc" style="display: none;">'. $fileLoc .'</p>
          <p id="trail_id" style="display: none;">'. $trail_id .'</p>';
                        //echo "<h1>$paper_stat</h1>";
                        if($paper_stat!=="Final Paper"){
                            include 'required_paper_empty.php';
                          }else{
                            include 'required_paper_final.php';
                          }
                      }else{
                        include 'required_paper_added.php';
                      }

                  }elseif ($required==="pub") {
                    $con= $dbconfig -> getCon();
                    $query= "SELECT book.book_title, published.issn, published.journal, published.type, published.date FROM published INNER JOIN book ON book.book_id = published.book_id WHERE published.book_id = " . $_GET['book'];
                    //echo $query;
                    $result = $con -> query($query);
                    if($result->num_rows>0){
                      include 'required_publication_added.php';
                    }else{
                      include 'required_publication_empty.php';
                    }

                  }elseif ($required==="dis"){
                    echo '<p id="book_id" style="display: none">'. $_GET['book'] .'</p>';
                    $con= $dbconfig -> getCon();
                    $query= "SELECT book.book_title, disseminated.type, disseminated.convension, disseminated.location, disseminated.date FROM `disseminated` inner JOIN book on disseminated.book_id = book.book_id WHERE disseminated.book_id = " . $_GET['book'];
                    $result = $con -> query($query);

                    if($result->num_rows>0){
                      include 'required_dissemination_added.php';
                    }else{
                      include 'required_dissemination_empty.php';
                    }

                }elseif ($required==="awards"){
                    ///echo "string";
                    $con= $dbconfig -> getCon();
                    $query= "SELECT book.book_title, awards.awards, awards.parties, awards.location, awards.description, awards.date from awards INNER JOIN book on book.book_id = awards.book_id WHERE awards.book_id = " . $_GET['book'];
                    $result = $con -> query($query);

                    if($result->num_rows>0){
                      include 'required_awards_added.php';
                    }else{
                         include 'required_awards_empty.php';
                    }

                }elseif ($required==="util"){
                    ///echo "string";
                    $con= $dbconfig -> getCon();
                    $query= "SELECT book.book_title, utilize.orgname, utilize.orgaddress, utilize.date from utilize INNER JOIN book on book.book_id = utilize.book_id WHERE utilize.book_id = " . $_GET['book'];
                    $result = $con -> query($query);

                      if($result->num_rows>0){
                        include 'required_utilization_added.php';
                      }else{
                        include 'required_utilization_empty.php';
                      }

                }

              }

              ?>

              <?php

                $dbconfig= new dbconfig();
                $con= $dbconfig -> getCon();
                $query= "SELECT * FROM `comments` WHERE `trail_id` = $trail_id";
                $result = $con -> query($query);
                $row = $result->fetch_assoc();
                $origin = $row['origin'];

                if($result->num_rows>0){
                  include 'comments.php';
                }

              ?>
          







              <?php
                      $dbconfig= new dbconfig();
                      $con= $dbconfig -> getCon();
                      $query= "SELECT * FROM `comments` WHERE `trail_id` = $trail_id";
                      $result = $con -> query($query);
                      $row = $result->fetch_assoc();
                      $origin = $row['origin'];

              ?>
              
              
            <!--addnew  modal-->
                

                  

                  <!--dissemination modal-->
                  <div class="modal fade" id="modaldis" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">

                          <h4 class="modal-title" id="modal-title-dis">Supporting Documents:</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form id="dis-form">

                            <div class="form-group">
                              <input type="file" name="myFile[]" id="dis-cert" class="form-control"
                                style= "font-size: 15px; font-weight: bold;" multiple>
                            </div>


                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="instructor-btn-dis-save" class="btn btn-success" style="float: right">SAVE</button>
                        </div>
                      </div>

                    </div>
                  </div>

           
          
          
          

  

           
           	
           
             
                   
           <!---- AYAW NAG LAPAS DIRI --->
        </div>

    </div>


    <!-- Popper.JS -->
    <script src="<?php echo(PROJECT_ROOT . "js/popper.min.js")?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo(PROJECT_ROOT . "js/bootstrap.min-4.1.0.js") ?>"></script>
    <script src="<?php echo PROJECT_ROOT . "js/searchdoc.js" ?>"></script>
    <script src="<?php echo PROJECT_ROOT . "js/dashboard.js" ?>"></script>
    <!--<script src="<?php echo PROJECT_ROOT . "js/on-process.js" ?>"></script>-->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>


    <script type="text/javascript">
      //$('#suf').val($('#suf').val());
      var s = $('#suf-val').val();
      $('#suf').val(s).change();
      //alert(s);

      function showModal(modal){
      	//alert(modal);
      	$(modal).modal("toggle");
      }
    </script>
</body>
</html>
