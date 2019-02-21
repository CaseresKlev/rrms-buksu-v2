<?php


  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  $loaded = true; 
  $cur = "publication";  
  include PROJECT_ROOT_NOT_LINK . "user/admin/dashboard/preload.php";
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
    <!--<script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.slim.min.js")?> "></script>-->
    <script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.js")?> "></script>
    <script src="<?php echo(PROJECT_ROOT . "user/admin/dashboard/js/jquery.form.min.js")?> "></script>
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
        
         <?php  include PROJECT_ROOT_NOT_LINK . "user/admin/dashboard/sidebar.php"  ?>

        <!-- Page Content  -->
        <div id="content">
          <!-- Toggle Menu  -->
            <?php include PROJECT_ROOT_NOT_LINK . "user/admin/dashboard/toggle_menu.php"; ?>


           <!---- PLACE YOUR DIVS HERE --->
           
          <?php

            if(isset($_GET['msg']) && (!isset($_GET['bid']) || empty($_GET['bid']))){

              $alertType = "info";
              if(isset($_GET['alertType'])){
                $alertType = $_GET['alertType'];
              }
              //echo "$alertType";
              echo '
              <div class="alert alert-'. $alertType .' text-center rounded" style="margin-bottom: 40px;">
               <!--<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>-->
               <button type="button" class="close btn-danger" style="margin-right: 10px;" onclick="this.parentElement.style.display=\'none\'"; aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
               '. $_GET['msg'] .'
           </div>';
            }

            if(isset($_GET['bid']) && !empty($_GET['bid'])){
              $stmt = $con->prepare("SELECT book.book_id, book.book_title, CONCAT(author.a_lname, ', ', SUBSTRING(author.a_fname, 1, 1), '. ', author.a_suffix) as name FROM junc_authorbook j1 INNER JOIN book on book.book_id = j1.book_id INNER JOIN author on author.a_id = j1.aut_id WHERE j1.`book_id` = ?");
              $stmt->bind_param('i', $_GET['bid']);
              $stmt->execute();
              $res = $stmt->get_result();
              $bid = 0;
              if($res->num_rows>0){
              	$one = true;
                while($row = $res->fetch_assoc()){
                	if($one){
		                		echo '<div class="h2">'. $row['book_title'] .'</div>
		              	<footer class="blockquote-footer">';
		                	$bid = $row['book_id'];
		                	$one = false;
                	}
                	
                echo '
                <cite title="Source Title">'. $row['name'] .'</cite>';
                }
                echo '</footer>';

                include(PROJECT_ROOT_NOT_LINK . "user/admin/dashboard/paper/publication/list-table.php");
                
              }else{
                include(PROJECT_ROOT_NOT_LINK . "user/admin/dashboard/paper/searchPaper.php");
              }
              
            }else{

              include(PROJECT_ROOT_NOT_LINK . "user/admin/dashboard/paper/searchPaper.php");
            }

          ?>



          <?php
          /*
            $stmt = $con->prepare("SELECT * FROM `department` WHERE `college` = 'Faculty'");
            $stmt->execute();
            $res = $stmt->get_result();
            $deptName = "Uncategorized";
            $deptID = 0;
            if($res->num_rows>0){
              $row = $res->fetch_assoc();
              $deptID = $row['id'];
              $deptName = $row['college'];
            }
            
            echo $deptName . " " . $deptID;
            $title = "The Hamming Bird V2!/]";
            $link = str_replace(' ', '-', $title);
            $link = preg_replace('/[^a-zA-Z0-9-]/', '', $link);
            echo " " . $title;


            $stmt->prepare("INSERT INTO `book` (`book_id`, `book_title`, `abstract`, `pub_date`, `department`, `keywords`, `refrences`, `rev_count`, `status`, `enabled`, `views_count`, `cited`, `cover`, `docloc`, `link`, `aut_type`, `dowloadable`, `refkey`) VALUES (NULL, ?, '', CURRENT_TIMESTAMP, ?, '', '', '0', 'Unpublished', '1', '0', '0', '', '', ?, 'instructor', '0', '')");
            $stmt->bind_param("sis", $title, $deptID, $link);
            $stmt->execute();
            $book_id = $stmt->insert_id;
            echo " BookID: " . $book_id;

            $file2write = '<?php    
                include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/page_template/research/entry.php");

              ?>';

            $result = $con->query("SELECT YEAR(`pub_date`) as year, `aut_type`, `link`  FROM `book` WHERE book_id = " . $book_id);
            $filePath = "";
            if($result->num_rows>0){
              $row = $result->fetch_assoc();
              $filePath.= $_SERVER['DOCUMENT_ROOT'] . "/rrms-buksu/research/". $row['year'] . "/" . $row['aut_type'] . "/" . $row['link'] . "/index.php";
              $aut_type = $row['aut_type'];
              $year =  $row['year'];
              //echo $filePath;
              file_force_contents($filePath, $file2write);
            } else{
              echo '<h3>We are sorry. Something went wrong. Go <a href="'. PROJECT_ROOT .'">home</a></h3> <em> Caused by: Submiting your Document.</em>';
            }






            function file_force_contents($dir, $contents){
                $parts = explode('/', $dir);
                $file = array_pop($parts);
                $dir = '';
                foreach($parts as $part){
                    if(!is_dir($dir .= "$part/"))
                       mkdir($dir);
                                   
                }

                $saved_file = file_put_contents("$dir/$file", $contents);
                //echo "$dir/$file";
                if (($saved_file === false) || ($saved_file == -1)) {
                  //print "Couldn't make file";
                  return false;
                }else{
                  return true;
                }
            }

            */
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