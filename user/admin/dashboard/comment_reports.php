
<?php
  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");  
  include PROJECT_ROOT_NOT_LINK . "user/admin/dashboard/preload.php";
if(isset($_GET['paper_trail'])){
  $trail_id = $_GET['paper_trail'];
  $origin = "";
  $author = "";
  $book_title = "";
//echo "$trail_id";


  
  $dbconfig = new dbconfig();
  $conn = $dbconfig->getCon();
  $query = "SELECT comments.parts, comments.comments, comments.origin, comments.page, book.book_title, (SELECT concat('',(GROUP_CONCAT((select concat( author.a_lname, ',', SUBSTRING(author.a_fname, 1,1))) SEPARATOR '; '))) as authors FROM junc_authorbook INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id = book.book_id) AS 'authors' from comments INNER JOIN paper_trail on paper_trail.id = comments.trail_id INNER JOIN book on book.book_id = paper_trail.book_id where paper_trail.id = $trail_id";
  $result = $conn->query($query);
  if($result->num_rows>0){
    while ($row=$result->fetch_assoc()) {
      //echo "string";
      $origin = $row['origin'];
      $author = $row['authors'];
      $book_title = $row['book_title'];
    }
  }


}else{
  header("Location: " . PROJECT_ROOT ."404.php");
}
//echo $origin;
?>




<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Comment Reports </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--bootstrap-->
    
    
    <script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.slim.min.js")?> "></script>

    <link rel="stylesheet" type="text/css" href="<?php echo(PROJECT_ROOT . "css/bootstrap-min-4.1.0.css"); ?>">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/dashboard.css"); ?>">
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/Animate.css"); ?>">
    <!-- scrollbar -->
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/custom_scroll.css"); ?>">

    <script defer src="<?php echo(PROJECT_ROOT . "js/solid.js"); ?>"></script>
    <script defer src="<?php echo(PROJECT_ROOT . "js/fontawesome.js"); ?>"></script>
    <script defer src="<?php echo(PROJECT_ROOT . "js/bootstrap-notify.js"); ?>"></script>

          <style type="text/css">

            #annecomment {
              width: 130%;
            }

            #buksulogo {
              max-width:100%;
              max-height:100%;
            }

            #anneheader1 {
              width: 100%;
              text-align: center;
              font-size: 25pt;
            }

            #anneheader2 {
              width: 100%;
              text-align: center;
              font-size: 15pt;
            }

            #anneheader3 {
              width: 100%;
              text-align: center;
              font-size: 14pt;
            }

            #tabletwo {
              border:1px solid black;
              text-align: center;
              margin: 2px;
              padding: 0.75rem;
            }

            #tabletextfield {
              border:1px solid black;
              margin: auto;
              padding: 10%;
            }

            hr {
              display: block;
              height: 1px;
              border: 0;
              border-top: 1px solid #ccc;
              margin: 1em 0;
              padding: 0;
              border-color: inherit;
              width: 70%;
            }

            p {
              font-size: 90%;
            }

            #footer {
              position: relative;
              bottom: 0px;
              width: 100%;
              margin-left: auto;
              margin-right: auto;
              margin-top: auto;
              margin-bottom: auto;
              display: none;
            }


            /*@page{
              margin: .3cm;
              margin-left: 10mm;
              margin-top: 5mm;
              margin-bottom: 30mm;
              /*@bottom-center {
                content: element(footer);
              }
            }*/


            /*@bottom-center {
              content: element(footer);
            }*/

            /*@page {
              @bottom-center {
                content: element(footer);
              }
            }*/

            .unofficial{
              z-index: -1;
            }

            .tablesecond{
              max-height: 70%;
            }

            @media print {
              /*@bottom-center {
                content: element(footer);
              }*/
              .sig{
                width: 100%;
                position: fixed;
                bottom: 110px;
                margin-top: 30px;
              }
              footer {
                position: fixed;
                bottom: 0;
              }

              .content-block, p {
                page-break-inside: avoid;
              }

              html, body {
                width: 215.9mm;
                height: 250.4mm;
                /*height: 279.4mm;*/
              }

              .logo{
                flex: 16.666667%;
                max-width: 16.666667%;
              }

              #buksulogo{
                padding-top: 0px;
                height: 110px;
                width: 110px;
              }

              .head-address{
                flex: 66.666667%;
                max-width: 66.666667%;
              }

              .signature{
                    flex: 0 0 50%;
                    max-width: 50%;
              }

              .unofficial{
                z-index: 10 !important;
                position: absolute;
                opacity: 0.4;
                width: 100%;
                height: 100%;
                margin: auto;
              }

              .option{
                display: none;
              }

              .page::before{
                counter-increment: section;
                /*content: "Page " counter(section) ": ";*/
               
              }

              .tablesecond{
                background-color: red;
                max-height: 70%;
                page-break-inside: avoid;
              }

              /*table { page-break-inside:auto }
              tr    { page-break-inside:avoid; page-break-after:auto }*/

            }

            @media screen {
              footer {
                display: none;
              }

              .sig{
                display: none;
              }

              .unofficial{
                z-index: -1 !important;
                position: absolute;
              }


            }

            footer {
              width: 100%;
              font-size: 11px;
              color: gray;
              text-align: center;
            }

            @page {
              size: letter;
              margin: 8mm 10mm 0mm 17mm;
            }
            
