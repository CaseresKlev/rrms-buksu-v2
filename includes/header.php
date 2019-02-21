<?php
  include 'path.php';
  session_start();

  //print_r($_SESSION);

  //for including php
  //include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/index.php");

  //for including links
  //echo("http://$_SERVER[HTTP_HOST]" . "/rrms-buksu/css/style.css");
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--bootstrap-->
<script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.js")?> "></script>

<link rel="stylesheet" type="text/css" href="<?php echo(PROJECT_ROOT . "/css/bootstrap-min-4.1.0.css"); ?>">
<!-- Our Custom CSS -->
<link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "/css/style.css"); ?>">
<link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/Animate.css"); ?>">
<script defer src="<?php echo(PROJECT_ROOT . "/js/solid.js"); ?>"></script>
<script defer src="<?php echo(PROJECT_ROOT . "js/bootstrap-notify.js"); ?>"></script>
<!--<script defer src="<?php echo(PROJECT_ROOT . "/js/fontawesome.js"); ?>"></script>-->

    <style>
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;;
  background: url(<?php echo PROJECT_ROOT . 'img/loader-64x/Preloader_3.gif'?>) center no-repeat #fff;
}
</style>

<div class="jumbotron banner">
    <h1 id="banner-name">BukSU - Research Record Management System</h1>      
    <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile-first projects on the web.</p>
 </div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top">
  <a class="navbar-brand" href="<?php echo $rootPath  ?>" id="brand" >BukSU-RRMS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse"  id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $rootPath  ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Researches
        </a>
        <div class="dropdown-menu" id="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo PROJECT_ROOT . "research/?filter=all" ?>">All</a>
        	<a class="dropdown-item" href="<?php echo PROJECT_ROOT . "research/?filter=instructor" ?>">Instructor Research</a>
        	<a class="dropdown-item" href="<?php echo PROJECT_ROOT . "research/?filter=student" ?>">Student Research</a>
       	</div>
       
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://research.buksu.edu.ph/index.php" target="_blank">BukSU Journal</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
    	 <form class="form-inline my-3 my-lg-0" style="padding-right: 40px;">
	      <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" id="skey" aria-label="Search">
	      <button class="btn btn-outline-success my-2 my-sm-0" id="btn-search-home" type="button">Search</button>
	    </form>
	    <!--<li class="nav-item active" id="userli" style="padding-left: 20px; padding-right: 20px;">
	    	<div class="row">
	    			<a class="nav-link" href="#" style="color: yellow;"><i class="fas fa-user fa-lg" style="color: white;" ></i>&#9; Login</a>
	    	</div>
      	</li>-->

        
      	<li class="nav-item dropdown">
          

      	<?php
      		if(isset($_SESSION['uid'])){
      			echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: yellow"><i class="fas fa-user fa-lg" style="color: white;" ></i>&#9;' . $_SESSION['gname'] . '
     	 </a>';
      		}else{
      			echo '<a class="nav-link" href="'. PROJECT_ROOT .'login.php" id="navbarDropdown" role="button"  style="color: yellow"><i class="fas fa-user fa-lg" style="color: white;" ></i>&#9;Login
     	 </a>';
      		}
      	?>
          

         <div class="dropdown-menu dropdown-menu-right" id="dropdown-menu" aria-labelledby="navbarDropdown">
        	<?php
					

						if(isset($_SESSION['uid'])){
              $acctype = $_SESSION['type'];
							if($acctype==="INSTRUCTOR"){
								echo '<a class="dropdown-item" href="'. PROJECT_ROOT .'user/instructor/dashboard/profile">My Dashboard</a>';
							}else if($acctype==="admin"){
								echo '<a class="dropdown-item" href="'. PROJECT_ROOT .'user/admin/dashboard/admindashboard.php">My Dashboard</a>';
								//echo '<a class="dropdown-item" href="userchangepass.php">Change Password</a>';
							}else if($acctype==="publisher"){
                echo '<a class="dropdown-item" href="'. PROJECT_ROOT .'user/publisher/dashboard/">My Dashboard</a>';
              }else{
								echo '<a class="dropdown-item" href="'. PROJECT_ROOT .'user/student/dashboard/profile/">My Dashboard</a>';
              }

              echo '<a class="dropdown-item" href="'. PROJECT_ROOT .'logout.php">LOGOUT</a>';
              
					} ?>
        </div>
      </li>
    </ul>
  </div>
</nav>
<script>
  
      $(window).on('load', function () {
            //alert("Window Loaded");
            // Animate loader off screen
            jQuery(".se-pre-con").hide();
            //$(".se-pre-con").fadeOut("slow");
       });

      $('#navbarDropdown').on('mouseover', function(e) {
        //alert("h");
          $(e.target).dropdown('toggle');
      });

      $('#dropdown-menu').on('mouseout', function(){
        //$(this).dropdown('togg')
      })

      


      $('#btn-search-home').click(function(){
        var k = $('#skey').val();
        //alert(k);


        window.location.replace("<?php echo PROJECT_ROOT . 'search/?k='?>" +k);
      })
</script>

<!--<div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <a class="navbar-brand" href="#">BukSU - Research Record Management System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Top Menu Items</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
        </ul>
      </div>
    </nav>
</div>-->