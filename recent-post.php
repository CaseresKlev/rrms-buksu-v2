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
                        echo '<a href="'. $rootPath . $row['location'] . '?post_id=' . $row['id'] . '" class="list-group-item">'. $row['post_tittle'] .'</a>';
                    }
                    echo '<a href="'. $rootPath . $row['location'] . 'post/all.php'. '" class="list-group-item">>> View All <<</a>';
                }
            ?>

          </div>