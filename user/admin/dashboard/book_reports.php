<?php

	session_start();
	if(isset($_SESSION['uid'])){
		//print_r($_SESSION);
	}else{
		//echo "Not Login";
		header("Location: index.php");
	}

?>


<!DOCTYPE html>
<html >
<head>
	<title>RRMS Reports</title>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" type="text/css" media="screen" href="css/book_reports.css" />-->
    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/print.js"></script>
	<style type="text/css">

		@media print{
			
		}
		table, tr, td{
    	/*border-collapse: collapse;*/
    	text-align: left;
    	word-wrap:break-word;

		}

		#logo{
			padding-right: 18%;
		}

		body * {
			/*margin-left: auto;
			margin-right: auto;*/
			-webkit-print-color-adjust: exact !important;

		}

		#line{
			width:100%; height:3px; background-color:  #1f2833
		}
		#line-up{
			width:100%;
			height: 40px;
			background-color: red;
			display: none;

		}

		#left-b{
			background-color:  #1f2833;
			width: 100%;
			display: inline-block;
		}

		@page{
  			margin-left: 0mm;
  			margin-top: 0mm;


		}

		@media print {
			#Header, #Footer { display: none !important; }
			a{
				color: inherit !important; /* blue colors for links too */
  				text-decoration: inherit !important; /* no underline */

			}

			.report-table {
				background-color: white !important;
			}

			@page{
  			margin-left: 10mm;
  			margin-top: 0mm;


			}
			#line-up{
				width:100%;
				height: 30px;
				background-color: white !important;
				display: block;

			}

			#gray{
				background-color: white !important;
				background-attachment: fixed;
			}
		}

		#example tr:nth-child(even) {
    		background-color: #dddddd;
		}


		#example{
			font-family: arial, sans-serif;
    		border-collapse: collapse;
   			 width: 100%;
		}

		#example tr{
			border: 1px solid #dddddd;
    		text-align: left;
    		padding: 8px;
		}

		#example td{
			border: 1px solid gray;
    		text-align: left;
    		padding: 4px;
		}

		#example th{
			border: 1px solid gray;
    		text-align: left;
    		padding: 4px;
    		text-align: center;
		}

		#filter{
			font-family: arial, sans-serif;
    		border-collapse: collapse;
   			 width: 100%;
		}

		#filter th{
    		text-align: left;
    		padding: 10px;

		}

	 	.printbody {
			/*background-image: url("img/BukSU-0014.png");*/
			background-repeat: no-repeat;
			background-color: rgba(214, 214, 194, .50) !important;
			background-size: cover;
			height: 100%;
			width: 100%;
			background-attachment: fixed;
			margin: 0px;
		}

		.report-table {


		}

		#tbl{
			width: 90%;
			margin-left: auto !important;
			margin-right: auto !important;
		}
		#gray{

			/*background-color: rgba(214, 214, 194, .50);*/
			background-color: rgba(214, 214, 194, .85);

			background-color: rgba(214, 214, 194, .80);
			    background-color: #ffffffc9;
			background-attachment: fixed;
		}






	</style>

</head>
<body id="print-area" class="printbody">
	<div id="gray">
	<?php

	$filtertitle = $_GET['title'];
	$filterdept =  $_GET['dept'];
	$filterstat = $_GET['status'];
	$filteraut = $_GET['author'];
	$filterfrom = $_GET['from'];
	$filterto = $_GET['to'];

	//echo "$filtertitle $filterdept $filterstat $filteraut $filterfrom $filterto";

  $connect = mysqli_connect("localhost", "root", "", "db_rrms");
  //$query ="SELECT * FROM book ORDER BY book_id DESC";
  $query = "SELECT book.book_id, book.book_title, (SELECT department.cat_name FROM department WHERE book.department = department.id) as 'dept', bookhistory.book_stat, (SELECT concat('',(GROUP_CONCAT((select concat( author.a_lname, ',', SUBSTRING(author.a_fname, 1,1))) SEPARATOR '; '))) as authors FROM junc_authorbook INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id = book.book_id) AS 'authors', bookhistory.date FROM book
