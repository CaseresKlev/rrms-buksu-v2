<?php


  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");  
  include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/preload.php";
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

  $query = "DELETE FROM `acesskey` WHERE `ins_id` = ? and `used` = 1;";
  $stmt = $con->prepare($query);
  $stmt->bind_param("i", $_SESSION['uid']);
  
  if(!$stmt->execute()){};
 
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
        
         <?php  include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/sidebar.php"  ?>

        <!-- Page Content  -->
        <div id="content">
          <!-- Toggle Menu  -->
            <?php include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/toggle_menu.php"; ?>


           <!---- PLACE YOUR DIVS HERE --->
           

           <div class="alert alert-info" role="alert" >
            <button type="button" class="close" onclick="this.parentElement.style.display='none'"; aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              This access codes can be used by the student to create account.
            </div>

           <div class="form-group mb-2 mt-5">
              <form class="form-inline" method="POST" action="generate/">
                <div class="form-group mb-2">
                  <label for="staticEmail2" class="font-weight-bold">Number of Access Codes: </label>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                  <label for="inputPassword2" class="sr-only">Password</label>
                  <!--<input class="form-control" type="number" placeholder="0" id="ccess-count" name="number" min="0" maxlength="" required>-->
                  <input name="count"
                    oninput="javascript: setCustomValidity(''); if (this.value > this.maxLength) this.value = this.value = this.maxLength"
                    type = "number"
                    maxlength = "50"
                    min="1" 
                    required 
                    class="form-control" 
                    placeholder="0"
                    oninvalid="this.setCustomValidity('Please provied number of access codes. Maximum 50.')"

                 />
                </div>
                <button type="Submit" class="btn btn-primary mb-2" id= "instructor-frm-generate"> Generate </button>
              </form>
            </div>


            <div class="container mt-5">
                  <div id="printtable">
        <table style="width:100%"border="1" cellpadding="3" id="tbl-accescodes"  style="font-size: 15px; " >
          <h5> Available Student Codes <span class="btn btn-primary float-right mb-2" onclick="printDiv(this)">Print</span> </h5> 
          <tr class="access-tr-head">
            <th id="access-th">Count</th>
            <th id="access-th">Access Codes</th>
            <th id="access-th">Type</th>
          </tr>
          <?php
            $id = $_SESSION['uid'];
            $query = "SELECT * FROM `acesskey` WHERE used=0 and type='STUDENT' and ins_id = $id";
            $result = $con->query($query);
            //print_r($result);
            if($result->num_rows>0){
              $i=1;
              while($row=$result->fetch_assoc()){
                echo "<tr class=\"access-tr-head\">
                    <th id=\"access-th\">$i</th>
                      <th id=\"access-th\">" . $row['acesskey'] . "</th>
                        <th id=\"access-th\">" . $row['type'] . "</th>
                    </tr>";
                    $i++;
              }
            }


          ?>

        </table>
      </div>
      <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>

            </div>
            

           <!---- AYAW NAG LAPAS DIRI --->
        </div>
    </div>


    <!-- Popper.JS -->
    <!--<script src="<?php echo PROJECT_ROOT . "js/accesscodes.js" ?>"></script>-->
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

        function printDiv(btn) {
          $(btn).hide();
         window.frames["print_frame"].document.body.innerHTML = "<br><b>" + 
          document.getElementById("printtable").innerHTML;
         //alert(window.frames["print_frame"].document.body.innerHTML = document.getElementById("printtable").innerHTML);
         window.frames["print_frame"].window.focus();
         window.frames["print_frame"].window.print();
         $(btn).show();
        }
    </script>
</html>