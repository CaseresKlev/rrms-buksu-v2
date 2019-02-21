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

  
  
  $stmt = $con->prepare("DELETE FROM push_notification where (DATe(date)<(select now() - interval 2 day) AND receiver = ? and seen=1) order by seen ASC");
  $stmt->bind_param("i", $_SESSION['owner']);
  $stmt->execute();
 
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
          <?php
            $stmt = $con->prepare('SELECT `id`, CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1, 1), ". ", author.a_lname, " ", author.a_suffix) as "sender", `description`, `link`, `date`, seen FROM `push_notification` JOIN author ON author.a_id = sender WHERE `receiver` = ? order by date DESC Limit 30');
            $stmt->bind_param('i', $_SESSION['owner']);
            $stmt->execute();
            $res = $stmt->get_result();
            if($res->num_rows>0){
              while($row = $res->fetch_assoc()){
                //if($row[''])
                $link = str_replace('[xxxxx]', strtolower($_SESSION['type']), $row['link']);
                //echo $link;

                echo '<a href="'. $link .'">
           <div class="alert alert-info">
           <i class="fas fa-bell fa-lg"></i> &nbsp;
             <strong>'. $row['sender'] .'</strong> '. $row['description'] .' Last '. date("F j, Y, g:i a", strtotime($row['date'])); 

              if($row['seen']==0){
                echo '&nbsp;<i class="fas fa-circle text-danger">';
              }

             echo'
           </i></div>
          </a>';
              }
            }else{
              echo '<div class="alert alert-danger">No Notification available.</div>';
            }

          ?>
          
          <?php
            $stmt = $con->prepare('UPDATE `push_notification` SET `seen` = 1 WHERE `receiver` = ?');
            $stmt->bind_param("i", $_SESSION['owner']);
            $stmt->execute();


          ?>
           
            

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