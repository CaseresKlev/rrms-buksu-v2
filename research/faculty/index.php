<?php
    $book_id;
    include "../includes/connection.php";
    $dbconfig= new dbconfig();
    $con= $dbconfig -> getCon();
    if(isset($_GET['book_id'])){
        $book_id = $_GET['book_id'];
    }else{
        header("Location: ../404.php");
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>RRMS-BUKSU</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-min-4.1.0.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <?php
    	include '../includes/header.php';
    ?>
</head>
<body>
    <div class="container-fluid content-container">
        <div class="row entry">
            <div class="col-md-2" id="featured-study">
                <h4>Featured Study</h4>
              <div class="list-group" id="related-study">
                <a href="#" class="list-group-item">First item First item First item First item</a>
                <a href="#" class="list-group-item">Second item</a>
                <a href="#" class="list-group-item">Third item</a>
                <a href="#" class="list-group-item">First item First item First item First item</a>
                <a href="#" class="list-group-item">Second item</a>
                <a href="#" class="list-group-item">Third item</a>
                <a href="#" class="list-group-item">First item First item First item First item</a>
                <a href="#" class="list-group-item">Second item</a>
                <a href="#" class="list-group-item">Third item</a>
                <a href="#" class="list-group-item">First item First item First item First item</a>
              </div>
            </div>
            <div class="col-md-8" id="field-info">
                <div class="row">
                    <div class="col-md-4" id="cover-div">
                        <img src="cover/5b98b3aed8a385.66287600.jpg" id="cover-img">
                    </div>
                    <div class="col-md-8" id="details">
                        <div class="row" style="border-bottom: 1px solid red; font-style: italic;">
                            <h4 class="tittle">Bukidnon State University Research Record Management System</h4>
                        </div>
                        <table class="table">
                            <tr>
                               <td>
                                   Authors:
                               </td> 
                               <td>
                                   Klevie Jun R. Caseres<br>
                                   Rayanne P. Cruz<br>
                                   Loyd Anthony T. Gozales<br>
                                   Princess Gay Mary L. Tapayan<br>
                               </td>
                            </tr>
                            <tr>
                                <td>
                                    Submitted on:
                                </td>
                                <td>
                                    January 31, 2018
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Keywords:
                                </td>
                                <td>
                                    Research, Document Tracking, Information Technology
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Citation Key:
                                </td>
                                <td>
                                    egdfgebfhhufeyvfbsefsgefvsebfsefhgv
                                </td>
                            </tr>
                            
                        </table>
                        <div class="btn btn-primary">
                            Download
                        </div> 
                    </div>
                </div>
                <br>
                <div class="row" id = "item-bottom">
                   <h4 style="font-style: italic;">Abstract</h4>   
                </div>
                 <div class="text abstract" style="border-top: 1px sold red">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>  
                    <br> 
                <div class="row" id = "item-bottom">
                    <h4 style="font-style: italic;">References</h4>
                </div>
                <div class="row">
                    <ul>
                        <li class="ref-entry">
                            <b><i> Satalkar, B. (2010, July 15). Water aerobics. </i></b><br>
                             <i><a href="">Http://Www.Buzzle.com</a></i>
                        </li>
                        <li class="ref-entry">
                            <b><i> Satalkar, B. (2010, July 15). Water aerobics. </i></b><br>
                             <i><a href="">Http://Www.Buzzle.com</a></i>
                        </li>
                        
                       
                    </ul>
                </div>
                <br>
                <div class="row" id = "item-bottom">
                    <h4 style="font-style: italic;">Research History</h4>
                </div>
                <div class="ref-entry" >
                    <ul>
                        <b><li>Submitted on February 26, 2010</li></b>
                        <b><li>Published on July 27, 2013</li></b>
                    </ul>
                </div>            
        </div> 
        <div class="col-md-2" >
            <h4>Related Study</h4>
              <div class="list-group" id="related-study">
                <a href="#" class="list-group-item">First item First item First item First item</a>
                <a href="#" class="list-group-item">Second item</a>
                <a href="#" class="list-group-item">Third item</a>
                <a href="#" class="list-group-item">First item First item First item First item</a>
                <a href="#" class="list-group-item">Second item</a>
                <a href="#" class="list-group-item">Third item</a>
                <a href="#" class="list-group-item">First item First item First item First item</a>
                <a href="#" class="list-group-item">Second item</a>
                <a href="#" class="list-group-item">Third item</a>
                <a href="#" class="list-group-item">First item First item First item First item</a>
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