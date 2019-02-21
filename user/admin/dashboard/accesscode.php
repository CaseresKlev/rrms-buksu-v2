<?php
    $currentDIR = "";
    $cur = "accesscode";
  session_start();
  $loaded = false;

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

    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>


</head>
<body>
	<div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'sidebar.php' ?>

        <!-- Page Content  -->
        <div id="content">

            <?php include 'toggle_menu.php' ?>


           <!---- PLACE YOUR DIVS HERE --->

            <div class="container">
                <div class="row">
                   <center><h3> GENERATE ACCESS CODE </h3></center>
                 </div>
                <script>

				function numbersonly(input){
					var numall= /[^0-9]/gi;
					input.value= input.value.replace(numall, "");
				}
			     </script>
                <div class="line"></div>

                <div class="row">
                  <div class="col-md-12">
                      Number of Access Code:
                    </div>
                    <div class="col-md-6">
                        <input type="number" placeholder="0"  class="form-control" name="number" min="0" value="0" id="access-count" onkeyup="numbersonly(this)" required>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-6">
                        <button type="button" id="admin-btn-generate" class="btn  btn-primary" style="float:left"> GENERATE </button>
                    </div>
                </div>


            </div>
            <div class="line"></div>

            <div class="container">
                <div class="row" style="text-align:center">

                    <h5>Available Accesskey</h5>
                </div>
                <div class="row" id="printtable">

                    <table style="width:100%"border="1" cellpadding="3" id="tbl-accescodes" style="font-size: 15px" >

					<tr class="access-tr-head">
						<th id="access-th">Count</th>
						<th id="access-th">Access Codes</th>
						<th id="access-th">Type</th>
					</tr>
					<?php
						
						
						$query = null;
						if($_SESSION['type']=="INSTRUCTOR"){
							$query = "SELECT * FROM `acesskey` WHERE used=0 and type='student'";
						}else{
							$query = "SELECT * FROM `acesskey` WHERE used=0 and type='instructor' and ins_id = 0";
						}

						$result = $con->query($query);
						if($result->num_rows>0){
							$i=1;
							while($row=$result->fetch_assoc()){
								echo "<tr class=\"access-tr-head\">
										<th id=\"access-th\">$i</th>
											<th id=\"access-th\">" . $row['acesskey'] . "</th>
												<th id=\"access-th\">" . $row['type'] . "</th>
										</tr>";
										$i++;
							}
						}


					?>
				</table>
                </div>

                <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
                <div class="row">
                    <button class="btn btn-primary"onclick="printDiv()" style="width: 100px; font-size: 13pt">Print</button>
                </div>



            </div>
            <script>
		function printDiv() {
			 window.frames["print_frame"].document.body.innerHTML = document.getElementById("printtable").innerHTML;
			 window.frames["print_frame"].window.focus();
			 window.frames["print_frame"].window.print();
		 }
		</script>






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
       <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
      <script src="js/accesscode.js"></script>


</body>
</html>
