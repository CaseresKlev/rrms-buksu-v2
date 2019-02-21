<?php
	$currentDIR = "";
	session_start();
    $loaded = false;
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

    $title = "";
    $pBody = "";
    $setFeatured = "";
    $post_id = "";
    if(isset($_GET['post_id']) && ! empty($_GET['post_id'])){
      $stmt = $con->prepare("SELECT * FROM `post` WHERE `id` = ?");
      $stmt->bind_param("i", $_GET['post_id']);
      $stmt->execute(); 

      $res = $stmt->get_result();

      if($res->num_rows>0){
        $post = $res->fetch_assoc();
        $title = $post['post_tittle'];
        $pBody = $post['post_body'];
        $post_id = $post['id'];

        if($post['feautured'] == 1){

          $setFeatured = "checked";
        }


      }
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
            <form method="POST" action="savePost.php" enctype="multipart/form-data">
                
            
                <div class="bg-light row mx-1">
                    <input type="submit" class="btn btn-primary ml-auto" onclick="savePost('#editor')" value="Publish">
                </div>
                <div class="form-group">
                    <label for="PostTitle">Post Title<span class="text-danger">&nbsp;*</span></label>
                    <input type="text" name="PostTitle" id="PostTitle" class="form-control" placeholder="Title" required value="<?php echo $title  ?>">
                </div>
                <div class="row my-2">
                    <div class="col-md-2 col-sm-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="featured" name="featured" <?php echo $setFeatured; ?>>
                            <label class="form-check-label" for="exampleCheck1">Set as Featured</label>  
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-12" id="fileholder">
                      <div class="form-group">
                            <label for="FileCover">Featured Cover:&nbsp<span class="text-danger muted">*&nbsp;6MB Maximum&nbsp;&nbsp;</span></label>   
                            <input type="file" id="feauturedCover" name="feauturedCover" style="font-size: 11pt" required <?php if($setFeatured!=="checked") echo "disabled" ?>>
                      </div>        
                    </div>
                </div>
               	<div id="editor"><?php  echo $pBody; ?></div>
                <input type="text" name="html" value=" " id="editorhtml" class="d-none" value="<?php  //echo $pBody; ?>">
                <input type="number" name="post_id" value="<?php echo $post_id ?>" class="d-none">
            </form>
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