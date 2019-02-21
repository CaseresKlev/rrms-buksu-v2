<?php
  $currentDIR = "";
  session_start();
  $cur = "account";
  $loaded = false;
  if(isset($_SESSION['uid'])){
    //print_r($_SESSION);
  }else{
    header("Location: index.php");
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
    <link rel="stylesheet" href="css/dashboard.css">

    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>

</head>
<body>
	<div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'sidebar.php' ?>

        <!-- Page Content  -->
        <div id="content">

            <?php include 'toggle_menu.php'; ?>


           <!---- PLACE YOUR DIVS HERE --->
           <?php  
            if(isset($_GET['msg'])){

              $alertType = "info";
              if(isset($_GET['alertType'])){
                $alertType = $_GET['alertType'];
              }
              //echo "$alertType";
              echo '
              <div class="bg-'. $alertType .' text-center text-white rounded mb-5" style="">
               <!--<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>-->
               <button type="button" class="close btn-danger" style="margin-right: 10px;" onclick="this.parentElement.style.display=\'none\'"; aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
               '. $_GET['msg'] .'
           </div>';
            }

           ?>

            <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-5">
                            <form method="POST"  action="changepass.php">
                                <div class="row bg-secondary text-white data-head">  
                                        Change Password:
                                </div>
                                <div class="form-group">
                                    <label for="curpass">Password: <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="curpass" id="curpass" required pattern="(?=.*\d)(?=.*[a-z A-Z]).{8,}" title="Should Contain Letters and Numbers. Minimum of 8 characters" placeholder="Current password">
                                </div>
                                <div class="form-group">
                                    <label for="newpass">Enter new Password:<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="newpass" id="newpass" required pattern="(?=.*\d)(?=.*[a-z A-Z]).{8,}" title="Should Contain Letters and Numbers. Minimum of 8 characters" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <label for="matchpass">Retype current password:<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="matchpass" id="matchpass" required pattern="(?=.*\d)(?=.*[a-z A-Z]).{8,}" title="Should Contain Letters and Numbers. Minimum of 8 characters" placeholder="Confirm new password">
                                </div>
                                <div class="form-group badge badge-warning hint" style="display: none">
                                    Password did not Match
                                </div>
                                <div class="form-group">
                                    <input class="form-control btn btn-primary" id="submit" type="Submit" name="Submit" disabled>
                                </div>

                            </form> 
                        </div>
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
    <script src="js/dashboard.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

<!--    <script src="js/searchdoc.js"></script>-->
 <script type="text/javascript" src="js/jquery-3.3.1.js"></script>

        <script type="text/javascript" src="js/updateAccount.js"></script>



</body>
</html>
