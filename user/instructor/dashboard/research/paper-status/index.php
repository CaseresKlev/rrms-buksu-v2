<?php
	$currentDIR =  "research";
  	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  	include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/preload.php";

    $accname = $_SESSION['gname'];
    $acctype = $_SESSION['type'];
    $uid = $_SESSION['uid'];

    $dbconfig = new dbconfig();
    $con = $dbconfig ->getCon();
    if(!isset($_GET['book'])){
    	header("Location: " . PROJECT_ROOT . "404.php");
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
           
          <div class="container">
                <?php

                  
                  $query = "SELECT book.book_title, paper_stat.title, isdone, date FROM paper_trail INNER JOIN book on book.book_id = paper_trail.book_id INNER JOIN paper_stat on paper_stat.id = paper_trail.p_sat_id WHERE book.book_id = ?";
                  $stmt = $con->prepare($query);
                  $stmt->bind_param("i", $_GET['book']);
                  if(!$stmt->execute()){
                  	
                  	echo '<div class="alert alert-danger">We couldn\'t find the history of this research. it may happen that this research was uploaded by a student or uploaded as Finished Research by the Author.</div>';
                  	exit();
                  }

                  $result = $stmt->get_result();
                  if($result->num_rows>0){
                    $row = $result->fetch_assoc();
                  }else{
                  	//header("Location: " . PROJECT_ROOT . "404.php");
                  	echo '<div class="alert alert-danger">We couldn\'t find the history of this research. This may happen when this research was uploaded by a student or uploaded as Finished Research by the Author.</div>';
                  	exit();
                  }

                ?>

               <div class="row"  style="padding-left: 15px">
                   <em><h4><?php echo $row['book_title']; ?><h4></em>
               </div>
               <div class="row"  style="padding-left: 15px">
                   <b style="font-size:12pt;"> Author:
                        <?php
                          $query= "SELECT DISTINCT(a_id) as 'a_id' , a_lname as 'a_lname', SUBSTRING(a_fname, 1, 1) as 'a_fname' FROM author INNER JOIN junc_authorbook on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id =?";
                          $stmt = $con->prepare($query);
                          $stmt->bind_param("i", $_GET['book']);
                          if(!$stmt->execute()){
                          	header("Location: " . PROJECT_ROOT . "404.php");
                          }
                          $result = $stmt->get_result();
                          $autorList ="";
                          if($result->num_rows>0){
                            while ($row1 = $result->fetch_assoc()) {
                            //  $autorList .= $row['a_lname'] . ", " . $row['a_fname'] . "; ";
                            ?>
                            <a href="<?php echo PROJECT_ROOT . 'author/' . '?aut_id=' . $row1['a_id']; ?>" style="text-decoration: underline;">  <?php echo $row1['a_lname'] . ", " . $row1['a_fname'] . "; ";?>
                              </a>
                        <?php }
                      } ?>
                    </b>
               </div>
               <br>
               <br>
               <div class="row bg-dark text-white data-head">
                   Paper Status
               </div>
               <div class="row">
              <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                  <tr>
                    <th scope="col">Step</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>

                  </tr>
                </thead>

                <tbody>
                  <?php

                    $query = "SELECT paper_trail.id, paper_trail.requirements, book.book_title, p_sat_id, paper_stat.title, isdone, date FROM paper_trail INNER JOIN book on book.book_id = paper_trail.book_id INNER JOIN paper_stat on paper_stat.id = paper_trail.p_sat_id WHERE book.book_id =?";
                    $stmt=$con->prepare($query);
                    $stmt->bind_param("i", $_GET['book']);
                    if(!$stmt->execute()){
                    	echo '<h1 class="text-center text-white bg-danger">The page you are looking for is NOT FOUND on this Server!</h1>';
                  		exit();
                    }
                    $result = $stmt->get_result();
                    if($result->num_rows>0){
                      while($rowDis = $result->fetch_assoc()){
                        if($rowDis['requirements']==1){
                           echo '
                              <tr class="clickable-row" data-href="details/?trail='. $rowDis['id'] . '&book=147">
                                <td scope="row">' . $rowDis['p_sat_id'] .'</td>
                                <td scope="row">' . $rowDis['title'] . '</td>
                                <td class="badge bg-success float-left text-white mt-1">
                                  <i class="fas fa-check"></i> &nbsp; Done
                                </td>
                              </tr>
                              ';
                            }else{
                              echo '
                              <tr class="clickable-row" data-href="details/?trail='. $rowDis['id'] . '&book=147">
                                <td scope="row">' . $rowDis['p_sat_id'] .'</td>
                                <td scope="row">' . $rowDis['title'] . '</td>
                                <td class="badge bg-warning float-left text-dark mt-1">
                                  <i class="fas fa-exclamation-circle"></i> 
                                  &nbsp; Missing Requirements
                                </td>
                              </tr>
                              ';
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


    <!-- Popper.JS -->
    <script src="<?php echo(PROJECT_ROOT . "js/popper.min.js")?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo(PROJECT_ROOT . "js/bootstrap.min-4.1.0.js") ?>"></script>
    <script src="<?php echo PROJECT_ROOT . "js/dashboard.js" ?>"></script>

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
      $(".clickable-row").click(function() {
        window.location = $(this).data("href");
        });
    </script>
</body>
</html>
