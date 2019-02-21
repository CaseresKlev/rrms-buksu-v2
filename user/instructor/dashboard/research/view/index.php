<?php
  
  $currentDIR =  "research";
  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
  include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/preload.php";

  $dbconfig = new dbconfig();
  $con = $dbconfig ->getCon();

  if(isset($_SESSION['uid']) && $_SESSION['type']==="INSTRUCTOR"){

    //print_r($_SESSION);
    if(!isset($_GET['book'])){
      //header("Location: " . dirname( dirname(__FILE__) ));
     // $str =  dirname( dirname(__FILE__) );
      //header("Location: " . PROJECT_ROOT . "404.php");
    }else{
      $query = "SELECT `id` FROM `junc_authorbook` WHERE `book_id` = ? and `aut_id` = ?";
      $stmt = $con->prepare($query);
      $stmt->bind_param("ii", $_GET['book'], $_SESSION['owner']);
      if($stmt->execute()){
        $result = $stmt->get_result();
        //echo $result->num_rows;
        if($result->num_rows<1){
          //header("Location: " . PROJECT_ROOT . "404.php");
        }else{
          //echo "Error here";
        }
      }

    }
  }else{
    header("Location: " . PROJECT_ROOT );
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
    $accname = $_SESSION['gname'];
    $acctype = $_SESSION['type'];
    $uid = $_SESSION['uid'];

    
    $query = "SELECT `a_id`, `a_fname`, `a_mname`, `a_lname`, `a_suffix`, `bib`, `a_add`, `a_contact`, `a_email`, `a_pic` FROM `author` WHERE `login` = " . $uid;

    $author = null;
    $result = $con->query($query);
    if($result->num_rows>0){
        $author = $result->fetch_assoc();
    }


    $stmt = $con->prepare("SELECT book_id FROM `book` WHERE book_id = ?");
    $stmt->bind_param("i", $_GET['book']);
    if(!$stmt->execute()){
      header("Location: " . PROJECT_ROOT . "404.php");
    }else{
      $testRes = $stmt->get_result();
      if($testRes->num_rows===0){
        header("Location: " . PROJECT_ROOT . "404.php");
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
        <!-- jQuery CDN - Slim version (=without AJAX) -->
    <link rel="stylesheet" type="text/css" href="<?php echo(PROJECT_ROOT . "css/bootstrap-min-4.1.0.css"); ?>">
    <script type="text/javascript" src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.js")?>"></script>
    <!--<script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.slim.min.js")?> "></script>-->
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
           <input type="hidden" name="" id="book_id" value="<?php echo($_GET['book']) ?>">
           <?php
              
              $stmt = $con->prepare("SELECT `book_id`, `book_title`, `abstract`, `pub_date`, `department`, `keywords`, `status`, `cover`,`docloc`, `dowloadable`, `refrences`  FROM `book` WHERE book_id=?;");
              $stmt->bind_param("i", $_GET['book']);
              $stmt->execute();
              $result = $stmt->get_result();
              $bookDet = $result->fetch_assoc();
            ?>

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

           ?>
           <div class="container">
            <form enctype="multipart/form-data" id="myForm" action="validate/" onsubmit="return false;">
            <div class="row">
              <div class="col-md-3 col-sm-12 leftContent">
                 <img src="<?php 

                 if($bookDet['cover']!==""){
                  echo  PROJECT_ROOT . $bookDet['cover'] ; 
                 }else{
                  echo PROJECT_ROOT . "default/cover/df-cover.png";
                 }


                 ?>" id="cover-img">
                 <div class="row">
                  <div class="badge form-control btn-warning" id="btn-edit-cover" style="width:  80%; margin: auto; margin-top: 10px; margin-bottom: 20px; font-size: 12pt;">Change cover</div>
                 </div>
                 <div class="container data-group leftControl" >
                    <div class="row bg-secondary text-white data-head">
                      File:
                      <div class="badge badge-warning ml-auto" id="btn-edit-file" style="margin: auto; margin-right: 10px;"><i class="fas fa-pencil-alt"></i> Change File</div>
                    </div>
                    <div class="row data-content">
                      <a href="<?php  echo 'http://'. $_SERVER['HTTP_HOST'] . PROJECT_FOLDER . $bookDet['docloc'] ?>" target="_blank">
                      <div class="text onViewDepartment" style="font-size: 10pt;">
                        <?php 
                        //echo $bookDet['docloc'];
                        $doc = explode("/", $bookDet['docloc']);
                        echo $doc[count($doc) - 1]; 



                        ?>
                      </div>
                      </a>
                    </div>
                  </div>
                  <div class="container data-group leftControl">
                    <div class="row bg-secondary text-white data-head" style="padding-right: 5px;">
                      Downloadable:
                      <label class="switch ml-auto" >
                        <?php

                          if($bookDet['dowloadable']==1){
                            echo '<input type="checkbox" id="btn-downloadable" checked>';

                          }else{
                            echo '<input type="checkbox" id="btn-downloadable">';
                          }
                        ?>
                          
                          <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="row data-content">
                      <div class="text onViewDepartment">
                        <span id="download-msg">
                          <?php  
                            if($bookDet['dowloadable']==1){
                              echo 'The file is Downloadable by others.';
                            }else{
                              echo 'Your file is not downloadable by others.';
                            }  
                          ?>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="container data-group leftControl">
                    <div class="row bg-success text-white data-head" style="padding-right: 5px;">
                      Status: Completed
                    </div>
                    <div class="row data-content">
                      <a href="../paper-status/?book=<?php echo $bookDet['book_id'];?>">View history</a>
                    </div>
                  </div>

              </div>
              <div class="col-md-9 rightContent">
                
                  <div class="container data-group" style="padding-top: 0px;">
                    <div class="row bg-secondary text-white data-head">
                      Title:
                      <div  class="badge badge-warning ml-auto" id="btn-edit-title" style="margin: auto; margin-right: 10px;"><i class="fas fa-pencil-alt"></i> Edit</div>
                    </div>
                    <div class="row data-content">
                      <div class="text title"><?php echo $bookDet['book_title']; ?></div>
                    </div>
                  </div>
                  <div class="container data-group">
                    <div class="row bg-secondary text-white data-head">
                      Author(s):
                      <div  class="badge badge-warning ml-auto" id="btn-edit-author" style="margin: auto; margin-right: 10px;"><i class="fas fa-pencil-alt"></i> Edit</div>
                    </div>
                    <div class="row data-content">
                      <div class="row onViewAuthor">
                        <ul>
                          <?php
              
                            $stmt = $con->prepare('SELECT author.a_id, author.a_fname, CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1, 1), ". ", author.a_lname, " " , author.a_suffix) as name FROM `junc_authorbook` INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE book_id = ?');
                            $stmt->bind_param("i", $_GET['book']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row=$result->fetch_assoc()) {
                              echo '<li>'.$row['name'] .'</li>';
                            }
                          ?>


                          
                        </ul>
                         
                        <?php
                          $isremoved = $con->query('SELECT id, referer as referer_id, CONCAT(a1.a_fname, " ", SUBSTRING(a1.a_mname,1,1), ". ", a1.a_lname) as name, `action`, CONCAT(a2.a_fname, " ", SUBSTRING(a2.a_mname,1,1), ". ", a2.a_lname) as referer, `date` FROM `on_update_author` JOIN author a1 on a1.a_id = `author` JOIN author a2 on a2.a_id = `referer` WHERE book_id = '. $_GET['book'] .' ORDER BY date DESC');
                              $isAction = "";
                              $by = "";
                              if($isremoved->num_rows>0){
                                echo '<div class="note" style="margin-left: 10px;"> <b class="badge-danger" style="padding: 0px  5px 0px 5px;">Pending:</b>
                        <ul class="text-secondary">';
                                while ($isRemoveRow=$isremoved->fetch_assoc()) {
                                  $date = new DateTime($isRemoveRow['date']);
                                  echo '<li><b>'. $isRemoveRow['name'] .'</b> was <b>'. $isRemoveRow['action'] .'</b> as Author to this research by '. $isRemoveRow['referer'] .' last '. $date->format('F jS, Y');
                                  
                                  if($isRemoveRow['referer_id']==$_SESSION['owner']){
                                    echo '<a href="#" id="link-remove-author" onclick="removeRequest('. $isRemoveRow['id'].')"><br>Cancel Request</a>';
                                  }

                                   echo '</li>';
                                }
                                echo '</ul>
                        </div>';
                              }

                        ?>
                       
                          
                            
                          
                        
                      </div>
                      <div class="container onEditAuthor">
                        <div class="row">
                          <?php 
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while($row=$result->fetch_assoc()){
                              if($_SESSION['owner']!==$row['a_id']){
                                 echo '<div class="input-group mb-3">
                                      <input type="text" class="form-control onEdit" aria-label="Recipient\'s username" aria-describedby="basic-addon2" value="'. $row['name'] .'" id="author-5" readonly>
                                      <div class="input-group-append">
                                        <div class="btn btn-outline-danger" type="button" onclick="removeAuthor('. $row['a_id'].', \''. $row['name'].'\')"><i class="fas fa-trash-alt"></i></div>
                                      </div>
                                    </div>';
                              }
                             
                            }


                          ?>
                          <label for="author-search">Add Author:</label>
                          <div class="input-group mb-3">
                            <input type="text" class="form-control onEdit txt-searchAuthor"  placeholder="Search Author to Add" aria-label="Recipient's username" aria-describedby="basic-addon2" id="author-search">
                            <div class="input-group-append">
                              <div class="btn btn-outline-success" id="btnSearchAuthor" type="button"><i class="fas fa-search"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container data-group">
                    <div class="row bg-secondary text-white data-head">
                      Department:
                      <div class="badge badge-warning ml-auto" id="btn-edit-department" style="margin: auto; margin-right: 10px;"><i class="fas fa-pencil-alt"></i> Edit</div>

                    </div>
                    <div class="row data-content">
                      <div class="text onViewDepartment departmentID"><?php  echo $bookDet['department']; ?></div>

                      <div class="form-group">
                        <label for="department" id="label-department" style="display: none;">Select Department</label>
                        <select class="form-control onEdit" id="department" name="department">
                        <?php  
                          $result=$con->query("SELECT * FROM `department` where 1 ORDER by college asc");
                          echo $result->num_rows;
                          if($result->num_rows>0){
                            while ($row=$result->fetch_assoc()) {
                              echo '<option value="'. $row['id'] .'">'. $row['college'] .' - '. $row['cat_name'] .'</option>';
                            }
                          }

                        ?>
                        
                      </select>
                      </div>
                      <script type="text/javascript">
                        
                      </script>
                      
                    </div>
                  </div>
                  <div class="container data-group">
                    <div class="row bg-secondary text-white data-head">
                      Keywords:

                      <div class="badge badge-warning ml-auto" id="btn-edit-keywords" style="margin: auto; margin-right: 10px;"><i class="fas fa-pencil-alt"></i> Edit</div>
                      <div class="badge badge-success ml-auto d-none" id="btn-edit-keywords-save" style="margin: auto; margin-right: 10px;"><i class="fas fa-save"></i> Save</div>
                    </div>
                    <div class="row data-content">
                      <div class="text onView edit-Keywords">
                        <?php echo $bookDet['keywords']; ?>
                      </div>
                      <div class="note text-white badge-info d-none" id="kw-hint">Pls. Separate with Comma</div>
                      <textarea rows="5" class="form-control onEdit" id="keywords"><?php echo $bookDet['keywords']; ?></textarea>
                    </div>
                  </div>
                  <div class="container data-group">
                    <div class="row bg-secondary text-white data-head">
                      Abstract:
                      <div class="badge badge-warning ml-auto" id="btn-edit-abstract" style="margin: auto; margin-right: 10px;"><i class="fas fa-pencil-alt"></i> Edit</div>
                      <div class="badge badge-success ml-auto d-none" id="btn-edit-abstract-save" style="margin: auto; margin-right: 10px;"><i class="fas fa-save"></i> save</div>
                    </div>
                    <div class="row data-content">
                      <div class="text onView" id="edit-abstract">
                        <?php echo $bookDet['abstract']; ?>
                      </div>
                      <textarea rows="8" class="form-control onEdit" id="abstract" ><?php echo $bookDet['abstract']; ?></textarea>
                    </div>
                  </div>
                  <div class="container data-group">
                    <div class="row bg-secondary text-white data-head">
                      Submitted on:
                    </div>
                    <div class="row data-content">
                      <div class="text onView edit-Keywords">
                        <?php 
                          $date = new DateTime($bookDet['pub_date']);
                          echo $date->format('F jS, Y');
                         ?>
                      </div>
                    </div>
                  </div>
                  <div class="container data-group">
                    <div class="row bg-secondary text-white data-head">
                      Research History:
                    </div>
                    <div class="row data-content">
                      <div class="text onView edit-Keywords">
                          <?php  


                            $result = $con->query("SELECT `id`, `book_stat`, `date` FROM `bookhistory` WHERE book_id = " . $_GET['book']);
                            if($result->num_rows>0){

                                while ($row = $result->fetch_assoc()) {
                                  //print_r($row);
                                  echo '<div class="alert alert-info" role="alert">';
                                   $date = new DateTime($row['date']);

                                    if($row['book_stat']==="Unpublished"){
                                      
                                      echo "Submitted on " . $date ->format('F jS, Y');
                                    }else if($row['book_stat']==="Utilized"){

                                      $stmt = $con->prepare("SELECT * FROM `utilize` WHERE `book_id` = ?");
                                      $stmt->bind_param("i", $_GET['book']);
                                      if($stmt->execute()){
                                        $resultUtil = $stmt->get_result();
                                        if($resultUtil->num_rows>0){

                                          $util = $resultUtil->fetch_assoc();
                                          $date = new DateTime($util['date']);
                                          echo $row['book_stat'] . " on " . $date ->format('F jS, Y') . " at " . $util['orgname'] . " - " . $util['orgaddress'];
                                        }

                                      }

                                      
                                    }else if($row['book_stat']==="Published"){
                                      $stmt = $con->prepare("SELECT * FROM `published` WHERE `history` = ?");
                                      $stmt->bind_param("i", $row['id']);
                                      $stmt->execute();
                                      $resultPub = $stmt->get_result();
                                      if($resultPub->num_rows>0){
                                        $pub = $resultPub->fetch_assoc();
                                        $date = new DateTime($pub['date']);
                                        echo $row['book_stat'] . " with ISBN #: " . $pub['issn'] . " at " . $pub['journal'] . " a " . $pub['type'] . " last " . $date->format('F jS, Y');
                                      }
                                    }else if($row['book_stat']==="Disseminated"){
                                      $stmt = $con->prepare("SELECT * FROM `disseminated` WHERE `history` = ?");
                                      $stmt->bind_param("i", $row['id']);
                                      $stmt->execute();
                                      $resultDis = $stmt->get_result();
                                      if($resultDis->num_rows>0){
                                        $dis = $resultDis->fetch_assoc();
                                        $date = new DateTime($pub['date']);
                                        echo $row['book_stat'] . " during \"" . $dis['convension'] . "\" at " . $dis['location'] . " last " . $date->format('F jS, Y');
                                      }
                                    }else{
                                      $date = new DateTime($row['date']);
                                      echo $row['book_stat'] . " last " . $date->format('F jS, Y');
                                    }
                                   echo "</div>";
                                   
                                }
                            }
                            

                            
                           
                            
                            
                          ?>
                      </div>
                    </div>
                  </div>
                  <div class="container data-group">
                    <div class="row bg-secondary text-white data-head">
                      Awards:
                    </div>
                    <div class="row data-content" >
                      <div class="text onView edit-Keywords">
                        <ul>
                          
                          <?php 

                            $result = $con->query("SELECT `awards`, `parties`, `location`, `date` FROM `awards` WHERE book_id = " . $_GET['book']);
                            if($result->num_rows>0){
                              while ($row=$result->fetch_assoc()) {
                                echo "<li>";
                                $date = new DateTime($row['date']);
                                  echo "Awarded as <em><b>" . $row['awards'] . "</b></em> during the <b>" . $row['parties'] . "</b> at " . $row['location'] . " last " . $date->format('F jS Y');

                                echo "</li>";
                              }
                            }else{
                              echo "<p>No awards yet</p>";
                            }


                           ?>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="container data-group" style="margin-bottom: 40px;">
                    <div class="row bg-secondary text-white data-head">
                      References:
                      <div class="badge badge-warning ml-auto" id="btn-edit-reference" style="margin: auto; margin-right: 10px;" onclick="removeEditRef('','',0, 'add')"><i class="fas fa-edit"></i> Edit</div>
                      
                    </div>
                    <div class="row data-content refrences-wrappler">
                      <h5><small>
                        <?php
                        $origRef = $bookDet['refrences'];
                         $reg_exURL = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                         $final = "";
                         if(preg_match_all($reg_exURL, $bookDet['refrences'], $urls)){
                          $usedPatterns=array();
                          foreach ($urls[0] as $pattern) {
                            //echo "$pattern------";
                            if(!array_key_exists($pattern, $usedPatterns)){
                              $usedPatterns[$pattern] = true;
                              $bookDet['refrences'] = str_replace($pattern, "<a target='_blank' href=" . $pattern . "><br>[$pattern]</a>", $bookDet['refrences']);
                            }
                          }
                          echo  nl2br($bookDet['refrences']);

                            //echo count($url);
                            //print_r($url);
                            //$final = preg_replace($reg_exURL, "<a target='_blank' href=" . $url[0] . ">$url[0]</a>", $bookDet['refrences']);
                         }


                        

                        ?>
                     </small></h5>
                    </div>
                  </div> 
            </div>
           </div>

           <!--  <?php 
                        $ref = $con->query("SELECT ref.id as ref_id, junk_bookref.id as junction_id, ref.reftitle as title, ref.link as link FROM `junk_bookref` inner JOIN ref on ref.id = webref_id WHERE book_id = " . $_GET['book']);
                        if($ref->num_rows>0){
                          $refCount = 1;
                          while($refrow=$ref->fetch_assoc()){
                            echo '<div class="container ref-container">
                        <div class="row data-content" style="margin-left: 5px;">
                          <div class="col-md-10 col-sm-10">
                            <div class="row h6">'. $refrow['title'] .' </div>
                            <div class="row h6">
                              <small>
                                <a href="'. $refrow['link'] .'" target="_blank">'. $refrow['link'] .'</a>
                              </small>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2">
                            <div class="badge badge-warning ml-auto" onclick="removeEditRef( \''. $refrow['title'] .'\', \''. $refrow['link'] . '\', '. $refrow['ref_id'] .', \'edit\')" style="margin: auto; font-size: 10pt;">
                              <i class="fas fa-pencil-alt"></i>
                            </div>';

                            if($refCount!=1){

                              echo'
                            <div class="badge badge-danger ml-auto" id="btn-del-ref" onclick="removeEditRef(\'\', \'\', '. $refrow['ref_id'] .', \'delete\');" style="margin: auto; font-size: 10pt;">
                              <i class="fas fa-trash-alt"></i>
                            </div>';

                            }
                            $refCount = 2;
                          echo'
                          </div>
                        </div>
                      </div>';
                          }
                        }

                      ?>
                      
                      <!--template for reference-->
                      <!--<div class="container ref-container">
                        <div class="row data-content" style="margin-left: 5px;">
                          <div class="col-md-10 col-sm-10">
                            <div class="row h6">Satalkar, B. (2010, July 15). Water aerobics. </div>
                            <div class="row h6"><small><a href="http://www.buzzle.com/fsgehfbhsfnjsef/hefbsegfse/fsebfhbseffse.html">http://www.buzzle.com/fsgehfbhsfnjsef/hefbsegfse/fsebfhbseffse.html</a></small></div>
                          </div>
                          <div class="col-md-2 col-sm-2">
                            <div class="badge badge-warning ml-auto" style="margin: auto; font-size: 10pt;"><i class="fas fa-pencil-alt"></i></div>
                            <div class="badge badge-danger ml-auto" id="btn-del-ref" onclick="removeRef(1);" style="margin: auto; font-size: 10pt;"><i class="fas fa-trash-alt"></i></div>
                          </div>
                        </div>
                      </div>--> 

        </form>

            <!-- modal title-->
                  <input type="hidden" name="">
                  <div class="modal fade " id="modalEditText" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header" style="padding: 10px">

                          <h4 class="modal-title " id="modal-title-pub">Edit Title</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form id="form-published" action="validate/title.php" method="POST">
                          <div class="modal-body">
                              <input type="hidden" name="bookid" value="<?php echo($_GET['book']) ?>">
                              <div class="form-group">
                                <label for="txt-title">Title: <em style="color: red">*</em></label>
                                <textarea type="text/number" rows="5" placeholder="Title" class="form-control edited_title" name="txt-title"  class="form-control" style= "font-family: Century Gothic; font-size: 13pt;" required></textarea>
                              </div>
                          </div>
                        <div class="modal-footer">
                          <button type="submit" value="Save Changes" class="btn btn-primary ml-auto"> Save </button>
                        </div>
                        </form>
                      </div>

                    </div>
                  </div>

                  <!-- modal title-->
                  <div class="modal fade" id="modalAuthor" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">

                          <h5 class="modal-title" id="modal-title-pub">Remove Author</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form id="form-published" id="form-author-add-delete" action="validate/author.php" method="POST">
                          <div class="modal-body">
                              <input type="hidden" name="author" id="author" value="remove-6-2">
                              <h6 class="text-danger">Are you sure you want to remove <b id="displayName">Allen Mie S. Bangud</b> as Athor for this research?</h6>
                              <br>
                              <br>
                              <em class="text-white badge-danger note">Note: No changes will be applied until <b id="displayName2">Allen Mie</b> approved your action.</em>
                          </div>
                        <div class="modal-footer">
                          <button type="submit" value="Save Changes" id="submit-author" class="btn btn-primary ml-auto"> Yes </button>
                        </div>
                        </form>
                      </div>

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
                  
                 <!--modal edit reference-->
                 <div class="modal fade" id="modalAddEditRef" role="dialog" >
                    <div class="modal-dialog" style="max-width: 720px;">

                      <!-- Modal content-->
                      <div class="modal-content" >
                        <div class="modal-header">

                          <h5 class="modal-title" id="modal-addAuthor-title">Edit reference</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                          
                        <form action="validate/reference.php" method="POST">
                          <input type="text" name="b_id" class="d-none" value="<?php  echo $bookDet['book_id'] ?>">
                          <!--<input type="number" class="d-none" name="form-ref-id" id="form-ref-id" value="0">
                          <div class="modal-body">
                            <div class="form-group option1">
                              <label for="ref-title">Reference: <span class="badge-warning note">*(APA Format)</span></label>
                              <textarea class="form-control"  name="ref-title" id="ref-title" rows="3"></textarea>
                            </div>
                            <div class="form-group option1">
                              <label for="ref-title">Reference Link:</label>
                              <input type="text" class="form-control" name="ref-link" id="ref-link" placeholder="http://example.com" required>
                            </div>
                            <div class="form-group option2" style="display: none">
                              <label for="ref-title">Insert Local Citation Key: <span class="btn-warning note">Paper that found on this Server</span></label>
                              <input type="text" class="form-control" name="ref-citation" id="ref-citation" placeholder="Ex: Un5lAdageHbLgKUhF8aLklshoq6BjxDR" required="">
                            </div>
                            <div class="form-group option-select">
                              <input type="checkbox" name="use-citation" id="use-citation">
                              <label for="use-citation">I will add Citation Key instead</label>
                            </div>
                          </div>
                          
                          
                        -->
                         <textarea class="form-control p-2" cols="100" rows="15" name="edit-references" required><?php echo  $origRef; ?></textarea>
                        <div class="modal-footer">
                          <input   type="submit" value="Save" class="btn btn-success"> 
                        </div>
                         </form>
                      </div>

                    </div>
                  </div>
                   
                   <div class="modal fade" id="modalFileUpload" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">

                          <h5 class="modal-title" id="modal-fileUpload-title">Change File</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                          
                        <form action="validate/upload.php" method="POST" enctype="multipart/form-data">
                          <input type="text" name="b_id" class="d-none" value="<?php  echo $bookDet['book_id'] ?>">
                          <input type="number" class="d-none" name="form-ref-id" id="form-ref-id" value="0">
                          <div class="modal-body">
                            <input type="number" name="book_id" class="d-none" value="<?php echo $_GET['book'] ?>">
                            <input type="text" class="d-none" name="file-action" id="file-action" value="file">
                            <div class="form-group option1">
                              <label for="file-title" id="file-title">Choose file to Upload: <span id="uploadFile-note" class="badge-danger note">*(PDF Format - Max File size 40MB)</span></label>
                              <input type="file" name="file" id="file-upload" accept="application/pdf" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <input   type="submit" value="Submit" class="btn btn-primary"> 
                          </div>
                         </form>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

     
    <script src="<?php echo PROJECT_ROOT . "js/dashboard.js" ?>"></script>

    <script type="text/javascript">
      //$('#suf').val($('#suf').val());
      //var s = $('.departmentID').html();
      $('#department').val(<?php echo $bookDet['department']; ?>).change();
      $('.departmentID').html($('#department option:selected').html());

      //alert($('#department').text());
    </script>
</body>
</html>
