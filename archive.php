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
                        echo '<a href="'. PROJECT_ROOT . "research/archived.php?year=2019" .'" class="list-group-item">'. $row['archive'] .'</a>';
                    }
                    if($result->num_rows>1){
                        echo '<a href="'. $rootPath .'research/all-year/" class="list-group-item">>> View all Year</a>';
                    }
                }else{
                    echo '<a href="#" class="list-group-item">No archive found</a>';
                }
            ?>
          </div>