INNER JOIN department on department.id = book.department
INNER JOIN bookhistory on book.book_id = bookhistory.book_id WHERE book.book_title LIKE '%". $filtertitle ."%' and YEAR(bookhistory.date) >= '" . $filterfrom ."' and YEAR(bookhistory.date) <='" . $filterto ."' and department.cat_name LIKE '%" .$filterdept . "%' and bookhistory.book_stat like '%$filterstat%' ORDER BY bookhistory.date DESC";

 // $query = "SELECT book.book_id, book.book_title, (SELECT department.cat_name FROM department WHERE book.department = department.id and department.cat_name like 'education') as 'dept', bookhistory.book_stat, (SELECT concat('',(GROUP_CONCAT((select concat( author.a_lname, ',', SUBSTRING(author.a_fname, 1,1))) SEPARATOR '; '))) as authors FROM junc_authorbook INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id = book.book_id or author.a_fname LIKE '%rasheed%' or author.a_mname LIKE '%rasheed%' or author.a_lname LIKE '%rasheed%') AS 'authors', bookhistory.date FROM book INNER JOIN bookhistory on book.book_id = bookhistory.book_id WHERE book.book_title LIKE '%asia%' and YEAR(bookhistory.date) >= '2018' and YEAR(bookhistory.date) <='2018'";
  $result = mysqli_query($connect, $query);


