<div id="bs4-slide-carousel" class="carousel slide row px-3" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php
					$p_count = 0;
					for ($i=0; $i < $res->num_rows; $i++) { 
						if($p_count==$i){
							echo '<li data-target="#bs4-slide-carousel" data-slide-to="'. $i .'" class="active"></li>';
						}else{
							echo '<li data-target="#bs4-slide-carousel" data-slide-to="'. $i .'"></li>';
						}
					}

				?>
		    	
		    	
		  	</ol>
		  <div class="carousel-inner" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.6); ">

		  	<!--FIRST ITEM -->
		  	<?php
		  		$p_count = 0;
		  		while ($p_row=$res->fetch_assoc()) {
		  			if($p_count==0){
					  				echo '<div class="carousel-item active">
					  		 <img class="d-inline w-100" src="'. PROJECT_ROOT .  $p_row['cover'] .'" alt="Slide One" id="cousel-img">
					  		 <div class="carousel-caption" id="carousel-caption">
					  		 	<h5 class="text-primary">'. $p_row['post_tittle'] .'</h5>
					  		 	<div class="text carousel-text">
					  		 	'. strip_tags($p_row['post_body']) .' 
					  		 	</div>
					  		 	<a href="'. PROJECT_ROOT . "post/?post_id=" . $p_row['id'] .'"><b>View Here</b></a>
					  		 </div>
					  	</div>';
					  	$p_count++;
		  			}else{
		  					echo '<div class="carousel-item">
 				<img class="d-inline w-100" src="'. PROJECT_ROOT .  $p_row['cover'] .'" alt="Slide Two" id="cousel-img">
 
      			<!--Captions for the slides go here -->
      			<div class="carousel-caption" id="carousel-caption">
 					<h5 class="text-primary">'. $p_row['post_tittle'] .'</h5>
        			<div class="text carousel-text">
		  		 		'. strip_tags($p_row['post_body']) .' 
		  		 	</div>
		  		 	<a href="'. PROJECT_ROOT . "post/?post_id=" . $p_row['id'] .'"><b>View Here</b></a>
        		</div>
 
      <!--Captions ending here for slide 2-->       
       		</div>';
		  			}
		  		}

		  	?>
		  	<!--<div class="carousel-item active">
		  		 <img class="d-inline w-100" src="post/pics/web-development.jpg" alt="Slide One" id="cousel-img">
		  		 <div class="carousel-caption" id="carousel-caption">
		  		 	<h5>The demo of using text in carousel Bootstrap</h5>
		  		 	<div class="text carousel-text">
		  		 		Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here Another caption line goes here 
		  		 	</div>
		  		 	<a href=""><b>View Here</b></a>
		  		 </div>
		  	</div>-->

		  	<!--SECOND ITEM -->
		  	<!--<div class="carousel-item">
 				<img class="d-inline w-100" src="post/pics/Disney-Princess.jpg" alt="Slide Two" id="cousel-img">
 
      			Captions for the slides go here
      			<div class="carousel-caption" id="carousel-caption">
 					<h5>The demo of using text in carousel Bootstrap</h5>
        			<div class="text carousel-text">
		  		 		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
		  		 	</div>
		  		 	<a href=""><b>View Here</b></a>
        		</div>-->
 
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