@page:right{ 
  @bottom-left {
    margin: 10pt 0 30pt 0;
    border-top: .25pt solid #666;
    content: "My book";
    font-size: 9pt;
    color: #333;
  }
}





          </style>
</head>
<body>
    
    <div class="container">
        <div class="row option mb-3 bg-dark">
          <button class="btn  btn-success btn-md ml-auto m-2" id="print">Print Comments</button>

        </div>

        <div class="row" style="padding-left: 30px; margin-left: auto; margin-right:auto;">

              <div class="col-sm-2 logo pt--5">
                  <img id="buksulogo" src="<?php echo(PROJECT_ROOT . "img/BukSU Logo.png"); ?>">
              </div>
              <div class="col-md-8 head-address" style="text-align:justify;">
                
                  <h4 class="text-center"> BUKIDNON STATE UNIVERSITY </h4>
                  <p class="h6 text-center">Malaybalay City, Bukidnon 8700</p>
                  <p class="h6 text-center">Tel (088) 813-5661 to 5663; TeleFax (088) 813-2717, <a href="#"> www.buksu.edu.ph </a></p>

                      


                      <!--<p id="anneheader2">Malaybalay City, Bukidnon 8700</p>


                      <p id="anneheader3"> Tel (088) 813-5661 to 5663; TeleFax (088) 813-2717, <a href="#"> www.buksu.edu.ph </a> </p>-->

                  <h4 style="text-align:center; width:100%;"> SUMMARY OF COMMENTS AND SUGGESTIONS </h4>
              </div>
        </div>
        <br>
        <br>


        <div class="row">
            <h6> Originator: </h6>
        </div>
        <div class="row">
          <table width="100%" id="tablefirst" class="table" style="border:1px solid black;">

                
                <tr>
                    <td scope="col" style="height: 60px; border:1px solid black;">
                      <i class="fas fa-square-full" style="color:<?php if($origin==="Research Committee"){ echo "#3399ff"; }else{ echo "white"; }  ?>;"></i>
                      Research Committee
                    </td>
                    <td scope="col" style="height: 60px; border:1px solid black;">
                      <i class="fas fa-square-full" style="color:<?php if($origin==="Internal Reviewers"){ echo "#3399ff"; }else{ echo "white"; }  ?>;"></i>
                      Internal Reviewers
                    </td>
                    <td scope="col" style="height: 60px; border:1px solid black;">
                      <i class="fas fa-square-full" style="color:<?php if($origin==="Panel of Experts"){ echo "#3399ff"; }else{ echo "white"; }  ?>;"></i>
                      Panel of Experts
                    </td>
                    <td scope="col" style="height: 60px; border:1px solid black;">
                      <i class="fas fa-square-full" style="color:<?php if($origin==="External Reviewers"){ echo "#3399ff"; }else{ echo "white"; }  ?>;"></i>
                      External Reviewers
                    </td>
                    <td scope="col" style="height: 60px; border:1px solid black;">
                      <i class="fas fa-square-full" style="color:<?php if($origin==="Research Ethics Commit"){ echo "#3399ff"; }else{ echo "white"; }  ?>;"></i>
                      Research Ethics Committee
                    </td>
                </tr>

          </table>
        </div>

            <br>
            <br>

            <div class="row">
                <h5> Research Title:   <?php echo $book_title ?></h5>
            </div>
              <div class="row">
                  <h5> Proponents:   <?php echo $author ?></h5>
              </div>

              <br>

                        <div class="row">
                            <table width="100%" id="tablesecond" class="tablesecond" style="padding: 0.75rem">
                              <thead>
                                <tr style="border:1px solid black;">
                                  <th id="tabletwo"> Part of the Manuscript </th>
                                  <th id="tabletwo"> Comments and Suggestions </th>
                                  <th id="tabletwo"> Pages </th>
                                </tr>
                              </thead>
                              <tbody>
                              
                               

                              
                                <?php
                                $issued = "";
                                  $dbconfig = new dbconfig();
                                  $conn = $dbconfig->getCon();
                                  $query = "SELECT comments.date, comments.parts, comments.comments, comments.origin, comments.page, book.book_title, (SELECT concat('',(GROUP_CONCAT((select concat( author.a_lname, ',', SUBSTRING(author.a_fname, 1,1))) SEPARATOR '; '))) as authors FROM junc_authorbook INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id = book.book_id) AS 'authors' from comments INNER JOIN paper_trail on paper_trail.id = comments.trail_id INNER JOIN book on book.book_id = paper_trail.book_id where paper_trail.id = $trail_id";
                                  //echo "$query";
                                  $result = $conn->query($query);

                                    if($result->num_rows>0){

                                    while ($row=$result->fetch_assoc()) {

                                      //$origin = $row['origin'];
                                      echo '
                                <tr style="border:1px solid black;">
                                  <td id="tabletwo">'. $row['parts'] .'</td>
                                  <td id="tabletwo"> '.  $row['comments'] .' </td>
                                  <td id="tabletwo"> '. $row['page'] .' </td>
                                </tr>';
                                  $issued = $row['date'];
                                    }
                                  }else{
                                    echo "No Comments yet.";
                                  }

                                  ?>
                                  </tbody>
                            </table>
                            
                        </div>




                                  <div class="row sig">
                                    
                                      <div class="col-md-6 signature">
                                          <h5> Summarized by: </h5>
                                          <br>
                                          <hr>
                                      </div>

                                      <div class="col-md-6 signature">
                                          <h5> Reviewed and approved by: </h5>
                                          <br>
                                          <hr>
                                      </div>
                                      
                                  </div>

                                        <footer>
                                        
                                          <table class="table" >
                                            <tr>
                                            <td scope="col">
                                              <em> Document Code: RU- F-032 </em>
                                            </td>
                                            <td scope="col">
                                              <em> Revision No. : 002 </em>
                                            </td>
                                            <td scope="col">
                                              <em> Issue No. 002 </em>
                                            </td>
                                            <td scope="col">
                                              <em> Issue Date: <?php 
                                              $dd = date_create($issued);
                                              echo date_format($dd, 'F d, Y'); ?> </em>
                                            </td>
                                            <td scope="col">
                                              <em class="page"> Page no. _____ of _____ </em>
                                            </td>
                                          </tr>
                                          </table>
                                              
                                        </footer>



              
            </div>
    <script type="text/javascript">
      $("#print").click(function(){
        $("#footer").show();
      $(this).hide();
      //$("#printable").hide();
      window.print();

    });
      window.onafterprint = function(){
       $("#filter-div").show();
       $("#print").show();
       $("#footer").show();
    }

    
    </script>
</body>
</html>
