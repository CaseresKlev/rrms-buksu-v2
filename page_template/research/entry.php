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
    //echo $query;
    $result = $con->query($query);
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()) {
            $book_id = $row['book_id'];
            //echo " p". $book_id;
            $book_title = $row['book_title'];
        }
    }else{
      header("Location: " . PROJECT_ROOT . "404.php?msg=The page you are looking for was not found on this server. Or it was removed by the publisher.&alertType=danger");
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
                                <a href=#>
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
                                    <div class="col-md-12" style="text-align: justify; border-top: 1px solid black; margin-left: 2px; word-break: break-all; word-wrap: break-word;">
                                        '; 
                                        
                                     $reg_exURL = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                     $final = "";
                                     if(preg_match($reg_exURL, $row['refrences'], $url)){
                                        $final = preg_replace($reg_exURL, "<a href=" . $url[0] . ">$url[0]</a>", $row['refrences']);
                                     }


                                    echo  nl2br($final);


                                    echo '</div>
                                </div>
                                <div class="row" style="padding-top: 30px;">
                                    <h3>Research History</h3>
                                    <div class="col-md-12" style="text-align: justify; border-top: 1px solid black;">
                                        <ul>';
                                        $result = $con->query("SELECT `id`, `book_stat`, `date` FROM `bookhistory` WHERE book_id = " . $book_id);
                                        if($result->num_rows>0){

                                            while ($row = $result->fetch_assoc()) {
                                              //print_r($row);
                                              echo '<li class="py-2">';
                                               $date = new DateTime($row['date']);

                                                if($row['book_stat']==="Unpublished"){
                                                  
                                                  echo "Submitted on " . $date ->format('F jS, Y');
                                                }else if($row['book_stat']==="Utilized"){

                                                  $stmt = $con->prepare("SELECT * FROM `utilize` WHERE `book_id` = ?");
                                                  $stmt->bind_param("i", $book_id);
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
                                               echo "</li>";
                                               
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