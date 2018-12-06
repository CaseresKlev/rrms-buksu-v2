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
    <script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.slim.min.js")?> "></script>

    <link rel="stylesheet" type="text/css" href="<?php echo(PROJECT_ROOT . "css/bootstrap-min-4.1.0.css"); ?>">
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
        <nav id="sidebar" style="position: -webkit-sticky; position: sticky; top: 0;">
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
                <li class="active" id="link-myProfile">
                    <a href="#">My Profile
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
                <li>
                    <a href="../research/">My Research</a>
                </li>
                <li>
                    <a href="../account/" >My Account</a>
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
            if(isset($_GET['updateProfileMessage'])){

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

            <form enctype="multipart/form-data" id="myForm" action="validate/?t=<?php echo data_encrypt($_SESSION['uid'], $key); ?>"  method="POST">
              <div class="container custom-content" id="myProfile">
                <div class="row" style="margin-top: 20px;">
                    <div class="btn btn-primary ml-auto" id="btn-editProfile"style="margin: 15px 0px 0px 0px">Edit profile</div>
                </div>
                <div class="row text-right">
                  <input type="submit" value="Save Changes" class="btn btn-primary ml-auto" id="btn-save" style="background-color: #33cc33; display: none;">
                </div>
                <div class="container data-group">
                  <!--<div class="row bg-secondary text-white data-head">  
                        Select a profile picture:
                  </div>
                  <div class="row data-content">
                     <input type="file" class="form-control-file" name="myFile" id="myFile" accept=".jpeg, .png">
                     <br>
                     <br>
                  </div>-->
                  <div class="row bg-secondary text-white data-head">  
                        Name:
                  </div>
                  <div class="row data-content">
                              <!--<div class="" id="nameActive">-->
                        <div class="text text-dark" id="nameActive">
                         <?php  
                          $name = $author['a_fname'] . " " . $author['a_mname'] . " " . $author['a_lname'] . " " . $author['a_suffix'];
                          echo ucwords($name); 

                          ?> 
                        </div>
                        <div class="row onEdit" id="nameEdit" style="display: none;">
                          <div  class="col-md-3 col-sm-12">
                            <label for="fname">Firstname: </label>
                            <input type="text" name="fname" required="required" pattern="[A-Z a-z]{1,40}" style="border-left: 5px solid #33cc33" class="form-control mb-2 mr-sm-2" id="fname" placeholder="Enter Firstname" value="<?php echo $author['a_fname'] ?>" title="Letters only. Maximum of 40 Characters">
                          </div>
                          <div class="col-md-3 col-sm-12">
                            <label for="mname">Middle Name: </label>
                            <input type="text" name="mname" required="required" pattern="[A-Z a-z]{1,40}" style="border-left: 5px solid #33cc33" class="form-control mb-2 mr-sm-2" id="mname" title="Letters only. Maximum of 40 Characters" placeholder="Enter Middle name" value="<?php echo $author['a_mname'] ?>">
                          </div>
                          <div class="col-md-3 col-sm-12">
                            <label for="lname">Lastname</label>
                            <input type="text" name="lname" required="required" pattern="[A-Z a-z]{1,40}" style="border-left: 5px solid #33cc33" class="form-control mb-2 mr-sm-2" id="lname" title="Letters only. Maximum of 40 Characters" placeholder="Enter Lastname" value="<?php echo $author['a_lname'] ?>">
                          </div>
                          <div class="col-md-3 col-sm-12">
                            <input type="hidden" name="suf-val" id="suf-val" value="<?php echo $author['a_suffix'] ?>">
                            <label class="mb-2 mr-sm-2"  for="suf">Suffix:</label>
                            <select style="border-left: 5px solid #33cc33" class="form-control mb-2 mr-sm-2"  name="suf" id="suf" >
                              <option value=""></option>
                              <option value="Sr.">Sr.</option>
                              <option value="Jr.">Jr.</option>
                              <option value="III">III</option>
                              <option value="IV">IV</option>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="container data-group">
                  <div class="row bg-secondary text-white data-head">
                        Contact Number:
                  </div>
                  <div class="row data-content">
                        <input type="text" name="profileContact" pattern="[0-9]{11}" readonly class="form-control-plaintext" id="profileContact" value="<?php echo $author['a_contact']; ?>">
                  </div>
                </div>
                <div class="container data-group">
                  <div class="row bg-secondary text-white data-head">
                        Email:
                  </div>
                  <div class="row data-content">
                        <input type="email" readonly name="profileEmail" class="form-control-plaintext" id="profileEmail" value="<?php echo $author['a_email']; ?>">
                  </div>
                </div>
                <div class="container data-group">
                  <div class="row bg-secondary text-white data-head">
                    Address:
                  </div>
                  <div class="row data-content">
                    <input type="text" readonly class="form-control-plaintext" name="profileAddress"  id="profileAddress" value="<?php echo $author['a_add']; ?>">
                  </div>
                </div>
                <div class="container data-group">
                  <div class="row bg-secondary text-white data-head">
                    Bibliography:
                  </div>
                  <div class="row text data-content" id="bibActive"><?php echo $author['bib']; ?></div>
                  <div class="row data-content" id="bibEdit" style="display: none;">
                      <textarea style="border-left: 5px solid #33cc33" class="form-control" name="profileBib" id="profileBib" rows="5" cols="100"></textarea>
                  </div>
                </div>
              </div>
            </form>
                
                
               <!--<table class="table">
                    <tbody>
                        <tr>
                          <th scope="row">Name:</th>
                          <td>  
                            <b id="nameActive">
                               <?php  
                                $name = $author['a_fname'] . " " . $author['a_mname'] . " " . $author['a_lname'] . " " . $author['a_suffix'];
                                echo ucwords($name); 

                            ?> 
                            </b>
                            
                            <div class="onEdit" id="nameEdit" style="display: none;">
                                <input type="text" style="border-left: 5px solid #33cc33" class="form-control mb-2 mr-sm-2" id="fname" placeholder="Enter Firstname" value="<?php echo $author['a_fname'] ?>">
                                <input type="text" style="border-left: 5px solid #33cc33" class="form-control mb-2 mr-sm-2" id="mname" placeholder="Enter Middle name" value="<?php echo $author['a_mname'] ?>">
                                <input type="text" style="border-left: 5px solid #33cc33" class="form-control mb-2 mr-sm-2" id="lname" placeholder="Enter Lastname" value="<?php echo $author['a_lname'] ?>">
                                <label class="mb-2 mr-sm-2" for="suf">Suffix:</label>
                            <select style="border-left: 5px solid #33cc33" class="form-control mb-2 mr-sm-2" id="suf" value="<?php echo "Jr." ?>">
                              <option></option>
                              <option>Sr.</option>
                              <option>Jr.</option>
                              <option>III</option>
                              <option>IV</option>
                            </select>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Contact Number:</th>
                          <td> 
                            <input type="text" readonly class="form-control-plaintext" id="profileContact" value="<?php echo $author['a_contact']; ?>">
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Email:</th>
                          <td>
                            <input type="text" readonly class="form-control-plaintext" id="profileEmail" value="<?php echo $author['a_email']; ?>">
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Address:</th>
                          <td> 
                            <input type="text" readonly class="form-control-plaintext"  id="profileAddress" value="<?php echo $author['a_add']; ?>">
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Bibliography:</th>
                          <td style="text-align: justify;">
                            <h6 id="bibActive" style="font-weight: normal;">
                                <?php echo $author['bib']; ?>
                            </h6>
                            
                            <div id="bibEdit" style="display: none;">
                                <textarea style="border-left: 5px solid #33cc33" class="form-control" id="profileBib" rows="5" cols="100">
                                    <?php echo $author['bib']; ?>
                                </textarea>
                            </div>
                            
                          </td>
                        </tr>
                    </tbody>
                </table>-->
           
            

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