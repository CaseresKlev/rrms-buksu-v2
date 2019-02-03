<?php
	
	session_start();
  	$cur = "post";

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

    <link type="text/css" rel="stylesheet" href="css/jquery-te-1.4.0.css">
    <link type="text/css" rel="stylesheet" href="css/jodit.css">

    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>
    <script src="js/jodit.js"></script>


</head>
<body>
	<div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <?php include 'toggle_menu.php'; ?>


           <!---- PLACE YOUR DIVS HERE --->
           <div class="container">
            <?php 

            if(isset($_GET['msg'])){

              $alertType = "info";
              if(isset($_GET['alertType'])){
                $alertType = $_GET['alertType'];
              }
              //echo "$alertType";
              echo '
              <div class="alert alert-'. $alertType .' text-center text-dark rounded mb-5" style="">
               <!--<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>-->
               <button type="button" class="close" style="margin-right: 10px;" onclick="this.parentElement.style.display=\'none\'"; aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
               '. $_GET['msg'] .'
           </div>';
            }

           ?>
            <div class="row bg-dark text-white p-1">
              <div class="my-auto h5">
                Post
              </div>
              <div class="btn btn-primary btn-sm ml-auto">
                <a href="banner.php">Add new</a>
              </div>
            </div>
            <div class="row">
              <table class="table table-hover table-striped table-condensed border border-bottom-3" >
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Publisher</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col" colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $page = 1;
                  $numPerPage = 10;
                  $maxPaginationButton = 10;
                  $curBlock = 1;
                  if(isset($_GET['page']) && !empty(isset($_GET['page']))){
                    $page = $_GET['page'];
                  }else{
                    $page = 1;
                  }
                  
                  
                  $query = "SELECT * FROM `post` order by post_date";
                  $stmt = $con->prepare($query);
                  //include 'ClassPagination.php';
                  //$classPagination = new PaginationClass();
                  //$classPagination->runQuery($query);
                  

                  $stmt->execute();
                  $offset = ($page-1) * $numPerPage;
                  $res = $stmt->get_result();
                  $count = $res->num_rows;
                  if($count>0){
                    $numPages = ceil($count/$numPerPage);
                    //echo "num# Pages: $numPages ";
                    $block = ceil($numPages/$maxPaginationButton);
                    //echo "Block: $block ";
                    $next = ceil($page/$block) + $numPerPage;
                    $prev = ceil($page/$block);
                    //echo("Prev: $prev next: $next");
                    $curBlock = ceil($page/$numPerPage);
                    //echo(" Current Block: $curBlock");
                    $min = ($curBlock * $numPerPage) - ($numPerPage-1);
                    //echo(" min: $min");
                    $max = $min + ($numPerPage-1);
                    //echo(" max: $max");
                  }



                  $stmt = $con->prepare("SELECT * FROM `post` order by post_date DESC LIMIT ? OFFSET ?");
                  $stmt->bind_param("ii", $numPerPage, $offset);
                  $stmt->execute();
                  $res = $stmt->get_result();

                  
                  
                  
                  
                  if($count>0){
                    while($row=$res->fetch_assoc()){
                      echo '<tr>
                    <td><a href="'. PROJECT_ROOT . $row['location'] .'?post_id='. $row['id'] .'" class="text-info">'. $row['post_tittle'] .'</a></td>
                    <td>' . ucwords($row['post_user']) . '</td>
                    <td>'; 
                    



                    echo'</td>
                    <td>Featured</td>
                    <td><a href="banner.php?post_id=' . $row['id'] . '"><div class="btn btn-sm btn-warning">Edit</div></a></td>
                    <td><a href="deletePost.php?post_id='. $row['id'] .'"><div class="btn btn-sm btn-danger">Delete</div></a></td>
                  </tr>';
                    }
                  }else{
                    echo '<tr>
                    <td colspan="5">No record to show.</td>
                    </tr>';
                  }


                ?>
                  
                </tbody>
              </table> 
            </div>
            <?php
              if($count>0)
              include 'pagination.php';

            ?>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    <script src="js/searchdoc.js"></script>
    <script>var editor = new Jodit('#editor');</script>
    <script src="js/banner.js"></script>
</body>