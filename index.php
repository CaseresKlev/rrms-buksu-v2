<!DOCTYPE html>
<html>
<head>
	<title>RRMS-BUKSU</title>
    <?php
    	include 'includes/header.php';
    	include 'includes/connection.php';
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
		<div id="bs4-slide-carousel" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
		    	<li data-target="#bs4-slide-carousel" data-slide-to="0" class="active"></li>
		    	<li data-target="#bs4-slide-carousel" data-slide-to="1"></li>
		  </ol>
		  <div class="carousel-inner" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.6); ">

		  	<!--FIRST ITEM -->
		  	<div class="carousel-item active">
		  		 <img class="d-inline w-100" src="post/pics/web-development.jpg" alt="Slide One" id="cousel-img">
		  		 <div class="carousel-caption" id="carousel-caption">
		  		 	<h5>The demo of using text in carousel Bootstrap</h5>
		  		 	<div class="text carousel-text">
		  		 		Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here 
		  		 	</div>
		  		 	<a href=""><b>View Here</b></a>
		  		 </div>
		  	</div>

		  	<!--SECOND ITEM -->
		  	<div class="carousel-item">
 				<img class="d-inline w-100" src="post/pics/Disney-Princess.jpg" alt="Slide Two" id="cousel-img">
 
      			<!--Captions for the slides go here -->
      			<div class="carousel-caption" id="carousel-caption">
 					<h5>The demo of using text in carousel Bootstrap</h5>
        			<div class="text carousel-text">
		  		 		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
		  		 	</div>
		  		 	<a href=""><b>View Here</b></a>
        		</div>
 
      <!--Captions ending here for slide 2-->       
       		</div>


		  </div>
		  <a class="carousel-control-prev" href="#bs4-slide-carousel" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#bs4-slide-carousel" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a> 
		</div>

		<div class="container main-body-wrapler">
		 	<div class="row">
		 		<div class="col-md-8 col-sm-12">
		 			<?php
		              		$dbconfig= new dbconfig();
							$con= $dbconfig -> getCon();
							$query = "SELECT `id`, `post_tittle`, `post_body`, `post_date`, `post_user`, `location` FROM `post` ORDER BY `post_date` DESC LIMIT 5";
							$result = $con->query($query);
							if($result->num_rows>0){
								while ($row = $result->fetch_assoc()) {
									echo '<div class="row post-post">
		 				<div class="col-md-12 post-tittle-wrapler">
		 					<a href="'. PROJECT_ROOT .  $row['location'] . '?post_id='. $row['id'] .'"><h4 id="post-tittle">'. $row['post_tittle'] .'</h4></a>
		 				</div>
		 				<div class="col-md-12 post-date-wrapler">
		 					<p id="post-date">Posted by <i class="fas fa-user"></i> '. $row['post_user'] .' <i class="fas fa-clock"></i> '; 
		 					$date = $row['post_date'];
		 					$sdate=date_create($date);
							echo date_format($sdate,'F d, Y \a\t h:i A');
		 					echo '</p>
		 				</div>
		 				
		 				
		 				<div class="text" id="post-details">'. $row['post_body'] .'</div>
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
								Key words: &nbsp; <i style="color:#3366ff">'

										. $row['keywords'] .'</i>
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
									echo '<a href="'. PROJECT_ROOT . $row['location'] . '?post_id=' . $row['id'] . '" class="list-group-item">'. $row['post_tittle'] .'</a>';
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


	</div><!--end of content-->

	
 





	
	
	
	
	<?php
		include 'includes/footer.php';
	?>

	<div class="d-none notif-message">
      Find out&nbsp;<a class="badge badge-info" href="#" onclick="showDetailedNotification('bottom','right')">Here</a> &nbsp;or click the "Notification" in your dashboard.<br><br>I got it <span class="badge badge-danger donotshow" onclick="doNotShow()">Do not show next time</span>
    </div>
    

    <script src="<?php echo PROJECT_ROOT . "js/dashboard.js" ?>"></script>
    <?php 

    	$stmt = $con->prepare('SELECT `id`, `action`, on_update_author.`book_id`, book.book_title, CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1,1), ". ", author.a_lname, " ", author.a_suffix ) as referer FROM `on_update_author` INNER JOIN book on book.book_id = on_update_author.book_id INNER JOIN author on author.a_id = referer WHERE `author` = ?');
        $stmt->bind_param("i", $_SESSION['owner']);
        $stmt->execute();
        $resultCount = $stmt->get_result();
        //$notif = $resultCount->fetch_assoc();

        $query = "SELECT * FROM `notification` where author_id = " . $_SESSION['owner'];
       // echo $query;
        $result = $con->query($query);
        $notifShowRow = $result->fetch_assoc();
        $showNotif = false;
        if($notifShowRow['isShow']==1){
            $showNotif = true;
        }
        if($resultCount->num_rows>0 && $showNotif){
          echo '<script>

          $(document).ready(function(){
        setTimeout(function() { 
          showNotification("bottom", "right");
          
          //alert(message);

          
          //showNotification();

          });
        }, 5000); 


          </script>';
        }


       ?>
			<div id="sound"></div>
			<div class="modal fade" id="modalNotification" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" style="max-width: 720px;">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="modal-fileUpload-title">Author Request:</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body m-2">
                        <div class="container" style="font-size: 11pt;">
                            <?php 

                                if($resultCount->num_rows>0){
                                    while ($notif = $resultCount->fetch_assoc()) {
                                        $action = $notif['action'];
                                        $classType = "";
                                        if($notif['action']==="added"){
                                            $classType = "border-success";
                                        }else if($notif['action']==="remove"){
                                            $classType = "border-danger";
                                        }

                                        echo '<div class="row working-entry border-left ' . $classType . ' pl-4" style="border-width: 6px !important;">
                                <div class="col-*-12">
                                    <a href="#"><strong>'. $notif['referer'] .'</strong></a>&nbsp;<em class="bg-info text-white">'. $action .'</em> you as an Author to the research titled <em><strong>Buksu Research Record Management System</strong></em>
                                </div>
                                <div class="col-*-12 pt-1 pb-1">
                                    <button type="button" class="btn btn-outline-success btn-sm btn-confim" onclick=\'working(this, ".btn-cancel","confirm", "#spin", ".working", "server_script/author_request.php", "&param='. $notif['id'] .'&book_id='. $notif['book_id'] .'", ".working-entry")\'>Confirm</button>
                                    <button class="btn btn-outline-danger btn-sm btn-cancel" onclick=\'working(this, ".btn-confim","cancel", "#spin", ".working", "server_script/author_request.php", "&param='. $notif['id'] .'&book_id='. $notif['book_id'] .'", ".working-entry")\'>Cancel</button>
                                    <div class="text working pt-2" style="display: none"><img src="" id="spin" style="max-width: 20px; max-height: 20px;"> Working on it...</div>
                                </div>
                            </div>';
                                    }
                                }else{
                                    echo "No Author Request";
                                }

                            ?>
                            

                        </div>
                        
                    </div>
                      
                    

                  </div>

                </div>
            </div>
</body>
</html>