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
    $cannotFindAuthor = 1;
?>

<!DOCTYPE html>
<html>
<head>
	<div class="se-pre-con"></div>

	<?php
	$a_id = null;
	$author = null;
		if(isset($_GET['aut_id'])){
			$a_id = $_GET['aut_id'];
			$query = 'SELECT CONCAT(`a_fname`, " ", SUBSTRING(`a_mname`, 1, 1), ". ", `a_lname`, " ", `a_suffix`) as name, `bib`,`a_add`,`a_contact`,`a_email` FROM `author` WHERE a_id='. $a_id;
			$result = $con->query($query);
			//print_r($result);
			if($result->num_rows>0){
				$author = $result->fetch_assoc();
				$cannotFindAuthor = 0;
			}else{
				$cannotFindAuthor = 1;
			}
		}
		
	?>
    <title>RRMS-<?php echo $author['name'] ?></title>
    <?php
    	include ($_SERVER["DOCUMENT_ROOT"] . '/rrms-buksu/includes/header.php');
    ?>
</head>
<body>
	<div class="container main-body-wrapler">
		<div class="row">
			<div class="col-md-9 col-sm-12">
				
			<?php
				if(isset($_GET['aut_id'])){
					
					if($cannotFindAuthor===0){
						echo '<div class="row" style="padding: 10px; margin-bottom: 3rem;">
					<div class="col-md-2 col-sm-12" id="author-cover-div">
						<img src="noprofile.png" id="cover-img">
					</div>
					<div class="col-md-10 col-sm-12">
						<div class="row">
									<h3>'. $author['name'] .'</h3>
								</div>
								<div class="row author-details">
									'. $author['a_contact'] .'
								</div>
								<div class="row author-details">
									'. $author['a_email'] .'
								</div>
								<div class="row author-details">
									'. $author['a_add'] .'
								</div>
					</div>			
				</div>';
							echo '
						<div class="container mobile-pad">
							<div class="row content-header">
								<h4>Bibliography</h4>
							</div>
							<div class="row">';
							if($author['bib']!==""){
								echo $author['bib'];
							}else{
								echo'No Bibliography Added.';
							}
							
							echo'</div>
							<div class="row content-header">
								<h4>Authored Research</h4>
							</div>
							<div class="row">
								<ul style="margin-top: 1rem;">
									'; 

										$query= "SELECT book.book_id, book.book_title, book.cover, book.link, book.aut_type, book.docloc, SUBSTRING(book.pub_date, 1, 4) as date, book.abstract, book.`keywords` FROM junc_authorbook
INNER JOIN book on book.book_id = junc_authorbook.book_id
WHERE book.enabled=1 AND junc_authorbook.aut_id = ? ORDER BY book.pub_date ASC ";
										
										$stmt = $con->prepare($query);
										$stmt->bind_param("i", $_GET['aut_id']);
										if($stmt->execute()){
											$result = $stmt->get_result();
											if($result->num_rows>0){
												while($row=$result->fetch_assoc()){
													echo '<li>
										<b style="color: #0066ff;"><a href="' . PROJECT_ROOT .  'research/'. $row['date'] ."/" . $row['aut_type'] . "/" . $row['link']. '">
								  		'. $row['book_title'] .'
								  	</a></b>
									</li>';
												}
											}
										}


										echo '
								</ul>
							</div>
							<div class="row content-header">
								<h4>Awards Received</h4>
							</div>
							<div class="row">
								<ul style="margin-top: 1rem;">
									<li>
										<b style="color: #0066ff;">Asian Award for Oral Research Presentation</b> during the Asian Conference Academic Journals and Higher Education Research at Cagayan De Oro City last August 17-20, 2011.
									</li>
								</ul>
							</div>
						</div>
					';
					}else{
						include ($_SERVER["DOCUMENT_ROOT"] . '/rrms-buksu/404.php');
					}
					
			}else{
				include ($_SERVER["DOCUMENT_ROOT"] . '/rrms-buksu/404.php');
			}
				

			?>
			</div>
			
			<!-- Modifiable
			<div class="col-md-9 col-sm-12">
				<div class="container">
					<div class="row">
						<h3>Klevie Jun R. Caseres</h3>
					</div>
					<div class="row author-details">
						09656744977
					</div>
					<div class="row author-details">
						klevly@04@gmail.com
					</div>
					<div class="row author-details">
						Malaybalay City Bukidnon
					</div>
					<div class="row content-header">
						<h4>Bibliography</h4>
					</div>
					<div class="row">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
					</div>
					<div class="row content-header">
						<h4>Authored Research</h4>
					</div>
					<div class="row">
						<ul style="margin-top: 1rem;">
							<li>
								<a href="#"><b style="color: #0066ff;">Asian Award for Oral Research Presentation</b></a>
							</li>
						</ul>
					</div>
					<div class="row content-header">
						<h4>Awards Received</h4>
					</div>
					<div class="row">
						<ul style="margin-top: 1rem;">
							<li>
								<b style="color: #0066ff;">Asian Award for Oral Research Presentation</b> during the Asian Conference Academic Journals and Higher Education Research at Cagayan De Oro City last August 17-20, 2011.
							</li>
						</ul>
					</div>
				</div>
			</div>

		end of Modifiable-->
			<div class="col-md-3" id="related-study">
                <?php include(PROJECT_ROOT_NOT_LINK . "recent-post.php") ?>
          		<?php include(PROJECT_ROOT_NOT_LINK . "archive.php") ?>
            </div>
                <!-- end of Widget-->
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