?>
	<div id="line-up">

	</div>
		<br/>

		<table width="100%" id="tbl">

			<tr>
				<td width="5px">
					<div id="left-b">

					</div>

				</td>
				<td class="report-table">
					<div id="rep-banner">

						<table width="100%">
							<tr>
								<td rowspan="3" id="logo" width="150px">
									<img src="img/BukSU Logo.png" width="100px"; height="100px">
								</td>
								<td>
									<b style="font-size: 22pt">Bukidnon State University</b><br>
									<b style="font-size: 14pt; font-weight: normal;">Research and Development Unit<br>
									Malaybalay City Bukidnon</b>
									</td>
							</tr>
							<tr>
								<td>

								</td>
							</tr>
							<tr>
								<td>

								</td>
							</tr>

						</table>

					</div>
					<br>
					<div id="line">

					</div>

					<center><h2>Research Reports</h2></center>
					<div id="filter-div">
					<b style="font-size: 16pt">Filter Options:</b>
					<table id="filter" width="100%" style="border: 1px solid red">
						<tr>

              						<th width="20%">Filter Title &nbsp; <br><br><textarea id="filter-title" style="width: 98%;" rows="5" placeholder="Tittle or Keywords"></textarea></th>
              						<th width="15%" style="padding-top: 0px">Filter Date: <br>
              							<table>
              								<tr>
              									<td>From:</td>
              									<td><input type="number" id="filter-from" Value = "0" width="100%"></td>


              								</tr>
              								<tr>
              									<td>To:</td>
              									<td>
              										<?php
              										$d = Date('Y-m-d');
              										$yr = explode("-", $d);

              										echo '<input type="number" id="filter-to" Value = "' . $yr[0] . '" width="100%">' ;
              									?>

              									</td>
              								</tr>
              							</table>
              						</th>
              						<th width="15%">
              							Filter Department:<br><br><br>
              							<select id="filter-dept" style="width: 100%">
              								<option>All</option>
              								<?php
              									include_once 'connection.php';
              									$dbconfig = new dbconfig();
              									$conn = $dbconfig->getCon();
              									$query = "SELECT `cat_name` FROM `department` WHERE 1";
              									$dept = $conn->query($query);

              									while ($rowdept = $dept->fetch_assoc()) {
              										echo "<option>" . $rowdept['cat_name'] . "</option>";
              									}

              								?>

              							</select>
              							<br><br>
              							<br>
              						</th>
              						<th width="15%">Filter Status:<br><br><br>
              							<select id="filter-stat" style="width: 100%">
              								<option>All</option>
              								<?php
              									include_once 'connection.php';
              									$dbconfig = new dbconfig();
              									$conn = $dbconfig->getCon();
              									$query = "SELECT DISTINCT (`status`) FROM `book` WHERE 1";
              									$dept = $conn->query($query);

              									while ($rowdept = $dept->fetch_assoc()) {
              										echo "<option>" . $rowdept['status'] . "</option>";
              									}

              								?>
              							</select>
              							<br><br>
              							<br>

              						</th>
              						<th width="20%">Filter Authors:<br>
              							<textarea id="filter-aut" style="width: 98%;" rows="6"></textarea>
              						</th>
            					</tr>
					</table>
					<br>
					<button id="btnFilter" >FILTER</button>
					<button id="resetfilter" >Reset Filter</button>
					<br>
					<br>
					<br>
					</div>
					<table id="example" class="display nowrap" cellspacing="0" width="100%">
          					<thead style="text-align: left;">
            					<tr>
              						<!--<th width="5%">ID</th>-->
              						<th width="38%">Book Title</th>
              						<th width="12%">Department</th>
              						<th width="15%">Status</th>
              						<th width="15%">Authors</th>
              						<th width="25%">Date</th>
            					</tr>
          					</thead>

            		<?php
            		echo "<tbody>";
              		while ($row = mysqli_fetch_array($result)){
                			echo '
                  				<tr>

                      				<td><a href="history.php?book_id=' . $row['book_id']. '">'.$row["book_title"].'</a></td>
                          			<td>'.$row["dept"].'</td>
                            		<td>'.$row["book_stat"].'</td>
                              		<td>'.$row["authors"].'</td>
                              		<td>'.$row["date"].'</td>
                             	</tr>
                  			';
              }


              echo "</tbody>";
              ?>

        </table>
        <br>
        <div id="line">

		</div>
		<br>
		<b id="rescount"></b><br>
		<b id="datepage">As of </b>
		<br><br>


		<script type="text/javascript">
				var table,  tr, td, i;
				table = document.getElementById("example");
				tr = table.getElementsByTagName("tr");

				$("#rescount").html("Total result: " + (tr.length - 1));
				$("#datepage").html("As of " + new Date())

		</script>
		<button id="print" >Print</button>


				</td>
			</tr>



	</table>
	<br>
	<br>
	<br>
	<br>

	<script type="text/javascript">

		$("#print").click(function(){
			$(this).hide();
			$("#filter-div").hide();
			window.print();

		});

		$("#btnFilter").click(function(){
			var title = $("#filter-title").val();
			var from = $("#filter-from").val();
			var to = $("#filter-to").val();
			var dept = $("#filter-dept").val();
			if(dept=="All"){
				dept = "";
			}
			var stat = $("#filter-stat").val();
			if(stat=="All"){
				stat = "";
			}
			var aut = $("#filter-aut").val();

			window.location.replace("book_reports.php?title=" + title + "&dept=" + dept + "&status=" + stat + "&author=" + aut + "&from=" + from + "&to=" + to);
		})

		$("#resetfilter").click(function(){
			/*var table,  tr, td, i;
				table = document.getElementById("example");
				tr = tr = table.getElementsByTagName("tr");
				for(i=0; i<tr.length; i++){
					tr[i].style.display ="";
				}

			$("#filter-to").val("2000");
			$("#filter-title").val("");
			$("#filter-from").val("2000");
			$("#filter-aut").val("");
			$("#filter-stat").val("All");
			$("#filter-dept").val("All");*/
			window.location.replace("book_reports.php?title=&dept=&status=&author=&from=0&to=5000");
		})

		$("#filter-aut").keyup(function(){
			var filter = $(this).val().toUpperCase();
 			if(filter!=""){
				var table,  tr, td, i;
				table = document.getElementById("example");
				tr = table.getElementsByTagName("tr");
				for (i = 0; i < tr.length; i++) {

    				td = tr[i].getElementsByTagName("td")[3];
     				if(tr[i].style.display==""){
	    				if (td) {
	      					if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	        					tr[i].style.display = "";
	     		 			} else {
	        					tr[i].style.display = "none";
	      					}
	    				}
    			}
  			}

			}else{
				var table,  tr, td, i;
				table = document.getElementById("example");
				tr = tr = table.getElementsByTagName("tr");
				for(i=0; i<tr.length; i++){
					tr[i].style.display ="";
				}
			}

			//alert(dept);
			updateResult();
		})


		function updateResult(){
			var table,  tr, td, i;
				table = document.getElementById("example");
				tr = table.getElementsByTagName("tr");
				var count = 0;
				for(i=0; i<tr.length; i++){
					if(tr[i].style.display ==""){
						count++;
					}
				}

				$("#rescount").html("Total result: " + (count-1));
		}

		window.onafterprint = function(){
  		 $("#filter-div").show();
  		 $("#print").show();
		}

	</script>


</div>
</body>
</html>
