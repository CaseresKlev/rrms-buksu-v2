<?php
    $book_id = "";
    include $_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/connection.php";
    $dbconfig= new dbconfig();
    $con= $dbconfig -> getCon();
    /*if(isset($_GET['book_id'])){
        $book_id = $_GET['book_id'];
    }else{
       // header("Location: ../404.php");
    }*/
    $actual_link = "$_SERVER[REQUEST_URI]";
    //echo $actual_link;
    $arr = explode("/", $actual_link);
    $arr[5];
    $query = 'SELECT `book_id`, book_title FROM `book` WHERE `link` = "'. $arr[5].'"';
    //echo $query;
    $book_title = null;
    $result = $con->query($query);
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()) {
            $book_id = $row['book_id'];
            //echo " p". $book_id;
            $book_title = $row['book_title'];
        }
    }else{

    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>RRMS-<?php echo $book_title; ?></title>
    <?php
    	include ($_SERVER["DOCUMENT_ROOT"] . '/rrms-buksu/includes/header.php');
    ?>
</head>
<body>
    <div class="se-pre-con"></div>
    <?php
        if($book_id!=""){
            $query = 'SELECT * FROM `book` WHERE `book_id` = ' . $book_id;
            $result = $con->query($query);
            if($result->num_rows>0){
                echo '<div class="container content">
        <div class="container main-body-wrapler">';
                while($row = $result->fetch_assoc()){
                    echo '
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="row" style="padding-bottom: 30px;">
                            <div class="col-md-3" id="cover-div">
                                <a href=research/?book_id=2>
                                    <img src="' . PROJECT_ROOT . $row['cover'] . '" id="cover-img">
                                </a>
                            </div>
                            <div class="col-md-9" id="details">
                                <div class="row">
                                    <a href="#">
                                        <h5 class="tittle">'. $row['book_title'] .'</h5>
                                    </a>
                                </div>
                                <div class="row">
                                    <table class="table table-details">
                                        <tbody>
                                            <tr>
                                              <th scope="row">Author(s):</th>
                                              <td>';

                                                    $query = 'SELECT author.a_id, CONCAT(author.a_fname, " ", substring(author.a_mname, 1,1), ". ", author.a_lname, " " , author.a_suffix  ) as name FROM `junc_authorbook` INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id = ' . $book_id;
                                                    $author = $con->query($query);
                                                    if($author->num_rows>0){
                                                        while($authorRow = $author->fetch_assoc()){
                                                            echo '<a href="'. PROJECT_ROOT .'author/?aut_id='. $authorRow['a_id'] .'" class="minor-link">'. $authorRow['name'] .'</a><br>';
                                                        }
                                                    } 

                                              echo '</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Date Submitted:</th>
                                              <td>'; 
                                                $date = $row['pub_date'];
                                                $sdate=date_create($date);
                                                echo date_format($sdate,'F d, Y'); 
                                                //January 31, 2018
                                              echo '</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Research Type:</th>
                                              <td>  
                                                '. ucfirst($row['aut_type']) .' Research
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Status:</th>
                                              <td>  
                                                '. $row['status'] .'
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Keywords:</th>
                                              <td style="font-style: italic;"> 
                                                '. $row['keywords'] .'
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Citation Key:</th>
                                              <td>  
                                                '. $row['refkey'] .' &nbsp; <div class="btn btn-primary btn-sm">Copy</div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Awards:</th>
                                              <td>';  
                                                $query = 'SELECT * FROM `awards` WHERE `book_id` = ' . $book_id;
                                                $awards = $con->query($query);
                                                if($awards->num_rows>0){
                                                    while ($awardsRow = $awards->fetch_assoc()) {
                                                        echo '<ul>
                                                            
                                                            <div class="row">
                                                              <li>  <b style="color:blue;">'. $awardsRow['awards'] .'</b>
                                                            </div>
                                                            <div class="row">
                                                                by '. $awardsRow['parties'] .' at '. $awardsRow['location'];

                                                                $date = $awardsRow['date'];
                                                                $sdate=date_create($date); 
                                                                echo '  last ' . date_format($sdate,'F d, Y') .'
                                                            </div>
                                                            </li>
                                                        </ul>'; 
                                                    }
                                                }
                                              echo '</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Views:</th>
                                              <td>  
                                                '. $row['views_count'] .' time(s)
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">
                                                  Download
                                              </th>
                                              <td>';

                                                if($row['dowloadable']==="1"){
                                                    echo '
                                                    <a href="' . PROJECT_ROOT . $row['docloc'] .'" target="_blank">
                                                        <div class="btn btn-sm btn-primary">
                                                            Download
                                                        </div>
                                                    </a>';
                                                }else{
                                                    echo "Download Restricted by the Author";
                                                }
                                                
                                              echo '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <div class="row">
                                    <h3>Abstract</h3>
                                    <div class="text" style="text-align: justify; border-top: 1px solid black;">
                                        '. $row['abstract'] .'
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 30px;">
                                    <h3>References</h3>
                                    <div class="col-md-12" style="text-align: justify; border-top: 1px solid black; margin-left: 2px;">
                                        <ul>';
                                            $query = 'SELECT ref.reftitle, ref.link FROM `junk_bookref` inner JOIN ref ON ref.id = junk_bookref.webref_id WHERE junk_bookref.book_id = ' . $book_id;
                                            $ref = $con->query($query);
                                            if($ref->num_rows>0){
                                                while($refRow=$ref->fetch_assoc()){
                                                    echo '
                                                    <li  class="link-details">
                                                <h6>'. $refRow['reftitle'] .' Retreived from</h6>
                                                <a class="minor-link" href="'. $refRow['link'] .'" target="_blank">'. $refRow['link'] .'</a>
                                            </li>';
                                                }
                                            }
                                            
                                        echo '</ul>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 30px;">
                                    <h3>Research History</h3>
                                    <div class="col-md-12" style="text-align: justify; border-top: 1px solid black;">
                                        <ul>';
                                        $query = 'SELECT * FROM `bookhistory` WHERE `book_id` = ' . $book_id;
                                            $history = $con->query($query);
                                            if($history){
                                                while($historyRow = $history->fetch_assoc()){
                                                    if($historyRow['book_stat']==="Unpublished"){
                                                        echo '
                                                    <li style="padding-top: 10px;">
                                                        <h6>Unpublished / Submited on'; 

                                                        $date = $historyRow['date'];
                                                                $sdate=date_create($date); 
                                                                echo ' ' . date_format($sdate,'F d, Y');

                                                        echo '</h6>
                                                    </li>';
                                                    }
                                                    
                                                }
                                            }

                                            
                                        echo '</ul>
                                    </div>
                                </div>
                            </div>';
                }
                echo '</div>
                </div>';
            }

          
        }else{
            include ($_SERVER["DOCUMENT_ROOT"] . '/rrms-buksu/404.php');
            
        }

    ?>
    <!--<div class="container content">
        <div class="container main-body-wrapler">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="row" style="padding-bottom: 30px;">
                            <div class="col-md-3" id="cover-div">
                                <a href=research/?book_id=2>
                                    <img src="<?php echo  (PROJECT_ROOT . "research/2018/student/cover/5b98b3aed8a385.66287600.jpg")?>" id="cover-img">
                                </a>
                            </div>
                            <div class="col-md-9" id="details">
                                <div class="row">
                                    <a href="research/?book_id=2">
                                        <h5 class="tittle">Bukidnon State University Research Record Management System</h5>
                                    </a>
                                </div>
                                <div class="row">
                                    <table class="table table-details">
                                        <tbody>
                                            <tr>
                                              <th scope="row">Author(s):</th>
                                              <td>  <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "/rrms-buksu/"?>" class="minor-link">Klevie Jun R. Caseres</a><br>
                                                    <a href="" class="minor-link">Anne Perlin Cruz</a><br>
                                                    <a href="" class="minor-link">Loyd Anthony T. Gonzales</a><br>
                                                    <a href="" class="minor-link">Princess Gay Marry l. Tapayan</a><br>
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Date Submitted:</th>
                                              <td>  
                                                January 31, 2018
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Status:</th>
                                              <td>  
                                                Published at CHED accredited Journal - 2018 <br><a href=""> journal.com/indeds/fueshysebf/jfsjefb</a>
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Keywords:</th>
                                              <td style="font-style: italic;"> 
                                                BukSu, Document Management, Research, Management System
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Citation Key:</th>
                                              <td>  
                                                Un5lAdageHbLgKUhF8aLklshoq6BjxDR &nbsp; <div class="btn btn-primary btn-sm">Copy</div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Awards:</th>
                                              <td>  
                                                130 times
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Views:</th>
                                              <td>  
                                                130 times
                                              </td>
                                            </tr>
                                            <tr>
                                              <th scope="row">
                                                  Download
                                              </th>
                                              <td>
                                                  <div class="btn btn-sm btn-primary">
                                                      Download
                                                  </div>
                                              </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <div class="row">
                                    <h3>Abstract</h3>
                                    <div class="text" style="text-align: justify; border-top: 1px solid black;">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 30px;">
                                    <h3>References</h3>
                                    <div class="col-md-12" style="text-align: justify; border-top: 1px solid black; margin-left: 2px;">
                                        <ul>
                                            <li  class="link-details">
                                                <h6>Morem, S. (2005). 101 tips for graduates. Retreived</h6>
                                                <a class="minor-link" href="">http://www.easybib.com/reference/guide/apa/book</a>
                                            </li>
                                            <li class="link-details">
                                                <h6>Morem, S. (2005). 101 tips for graduates. Retreived</h6>
                                                <a class="minor-link" href="">http://www.easybib.com/reference/guide/apa/book</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 30px;">
                                    <h3>Research History</h3>
                                    <div class="col-md-12" style="text-align: justify; border-top: 1px solid black;">
                                        <ul>
                                            <li style="padding-top: 10px;">
                                                <h6>Published at Journal of Information Technology - June 15, 2019</h6>
                                            </li>
                                            <li style="padding-top: 10px;">
                                                <h6>Unpublished - March 15, 2019</h6>
                                            </li>
                                            <li style="padding-top: 10px;">
                                                <h6>Submitted - March 15, 2019</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div> -->
                <div class="col-md-3" id="related-study">
                      <div class="list-group" >
                        <div class="list-group-item bg-dark" id="widget-header">
                            Recent Post
                        </div>
                        
                        <?php
                            $dbconfig= new dbconfig();
                            $con= $dbconfig -> getCon();
                            $query = "SELECT `id`, `post_tittle`, `location` FROM `post` ORDER BY `post_date` DESC LIMIT 5";
                            $result = $con->query($query);
                            if($result->num_rows>0){
                                while ($row = $result->fetch_assoc()) {
                                    echo '<a href="'. $rootPath . $row['location'] . '?post_id=' . $row['id'] . '" class="list-group-item">'. $row['post_tittle'] .'</a>';
                                }
                            }
                        ?>
                      </div>

                       <div class="list-group" >
                        <div class="list-group-item bg-dark" id="widget-header">
                            Archive
                        </div>

                        <?php
                            $dbconfig= new dbconfig();
                            $con= $dbconfig -> getCon();
                            $query = "SELECT DISTINCT year(pub_date) as archive FROM `book` ORDER BY(year(pub_date)) DESC LIMIT 10";
                            $result = $con->query($query);

                            if($result->num_rows>0){
                                while($row = $result->fetch_assoc()){
                                    echo '<a href="#" class="list-group-item">'. $row['archive'] .'</a>';
                                }
                                if($result->num_rows>1){
                                    echo '<a href="'. $rootPath .'research/all-year/" class="list-group-item">>> View all Year</a>';
                                }
                            }else{
                                echo '<a href="#" class="list-group-item">No archive found</a>';
                            }
                        ?>
                      </div>
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