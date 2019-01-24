<?php

  session_start();
  $currentDIR =  "research";
  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");

  include PROJECT_ROOT_NOT_LINK . 'includes/connection.php';
  include PROJECT_ROOT_NOT_LINK . 'server_script/crypt.php';
  if(isset($_SESSION['uid']) && $_SESSION['type']==="INSTRUCTOR"){
    //print_r($_SESSION);
  }else{
    header("Location: " . PROJECT_ROOT );
  }
  


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
          z-index: 9999;
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


        <div id="content" class="pb-5">
          <!-- Toggle Menu  -->
            <?php include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/toggle_menu.php"; ?>


           <!---- PLACE YOUR DIVS HERE --->
           <?php  
            if(isset($_GET['msg'])){

              $alertType = "info";
              if(isset($_GET['alertType'])){
                $alertType = $_GET['alertType'];
              }
              //echo "$alertType";
              echo '
              <div class="bg-'. $alertType .' text-center text-white rounded" style="margin-bottom: 40px;">
               <!--<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>-->
               <button type="button" class="close btn-danger" style="margin-right: 10px;" onclick="this.parentElement.style.display=\'none\'"; aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
               '. $_GET['msg'] .'
           </div>';
            }
            $research_count =0;
            /*if(isset($_SESSION['type'])){
              if($_SESSION['type']==="STUDENT" || $_SESSION['type']==="student" ){
                //echo $_SESSION['owner'];
                $stmt = $con->prepare("SELECT COUNT(`id`) as research_count FROM `junc_authorbook` WHERE `aut_id` = ?");
                $stmt->bind_param("i", $_SESSION['owner']);
                $stmt->execute();
                $result = $stmt->get_result();
                $count = $result->fetch_assoc();
                $research_count = $count['research_count'];
              } 
            }*/
            
          ?>
            <div class="container">
              <div class="h4 mb-5">
                Add On-Going Research
              </div>
            <form method="POST" action="validate/" class="m-1 pt-3">
              <div class="row">
                  <div class="col-md-6 com-sm-12">
                    <div class="row bg-dark text-white data-head m-1">
                      Research Details
                    </div>
                    
                        <div class="form-group">
                          <label for="title">Title:<span class="text-danger">*</span></label>
                          <textarea required cols="50" class="form-control" rows="5" id="title" name="title"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="department">Department:<span class="text-danger">*</span></label>
                          <select class="form-control" name="department">
                            <?php 

                              $stmt = $con->prepare("SELECT * FROM `department` WHERE `cat_name` = ?");
                              $d = "Faculty";
                              $stmt->bind_param("s", $d);
                              if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows>0){
                                  $row = $result->fetch_assoc();
                                  echo '<option value='. $row['id'] .'>'. $row['cat_name'] .'</option>';
                                }else{
                                  echo '<div class="alert alert-danger" role="alert">Databse Error!<br>We are very sorry. We were not able to communicate to the database. We will fix it soon.</div>';
                                  exit();
                                }
                                
                              }else{
                                echo '<div class="alert alert-danger" role="alert">Unhandled Error!<br>Something went wrong. We will fix it soon.</div>';
                                  exit();
                              }

                             ?>
                            
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="status">Staus:<span class="text-danger">*</span></label>
                          <select class="form-control" id="status" name="status">
                            <option value="Conceptualized">Conceptualized</option>
                          </select>
                        </div>
                        
                    
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="row bg-dark text-white data-head m-1">
                      Authors
                    </div>
                    <div class="m-1 listAuthor">
                      <div class="input-group pt-1">
                        <div class="input-group-append">
                          <div class="d-none">
                            <input type="text" name="author[]" class="alert alert-info form-control" readonly value="<?php echo $_SESSION['owner'] ?>">
                          </div>
                        </div>
                        <input type="text" class="alert alert-info form-control" readonly value="<?php echo $_SESSION['name'] ?>">
                      </div>
                    </div>
                    <div class="m-1">
                      <div class="input-group pt-5 ">
                        <div class="" id="add-author">
                          Add Author:
                        </div>
                      </div>
                      <div class="input-group pt-1">
                        <input type="text" class="form-control onEdit txt-searchAuthor"  placeholder="Search Author to Add" aria-label="Recipient's username" aria-describedby="basic-addon2" id="author-search">
                            <div class="input-group-append">
                              <div class="btn btn-outline-success" id="btnSearchAuthorOnProcess" type="button"><i class="fas fa-search"></i></div>
                            </div>
                      </div> 
                    </div>
                    
                  </div>
              </div>
              <input type="submit" name="Submit" class="form-control btn-primary mt-3">
            </form>
            </div>
          </div>

              <div class="modal fade" id="modalAuthorADD" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">

                          <h5 class="modal-title" id="modal-title-pub">Add Author</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                          <table class="table table-striped border-5" >
                            <thead>
                              <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody id="author-search-list">
                            </tbody>
                          </table>
                        
                          <em class="text-white badge-danger note">Note: No changes will apply unless the author you are trying to add confirms your action.</em>
                        
                        <div class="modal-footer">
                          <button type="submit" value="Save Changes" class="btn btn-primary ml-auto" data-dismiss="modal"> Ok </button>
                        </div>
                        
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
    <script src="<?php echo(PROJECT_ROOT . "js/dashboard.js") ?>"></script>

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
