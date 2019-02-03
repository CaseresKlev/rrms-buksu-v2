<div class="row d-flex justify-content-center">
  
              <nav aria-label="...">
                <ul class="pagination">
                  <li class="page-item <?php if($curBlock - 1 <= 0) echo('disabled');?>">
                    <a class="page-link" href="<?php echo '?page=' . ($min - 1) ?>" tabindex="-1">Previous</a>
                  </li>
                  <?php
                    
                    for($i = $min; $i<=$max; $i++){

                        if($i <= $numPages){
                          $link = "";
                          if($i==$page){
                            echo '<li class="page-item active"><a class="page-link" href="?page='. ($i) .'">'. ($i) .'</a></li>';
                          }else{
                            echo '<li class="page-item"><a class="page-link" href="?page='. ($i) .'">'. ($i) .'</a></li>';
                          }
                        }
                    }
                    

                    
                    
                  ?>
                  
                  <!--<li class="page-item active">
                    <a class="page-link" href="?page=2">2 <span class="sr-only">(current)</span></a>
                  </li>-->
                  <li class="page-item <?php if($curBlock == $block) echo('disabled')?>">
                    <a class="page-link" href="<?php echo '?page=' . ($max + 1); ?>">Next</a>
                  </li>
                </ul>
              </nav>
            </div>