<div class="container">
 	<?php
		
		include 'includes/connection.php';
		$book_id;
		$dbconfig= new dbconfig();
		$con= $dbconfig -> getCon();
		if(isset($_GET['filter'])){
			$filter = $_GET['filter'];
			if($filter==="student"){
				$query= "SELECT book.book_id, book.book_title, book.cover, book.docloc, SUBSTRING(book.pub_date, 1, 4) as date, book.abstract FROM groupdoc INNER JOIN book on groupdoc.book_id = book.book_id INNER JOIN account ON account.id = groupdoc.accid WHERE book.enabled=1 and account.type = 'STUDENT' ORDER BY book.pub_date ASC limit 20";
				$result = $con -> query($query);
				if ($result->num_rows>0) {
					while ($row = $result->fetch_assoc()) {
						$book_id = $row['book_id'];
						echo '<div class="row entry">
							<div class="row">
				  				<div class="col-md-2" id="cover-div">
				  				<a href=research/?book_id='. $row['book_id'] .'>
				  					<img src="' . $row['cover'] . '" id="cover-img">
				  					</a>
				  				</div>
				  				<div class="col-md-10" id="details">
				  					<div class="row">
				  						<a href="research/?book_id='. $row['book_id'] .'">
				  							<h4 class="tittle">'. $row['book_title'] .'</h4>
				  						</a>
				  					</div>
				  					<div class="row">
				  						By: &nbsp';
				  						$query= 'SELECT author.`a_id`, CONCAT(author.`a_fname`, " ", SUBSTRING(author.`a_mname`, 1, 1), ". " , author.`a_lname`, " ", author.`a_suffix`) AS name FROM junc_authorbook INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id = ' . $book_id;
				  						$resultAut = $con -> query($query);
				  						while ($author = $resultAut->fetch_assoc()) {
				  							echo '<a href="author/?aut_id='. $author['a_id'] .'" class="author">' . $author['name']. '</a>, &nbsp';
				  						}
				  						echo '
				  						&nbsp; - '. $row['date'] .'
				  					</div>
				  					<div class="row">
				  						<div class="text abstract">
				  							'. $row['abstract'] .'
				  						</div>
				  					</div>
				  					<div class="row keywords">
				  						Key words: &nbsp;<i style="color:#3366ff">'; 
				  						$query= 'SELECT keywords.key_words FROM `junc_bookkeywords` INNER JOIN keywords on keywords.id = junc_bookkeywords.keywords_id WHERE junc_bookkeywords.book_id = ' . $book_id;
				  						$resulKw = $con -> query($query);
				  						if($resulKw->num_rows>0){
				  							while($kw = $resulKw->fetch_assoc()){
				  								echo $kw['key_words'] . ", "; 
				  							}
				  						}
				  						
				  						echo'</i>
				  					</div>
				  				</div>
							</div>
						</div>';
					}
					
				}else{
					echo '<h2 style="color: red">No research available.</h2>';
				}
			}
		}
	?>
 </div>