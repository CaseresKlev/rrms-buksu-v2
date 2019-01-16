			<div class="container rounded mt-5 shadow" >
                <div class=" container bg-dark text-white ml-0">
                  <h4><?php echo $paper_stat; ?></h4>
                </div>
                <div class="row ml-1">
                  <h5>Submitted Paper:</h5>
                </div>
                <div class="row ml-1">
                	<a href="<?php echo($fileLoc) ?>">
	                  <h6 class="text-danger font-weight-bold">
	                  	<?php 

	                    $fname = explode("/", $fileLoc);
	                    echo end($fname);

	                   ?>
	                   	
	                   </h6>
                   	</a>
                </div>
                <div class="row ml-1 mt-4">
                  <h6>
                    <button class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#modaladdnew">Change Submitted Paper</button>
                  </h6>
                </div>
           </div>