<?php
     
    $k= "";
    if(isset($_GET['k']) && !empty($_GET['k'])){
        $k = $_GET['k'];
        //mkdir($rootPath . "2018/");
    }else{
        //header("Location: ../404.php");
    }
    

?>

<!DOCTYPE html>
<html>
<head>
    <?php
    	include '../includes/header.php';
        $book_id;
        include $_SERVER['DOCUMENT_ROOT'] . "/rrms-buksu/includes/connection.php";
        $dbconfig= new dbconfig();
        $con= $dbconfig -> getCon();
        $book_id= null;
        $filename = $rootPath . "index.php";

/*
        if (file_exists($filename)) {
    echo "The $filename file exists";
} else {
    echo "The file $filename does not exist";
}

*/

    $filter = "all";
    $year = date('Y');
    if(isset($_GET['filter']) && !empty($_GET['filter'])){
        $filter = $_GET['filter'];  
    }

    if(isset($_GET['year']) && !empty($_GET['year'])){
        $year = $_GET['year'];  
    }


    
    ?>
</head>
<body>
    <div class="container content">
        <div class="container main-body-wrapler">
            <div class="row">
                <div class="col-md-8 col-sm-12 mb-5">
                	<div class="row alert alert-info" role="alert">
                		Result for <i class="font-weight-bold">&nbsp;<?php echo $k ?></i>
                	</div>
                    
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
                      
                      $offset = ($page-1) * $numPerPage;

                    if($k!==""){
                        //$query = "SELECT * FROM `book` WHERE `aut_type` = ? and trim(coalesce(link, '')) <>''";
                        $query = "SELECT DISTINCT (`book_id`), `book_title`, `abstract`, `keywords`, `views_count`, `cover`, `aut_type`  FROM `book` WHERE (`book_title` like ? or `keywords` like ?) and `enabled` = 1 LIMIT 10 OFFSET " . $offset;
                    }
                    //echo $query;
                    //echo $year;
                    //exit();
                    $stmt = $con->prepare($query);
                    if($k!==""){
                    	$search = "%" . $k . "%";
                        $stmt->bind_param("ss", $search, $search);
                    }


                      //include 'ClassPagination.php';
                      //$classPagination = new PaginationClass();
                      //$classPagination->runQuery($query);
                      

                      $stmt->execute();
                      
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
                      }else{
                        echo "No Result Found";
                      }


                        if($k!==""){
                            //$query = "SELECT * FROM `book` WHERE `aut_type` = ? and trim(coalesce(link, '')) <>''";
                            $query = "SELECT DISTINCT (`book_id`), `book_title`, `abstract`, `keywords`, `views_count`, `cover`, `aut_type`  FROM `book` WHERE (`book_title` like ? or `keywords` like ?) and `enabled` = 1 LIMIT 10 OFFSET " . $offset;
                        }

                        $stmt = $con->prepare($query);
                        if($k!==""){
                            $search = "%" . $k . "%";
                        	$stmt->bind_param("ss", $search, $search);
                        }
                        $stmt->execute();
                        $res = $stmt->get_result();
                        if($res->num_rows>0){
                            while ($row=$res->fetch_assoc()) {
                                echo '<div class="row entry ">
                        <div class="col-md-2" id="cover-div">
                            <a href=research/?book_id=2>
                                <img src="' . PROJECT_ROOT . $row['cover'];
                                echo'" id="cover-img">
                            </a>
                        </div>
                        <div class="col-md-10" id="details">
                            <div class="row">
                                <a href="research/?book_id=2">
                                    <h5 class="tittle">'. $row['book_title'] .'</h5>
                                </a>
                            </div>
                            <div class="row">By: &nbsp';
                                $stmt = $con->prepare('SELECT author.a_id, CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1, 1), ". ", author.a_lname, " ", author.a_suffix) as name FROM `junc_authorbook` inner JOIN author on author.a_id = junc_authorbook.aut_id WHERE book_id = ' . $row['book_id']);
                                $stmt->execute();
                                $resAuth = $stmt->get_result();
                                if($resAuth->num_rows>0){
                                    while ($auth = $resAuth->fetch_assoc()) {
                                        echo ucwords('<a href="'. PROJECT_ROOT .'author/?aut_id='. $auth['a_id'] .'" class="author">'. $auth['name'] .'</a>,&nbsp;');
                                    }
                                }
                            echo '</div>
                            <div class="row">
                                <div class="text abstract">
                                    '. $row['abstract'] .'
                                </div>
                            </div>
                            <div class="row keywords">
                                    Key words: &nbsp;<i style="color:#3366ff">'; 

                                    $kw = explode(",", $row['keywords']);
                                    //print_r($kw);
                                    foreach ($kw as $key) {
                                    	echo '<a href="' . PROJECT_ROOT . "search/?k=" . $key . '">'. $key .',</a>';
                                    }
                                    echo '</i>
                            </div>
                        </div>
                    </div>';
                            }
                        }

                    ?>
                    <!--<div class="row entry">
                        <div class="col-md-2" id="cover-div">
                            <a href=research/?book_id=2>
                                <img src="research/cover/5b98b3aed8a385.66287600.jpg" id="cover-img">
                            </a>
                        </div>
                        <div class="col-md-10" id="details">
                            <div class="row">
                                <a href="research/?book_id=2">
                                    <h5 class="tittle">Bukidnon State University Research Record Management System</h5>
                                </a>
                            </div>
                            <div class="row">
                                By: &nbsp<a href="author/?aut_id=2" class="author">Klevie Jun R. Caseres </a>, &nbsp<a href="author/?aut_id=3" class="author">Anne P. Cruz </a>, &nbsp
                                                    &nbsp; - 2018
                            </div>
                            <div class="row">
                                <div class="text abstract">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </div>
                            <div class="row keywords">
                                    Key words: &nbsp;<i style="color:#3366ff">BukSu, Document Management, </i>
                            </div>
                        </div>
                    </div>-->
                <div class="row my-3">
                    
                </div>  
                <?php
                if($count>0){
                    $head = '?filter=' . $filter . '&year=' . $year . '&page=';
                    include PROJECT_ROOT_NOT_LINK . "includes/pagination.php";
                }
                    

                ?>        
                </div>
                <!--widget area -->
                <!--related study-->
                    <div class="col-md-4" id="related-study">
                        <?php include(PROJECT_ROOT_NOT_LINK . "recent-post.php") ?>
                        <?php include(PROJECT_ROOT_NOT_LINK . "archive.php") ?>
                    </div>
            </div>
        </div>
    </div>

    <?php
        include '../includes/footer.php';
    ?>

<!-- JQUERY JS -->
<script src="../js/jquery-3.3.1.slim.min.js"></script>
<!-- Bootstrap JS -->
<script src="../js/bootstrap.min-4.1.0.js"></script>
</body>
</html>