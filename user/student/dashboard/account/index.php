<?php


  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");  
  include PROJECT_ROOT_NOT_LINK . "user/student/dashboard/preload.php";
  $currentDIR =  basename(__DIR__);

  

  $dbconfig = new dbconfig();
  $con = $dbconfig ->getCon();
  $query = "SELECT `a_id`, `a_fname`, `a_mname`, `a_lname`, `a_suffix`, `bib`, `a_add`, `a_contact`, `a_email`, `a_pic` FROM `author` WHERE `login` = " . $uid;
  $author = null;
  $result = $con->query($query);
  if($result->num_rows>0){
      $author = $result->fetch_assoc();
      //print_r($author);
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
    <script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.slim.min.js")?> "></script>

    <link rel="stylesheet" type="text/css" href="<?php echo(PROJECT_ROOT . "css/bootstrap-min-4.1.0.css"); ?>">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/dashboard.css"); ?>">
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/Animate.css"); ?>">
    <!-- scrollbar -->
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/custom_scroll.css"); ?>">

    <script defer src="<?php echo(PROJECT_ROOT . "js/solid.js"); ?>"></script>
    <script defer src="<?php echo(PROJECT_ROOT . "js/fontawesome.js"); ?>"></script>
    <script defer src="<?php echo(PROJECT_ROOT . "js/bootstrap-notify.js"); ?>"></script>
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
           					<form method="POST"  action="validate/changepass.php">
           						<div class="row bg-secondary text-white data-head">  
				                        Change Password:
				                </div>
				                <div class="form-group">
				                	<label for="curpass">Password: <span class="text-danger">*</span></label>
				                	<input type="password" class="form-control" name="curpass" id="curpass" required pattern="(?=.*\d)(?=.*[a-z A-Z]).{8,}" title="Should Contain Letters and Numbers. Minimum of 8 characters" placeholder="Current password">
				                </div>
				                <div class="form-group">
				                	<label for="newpass">Enter new Password:<span class="text-danger">*</span></label>
				                	<input type="password" class="form-control" name="newpass" id="newpass" required pattern="(?=.*\d)(?=.*[a-z A-Z]).{8,}" title="Should Contain Letters and Numbers. 8Minimum of 8 characters" placeholder="New Password">
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
           				<div class="col-md-6 col-sm-12 mb-5 align-middle">
           					<form method="POST"  action="validate/update_account.php">
				           		<div class="container">
					           		<div class="row bg-secondary text-white data-head">  
					                        Update Account as Instructor: 
					                </div>
					                <div class="form-group">
					                	<label for="accesscodes">Access Code:<span class="text-danger">*&nbsp;&nbsp;</span><span class="badge badge-warning">Note: After updating your account you will be logout.</span></label>
					                	<input type="text" class="form-control" name="accesscodes" id="accesscodes" required pattern=".{8,}" title="Should Contain 8 Character Valid Access Codes" placeholder="Instructor Access Codes" maxlength="8">
					                </div>

					                <div class="form-group">
				           				<input class="form-control btn btn-primary" type="Submit" name="Submit">
				           			</div>
				           		</div>
				           </form>
           				</div>
           			</div>
           		</div>
           
           <br>
           
            

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
</html>