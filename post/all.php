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
    <div class="container content">
      <div class="container main-body-wrapler">
        <div class="row">
          <div class="col-md-9 col-sm-12">
            <div class="row border-bottom-5 border-bottom">
              <h2>Post</h2>
            </div>
            <?php
              $page = 1;
              $numPerPage = 20;
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
                  echo '<div class="my-4">
              <div class="row">
                <a href="index.php?post_id='. $row['id'] .'"> <h5 class="text-info">'. $row['post_tittle'] .'</h5></a>
              </div>
              <div class="row text-muted border-bottom" style="font-size: 9pt;">
                <span>
                  Posted by <i class="fas fa-user"></i>&nbsp;'. ucwords($row['post_user']) .'
                </span>
                <span>
                  &nbsp; <i class="fas fa-clock"></i>&nbsp;';
                   $date = $row['post_date'];
                  $sdate=date_create($date);
                  echo date_format($sdate,'F d, Y \a\t h:i A'); 
                  echo '
                </span>
                <span>
                  &nbsp;<i class="fas fa-eye"></i>
                  <?php //echo $count; ?>
                  '. $row['views_count'] .'
                </span>
              </div>
            </div>';
                }

              }else{
                echo "No record to show.";
              }
              $head = "?page=";
              //echo $count;
              if($count>0){

                include(PROJECT_ROOT_NOT_LINK . "includes/pagination.php");
              }
              //echo $head;
            ?>
            
          </div>
          <div class="col-md-3" id="related-study">
            <?php include(PROJECT_ROOT_NOT_LINK . "recent-post.php") ?>
            <?php include(PROJECT_ROOT_NOT_LINK . "archive.php") ?>
          </div>
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