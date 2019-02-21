<!DOCTYPE html>
<html>
<head>
	<title>RRMS-BUKSU</title>
    <?php
    	include 'includes/header.php';
    	include 'includes/connection.php';

    	$dbconfig= new dbconfig();
		$con= $dbconfig -> getCon();
    ?>

    

</head>

<body>
	<!-- Paste this code after body tag -->
	<div class="se-pre-con"></div>
	<!-- Ends -->
	
<!--	<div class="content">
	<div class="back-to-article"><p><a href="smallenvelop.com/blog/"><< Back to the article !!</a></p></div>
	<img src="http://smallenvelop.com/wp-content/uploads/2014/08/simple-pre-loader.jpg
" style="visibility: hidden; width:100%; height: auto;">
	</div>
	<style>
		.content {
			background: url(http://smallenvelop.com/wp-content/uploads/2014/08/simple-pre-loader.jpg
) center no-repeat;
			background-size: 100%;
			width: 100%;
		}
	</style>-->
	<div class="container content">
		<!--Start of CARROUSEL -->
		<?php 


			$stmt = $con->prepare("SELECT * FROM `post` WHERE `feautured` = 1 order by `post_date` DESC limit 7");
			if($stmt->execute()){
				$res = $stmt->get_result();
				if($res->num_rows>0){
					include 'carrousel.php';
				}
			}


			
		?>

		<!--END OF CAROUSEL-->
		<div class="container content">
		<div class="container main-body-wrapler">
		 	<div class="row">
		 		<div class="col-md-8 col-sm-12">
		 			<?php
		              		
							$query = "SELECT `id`, `post_tittle`, `post_body`, `post_date`, `post_user`, `location`, `views_count` FROM `post` ORDER BY `post_date` DESC LIMIT 5";
							$result = $con->query($query);
							if($result->num_rows>0){
								while ($row = $result->fetch_assoc()) {
									echo '<div class="row post-post">
		 				<div class="col-md-12">
		 					<div class="row">
		 					<a href="'. PROJECT_ROOT .  $row['location'] . '?post_id='. $row['id'] .'"><h5 id="post-tittle">'. $row['post_tittle'] .'</h5></a>
		 					</div>
		 				</div>
		 				<div class="col-md-12">
		 					<div class="row">
		 					<p id="post-date" style="font-size: 10pt;">Posted by <i class="fas fa-user"></i> '. $row['post_user'] .' <i class="fas fa-clock"></i> '; 
		 					$date = $row['post_date'];
		 					$sdate=date_create($date);
							echo date_format($sdate,'F d, Y \a\t h:i A');
		 					echo '&nbsp;<span class="badge badge-dark text-white"><i class="fas fa-eye"></i> &nbsp;'. $row['views_count'] .'</span></p>
		 					</div>
		 				</div>
		 				
		 				
		 				<div class="text" id="post-details">'. strip_tags($row['post_body']) .'</div>
		 			</div>';
								}
							}
		              	?>
		 			<!--<div class="row post-post">
		 				<div class="col-md-12 post-tittle-wrapler">
		 					<a href=""><h4 id="post-tittle">This is the post Tittle This is the post Tittle</h4></a>
		 				</div>
		 				<div class="col-md-12 post-date-wrapler">
		 					<p id="post-date">Posted by <i class="fas fa-user"></i> Admin <i class="fas fa-clock"></i> January 6, 2018</p>
		 				</div>
		 				
		 				
		 				<div class="text" id="post-details">Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here</div>
		 			</div>-->
		 			


		 			<!--featured-->
		 			<div class="row" style="border-bottom: 1px solid gray; padding-top: 30px;">
		 				<h3>Featured Study</h3>
		 			</div>
		 			<?php
		 				
						$book_id;
						$dbconfig= new dbconfig();
						$con= $dbconfig -> getCon();
							//$filter = $_GET['filter'];
								$query= "SELECT book.book_id, book.book_title, book.cover, book.link, book.aut_type, book.docloc, SUBSTRING(book.pub_date, 1, 4) as date, book.abstract, `keywords` FROM book WHERE book.enabled=1 ORDER BY book.pub_date ASC limit 20";
								$result = $con -> query($query);
								if ($result->num_rows>0) {
									while ($row = $result->fetch_assoc()) {
										$book_id = $row['book_id'];

										echo '<div class="row entry">
							<div class="col-md-2 col-sm-4" id="cover-div">
								<a href=' . PROJECT_ROOT . 'research/'. $row['date'] ."/" . $row['aut_type'] . "/" . $row['link']. '>
								  	<img src="';

								  	if($row['cover']===""){
								  		echo PROJECT_ROOT . "default/cover/df-cover.png";
								  	}else{
								  		echo $row['cover'];
								  	}

								  	echo '" id="cover-img">
								</a>
							</div>
							<div class="col-md-10" id="details">
								<div class="row">
								  	<a href=research/'. $row['date'] ."/" . $row['aut_type'] . "/" . $row['link']. '>
								  		<h5 class="tittle">'. $row['book_title'] .'</h5>
								  	</a>
								</div>
								<div class="row">
								  	By: &nbsp';

								  	$query= 'SELECT author.`a_id`, CONCAT(author.`a_fname`, " ", SUBSTRING(author.`a_mname`, 1, 1), ". " , author.`a_lname`, " ", author.`a_suffix`) AS name FROM junc_authorbook INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id = ' . $book_id;
								  						$resultAut = $con -> query($query);
								  						while ($author = $resultAut->fetch_assoc()) {
								  							echo '<a href="author/?aut_id='. $author['a_id'] .'" class="author">' . $author['name']. '</a>, &nbsp';
								  						}
								  		echo '&nbsp; -' .  $row['date'] . '</div>
								<div class="row">
								  	<div class="text abstract">
								  	' . $row['abstract'] . 
								  	'</div>
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
					</div>
					<div class="row entry">
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
					</div>
					<div class="row entry">
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
					</div>
					<div class="row entry">
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
					</div>
					<div class="row entry">
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
			
					
		 		</div>

		 		<!--related study-->
		 		<div class="col-md-4" id="related-study">
		             <?php include(PROJECT_ROOT_NOT_LINK . "recent-post.php") ?>
          			<?php include(PROJECT_ROOT_NOT_LINK . "archive.php") ?>
		 		</div>
		 	</div>
		 </div>
		</div>
		 <div class="modal fade " id="modalEditText" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header" style="padding: 10px">

                          <h4 class="modal-title " id="modal-title-pub">Welcome</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                          <div class="modal-body">
                          	<div class="row">
                          		<div class="col-md-2">
	                          		<img src="img/welcome.gif" width="50" height="50">
	                          	</div>
	                          	<div class="col-md-10">
	                          		<h4>We are glad your here 
	                          			<?php if(isset($_GET['to'])){
	                          				echo $_GET['to'];
	                          			} ?>
	                          				
	                          			</h4>
	                          	</div>
                          	</div>
                          	<div class="alert alert-info mt-5">
                          		You can now submit your research. Just visit your dashboard.
                          	</div>
                          	
                              
                          </div>
                        
                      </div>

                    </div>
                  </div>

	</div><!--end of content-->

	
 





	
	
	
	
	<?php
		include 'includes/footer.php';
	?>

	<div class="d-none notif-message">
      Find out&nbsp;<a class="badge badge-info" href="#" onclick="showDetailedNotification('bottom','right')">Here</a> &nbsp;or click the "Notification" in your dashboard.<br><br>I got it <span class="badge badge-danger donotshow" onclick="doNotShow()">Do not show next time</span>
    </div>
    

    <script src="<?php echo PROJECT_ROOT . "js/dashboard.js" ?>"></script>
    <?php 

    if(isset($_SESSION['uid'])){
    	include 'notification.php';
    }


    ?>
    <script type="text/javascript">
    	jQuery.fn.stripTags = function() {
		    return this.replaceWith( this.html().replace(/<\/?[^>]+>/gi, '') );
		};


    	<?php 

    		if(isset($_GET['to']) && isset($_SESSION['uid'])){
    			echo "$( document ).ready(function() {
		    $('#modalEditText').modal('toggle');
		});";
    		}

    	?>

    	$('.post-post').each(function(){

		 if($(this).find('img').length > 0)
		 {
		  var img = $(this).find('img');
		  //$(this).css('background-color','yellow');
		    //$(this).css('background-image','url(' + imgSrc + ')');
		    //$(this).hide();
		  $(img).hide();
		 }
		});

    	$('.carousel-text').each(function(){

		 if($(this).find('img').length > 0)
		 {
		  var img = $(this).find('img');
		  //$(this).css('background-color','yellow');
		    //$(this).css('background-image','url(' + imgSrc + ')');
		    //$(this).hide();
		  $(img).hide();
		 }

		 //$(this).stripTags();
		});


		
    	
    </script>
</body>
</html>