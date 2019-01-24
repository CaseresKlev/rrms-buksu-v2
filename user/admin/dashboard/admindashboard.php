<?php

  session_start();
  $cur = "research";

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

    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>

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
                <!--<div class="row">
                  <div class="col-md-6 sm-6">
                    Search
                    <form class="form-inline form-row">
                      <input class="form-control col-8" type="text" placeholder="Search Research..." id="search-key" name="search" class="form-control mb-2 pr-2">
                      <button type="button" class="btn btn-primary ml-1 col-3" id="btn-search"> Search </button>
                    </form>
                  </div>
                  <div class="col-md-6 sm-6">
                      <div class="col-6">Status:</div>
                      <form class="form-inline">
                        <select class="form-control w-50">
                          <option>On-Process</option>
                          <option>Finished</option>
                        </select>
                        <select class="form-control ml-2">
                          <option>On-Process</option>
                          <option>Finished</option>
                        </select>
                      </form>
                    
                    
                  </div>
                  
                </div>-->
                <div class="form-row align-items-center">
                  <div class="col-md-5 my-1">
                    <!--<div class="row ml-2">Search</div>-->
                    <label class="" for="search-key">Search Title</label>
                    <input class="form-control" type="text" placeholder="Search Research..." id="search-key" name="search" class="form-control">
                  </div>
                  <div class="col-md-1 my-1">
                    <label for="status">&ensp;</label>
                    <button type="button" class="btn btn-primary" id="btn-search"> Search </button>
                  </div>
                  <div class="col-md-3 my-1 pl-2">
                    <label for="status">Status</label>
                    <select class="form-control" id="status">
                      <option>On-Process</option>
                      <option>Finished</option>
                    </select>
                  </div>
                  <div class="col-md-3 my-1">
                    <label for="type">Research Type</label>
                    <select class="form-control" id="type">
                      <option>Instructor</option>
                      <option>Student</option>
                    </select>
                  </div>
                </div>
           </div>
          <div class="container">
            <table class="table table-striped table-hover table-condensed">
              <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Author</th>
                  <th scope="col">Type</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $k = "%%";
                $stat = "%%";
                $type = "%%";
                  if(isset($_GET['search'])){
                    $k = "%" . $_GET['search'] . "%";
                  }

                  if(isset($_GET['stat'])){
                    $stat = "%" . $_GET['stat'] . "%";
                  } 

                  if(isset($_GET['type'])){
                    $type = "%" . $_GET['type'] . "%";
                  }


                    $query = "SELECT book_id, book_title, cited, enabled, aut_type FROM `book` WHERE book_title LIKE ? and aut_type like ? and enabled like ?";
                    
                    $stmt = $con->prepare($query);
                    $stmt->bind_param("sss", $k, $type, $stat);
                    if($stmt->execute()){
                      $result = $stmt->get_result();

                      if($result->num_rows>0){
                        while ($row = $result->fetch_assoc()) {
                          $query = "SELECT author.a_id, CONCAT(author.a_lname, ', ' , SUBSTRING(author.a_fname, 1, 1), ';') as 'author' FROM author INNER JOIN junc_authorbook on junc_authorbook.aut_id = author.a_id WHERE junc_authorbook.book_id=" . $row['book_id'];
                            $result2 = $con->query($query);
                            $str = "";
                            if($result2->num_rows>0){
                              while($row2 = $result2->fetch_assoc()){
                                $str .= $row2['author'] . " ";
                              }
                            }
                            

                         echo '
                         <tr>
                  <td>'. '<a href="view-stat.php?book_id='. $row['book_id'] .'">' . $row['book_title'] .'</a></td>
                  <td>'. $str .'</td>
                  <td>'. ucwords($row['aut_type']) .'</td>
                </tr>';
                        }
                      }else{
                        echo '<tr><td colspan="3">No research match to your search.<td><tr>';
                      }
                    }



                 ?>
                
              </tbody>
            </table>

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


</body>
</html>
