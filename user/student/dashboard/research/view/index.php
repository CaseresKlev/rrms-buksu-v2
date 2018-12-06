<?php

  session_start();
  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");

  include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
  include PROJECT_ROOT_NOT_LINK . 'server_script/crypt.php';
  if(isset($_SESSION['uid']) && $_SESSION['type']==="STUDENT"){
    //print_r($_SESSION);
  }else{
    header("Location: " . PROJECT_ROOT );
  }

    $accname = $_SESSION['gname'];
    $acctype = $_SESSION['type'];
    $uid = $_SESSION['uid'];

    $dbconfig = new dbconfig();
    $con = $dbconfig ->getCon();
    $query = "SELECT `a_id`, `a_fname`, `a_mname`, `a_lname`, `a_suffix`, `bib`, `a_add`, `a_contact`, `a_email`, `a_pic` FROM `author` WHERE `login` = " . $uid;

    $author = null;
    $result = $con->query($query);
    if($result->num_rows>0){
        $author = $result->fetch_assoc();
        //print_r($author);
    }
    

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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
        
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4>Research Record Mangement System</h4>
            </div>
            <div class="sidebar-header">
                <i class="fas fa-user-circle fa-3x"></i>
                <span style="position: absolute; margin-left: 10px">
                  <h5 style="color: #BDB5B5"><?php echo strtoupper($accname) ?></h5>
                  <h6> <?php echo strtoupper($acctype) ?></h6>
                </span>
            </div>
            <ul class="list-unstyled components" style="margin-left: 10%">
                <li id="link-myProfile">
                    <a href="../../profile">My Profile
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
                <li class="active">
                    <a href="../">My Research</a>
                </li>
                <li>
                    <a href="../../account/" >My Account</a>
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
                <!--<li>
                    <a href="book_reports.php?title=&dept=&status=&author=&from=0&to=2018" target="_blank">Reports</a>
                </li>
                <li>
                    <a href="dept.php">Department</a>
                </li>-->
            </ul>

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
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo PROJECT_ROOT; ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo PROJECT_ROOT . "logout.php"?>">Logout</a>
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

           <?php  
            if(isset($_GET[',msg'])){

              $alertType = "info";
              if(isset($_GET['alertType'])){
                $alertType = $_GET['alertType'];
              }
              //echo "$alertType";
              echo '
              <div class="bg-'. $alertType .' text-center text-white rounded" style="">
               <!--<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>-->
               <button type="button" class="close btn-danger" style="margin-right: 10px;" onclick="this.parentElement.style.display=\'none\'"; aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
               '. $_GET['updateProfileMessage'] .'
           </div>';
            }

           ?>

  

      <div class="container custom-content" id="myProfile">
        <div class="row">
          <div class="btn btn-warning ml-auto" id="btn-editProfile"style="margin: 15px 0px 0px 0px">Edit profile</div>
        </div>
        <div class="container data-group">
               <div class="row bg-secondary text-white data-head">
                        Tittle:
               </div>
               <div class="row data-content">
                "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
               </div>
            </div>
            <div class="container data-group">
               <div class="row bg-secondary text-white data-head">
                        Author(s):
               </div>
               <div class="row data-content">
                <ul>
                  <li>  
                    <a href="<?php echo PROJECT_ROOT . "author/?aut_id=2"?>">Klevie Jun R. Caseres</a>
                  </li>
                  <li>  
                    <a href="<?php echo PROJECT_ROOT . "author/?aut_id=2"?>">Klevie Jun R. Caseres</a>
                  </li>
                </ul>
               </div>
            </div>
            <div class="container data-group">
               <div class="row bg-secondary text-white data-head">
                        Date Submitted:
               </div>
               <div class="row data-content">
                    December 21, 2018
               </div>
            </div>
            <div class="container data-group">
               <div class="row bg-secondary text-white data-head">
                        Department:
               </div>
               <div class="row data-content">
                    Information Technology - College of Arts and Sciences
               </div>
            </div>
            <div class="container data-group">
               <div class="row bg-secondary text-white data-head">
                        Status:
               </div>
               <div class="row data-content">
                    Unpublished
               </div>
            </div>
            <div class="container data-group">
               <div class="row bg-secondary text-white data-head">
                        Abstract:
               </div>
               <div class="row data-content">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
               </div>
            </div>
            <div class="container data-group">
               <div class="row bg-secondary text-white data-head">
                        Keywords:
               </div>
               <div class="row data-content">
                   <a href="<?php echo PROJECT_ROOT . "research/?key=" . "Naruto" ?>">Naruto</a> , &nbsp; <a href="<?php echo PROJECT_ROOT . "research/?key=" . "Naruto" ?>">Research Management</a>
               </div>
            </div>
            <div class="container data-group">
               <div class="row bg-secondary text-white data-head">
                        History:
               </div>
               <div class="row data-content">
                   <ul>
                     <li>Submitted on January 31, 2018</li>
                   </ul>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    <script src="<?php echo PROJECT_ROOT . "js/student_dashboard.js" ?>"></script>

    <script type="text/javascript">
      //$('#suf').val($('#suf').val());
      var s = $('#suf-val').val();
      $('#suf').val(s).change();
      //alert(s);
    </script>
</body>
</html>