<?php

  $currentDIR =  basename(__DIR__);
  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  include PROJECT_ROOT_NOT_LINK . "user/student/dashboard/preload.php";

    $accname = $_SESSION['gname'];
    $acctype = $_SESSION['type'];
    $uid = $_SESSION['uid'];

    $dbconfig = new dbconfig();
    $con = $dbconfig ->getCon();
    $stmt = $con->prepare("SELECT book.book_id, book.book_title FROM `junc_authorbook` INNER JOIN book on book.book_id = junc_authorbook.book_id WHERE junc_authorbook.aut_id = ?");
    //print_r($_SESSION);
    $stmt->bind_param("i",$_SESSION['owner']);
   // $owner = 12;
    //$stmt->bind_param("i",$owner);
    $stmt->execute();
    $author = null;
    $result = $stmt->get_result();
    
    

    //echo $uid;
  /* if($acctype==="admin"){
    //echo "Admin ANG NAKALOGIN";
  }else if($acctype==="INSTRUCTOR"){
    //echo "Instructor ang naka login";

    header("Location: instructordashboard.php");
  }else if($acctype==="student"){
    header("Location: index.php");
  }*/



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
        
         <?php  include PROJECT_ROOT_NOT_LINK . "user/student/dashboard/sidebar.php"  ?>

        <!-- Page Content  -->
        <div id="content">
          <!-- Toggle Menu  -->
            <?php include PROJECT_ROOT_NOT_LINK . "user/student/dashboard/toggle_menu.php"; ?>


           <!---- PLACE YOUR DIVS HERE --->
           
           <div class="container" style="padding-bottom: 15px; background-color: #e1e1d0; min-height: 80%;">
            <div class="row bg-dark text-white data-head">
              My Researches
              <a href="add/" class="badge badge-success ml-auto" style="margin: auto; margin-right: 10px;"><i class="fas fa-plus"></i> Add</a>
            </div>
              <?php
            if($result->num_rows>0){
              while ($row=$result->fetch_assoc()) {
                echo '<div class="container research-entry" >
            <div class="row title bg-info">
              <div class="col-md-10 col-sm-10 left-holder text-white"  >
              "'. $row['book_title'] .'"
              </div>
              <div class="col-md-2 col-sm-2 button-holder" >
                <a href="view/?book='. $row['book_id'] .'" class="badge badge-light mr-auto"><i class="fas fa-eye"></i> View</a>
                <a href="view/?book='. $row['book_id'] .'" class="badge badge-warning mr-auto" style="margin-bottom: 10px;"><i class="fas fa-pencil-alt"></i> Edit</a>
              </div>
            </div>
          </div>';
              }
               
            }else{
              echo '<div class="bg-danger text-center text-white rounded" style="">
               <!--<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>-->
               <button type="button" class="close btn-danger" style="margin-right: 10px;" onclick="this.parentElement.style.display=\'none\'"; aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
               You dont have research added yet.
           </div>';
            }
           ?>
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
    </script>
</body>
</html>
