<?php
    $book_id = "";
    include $_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/connection.php";
    //include $_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php";
    $dbconfig= new dbconfig();
    $con= $dbconfig -> getCon();
    /*if(isset($_GET['book_id'])){
        $book_id = $_GET['book_id'];
    }else{
       // header("Location: ../404.php");
    }*/

    if(isset($_GET['post_id'] ) && !empty($_GET['post_id'])){
      $stmt = $con->prepare("SELECT * FROM `post` WHERE `id` = ?");
      $stmt->bind_param("i", $_GET['post_id']);
      if(!$stmt->execute()){
        header("Location: " . PROJECT_ROOT . "404.php?msg=The page your are looking for is not found on this server. <br>This may happen when the publisher / author deleted the page or the page was expired!");

      }
      
      $res = $stmt->get_result();
      //echo $res->num_rows;
      //exit();
      if(!$res->num_rows>0){
        header("Location: " . PROJECT_ROOT . "404.php?msg=The page your are looking for is not found on this server. <br>This may happen when the publisher / author deleted the page or the page was expired!");
      }

      $post = $res->fetch_assoc();


      $stmt = $con->prepare("UPDATE `post` SET `views_count` = ? WHERE `post`.`id` = ?");
      $count = $post['views_count'] + 1;
      $stmt->bind_param("ii", $count, $_GET['post_id']);
      $stmt->execute();
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>RRMS-Post</title>
    <?php
    	include ($_SERVER["DOCUMENT_ROOT"] . '/rrms-buksu/includes/header.php');
    ?>
</head>
<body>
    <div class="se-pre-con"></div>
    <div class="container content mb-5">
      <div class="row">
        <div class="col-md-9 col-sm-12">
          <div class="row">
            <?php

            if($post['feautured']==1 && $post['cover']!==""){
              echo '<img class="border border-3" src="'. PROJECT_ROOT .  $post['cover'] . '" alt="Featured Cover" width="100%" height="250px">';
            }

            ?>
            
          </div>
          <div class="row mt-3 h2 font-weight-bold text-primary">
            <?php echo $post['post_tittle']; ?>
          </div>
          <div class="row">
            <span>
              Posted by <i class="fas fa-user"></i>&nbsp;<?php echo $post['post_user'] ?>
            </span>
            <span>
              &nbsp; <i class="fas fa-clock"></i>&nbsp;
              <?php $date = $post['post_date'];
              $sdate=date_create($date);
              echo date_format($sdate,'F d, Y \a\t h:i A'); ?>
            </span>
            <span>
              &nbsp;<i class="fas fa-eye"></i>
              <?php echo $count; ?>
            </span>
          </div>
          <div class="row mt-5">
            <?php echo $post['post_body']; ?>
          </div>
        </div>
        <div class="col-md-3" id="related-study">
          <?php include(PROJECT_ROOT_NOT_LINK . "recent-post.php") ?>
          <?php include(PROJECT_ROOT_NOT_LINK . "archive.php") ?>
        </div>
      </div>
    </div>
    
                
            


    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/rrms-buksu/includes/footer.php';
    ?>

<?php
    $query = "UPDATE `book` SET `views_count` = views_count + 1 WHERE `book`.`book_id` = " . $book_id;
    //echo $query;
    $result = $con->query($query);


?>
</body>
</html>