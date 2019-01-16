            

<div class="container rounded mt-5 shadow">
                <div class=" container bg-dark text-white ml-0">
                  <h4>Summary of Comments and Suggestion</h4>
                </div>
                <div class="row ml-1 mt-3 ml-auto">
                  <h5>Originator: <?php echo $origin; ?></h5>
                </div>
                <div class="row ml-1 mt-2 mr-1">
                  <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                      <tr>
                        <th scope="col">Parts of Manuscript</th>
                        <th scope="col">Comments / Suggestion</th>
                        <th scope="col">Page</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tbody>
                      <?php
                      $dbconfig= new dbconfig();
                      $con= $dbconfig -> getCon();
                      $query= "SELECT * FROM `comments` WHERE `trail_id` = " . $_GET['trail'];
                      $result = $con -> query($query);
                      if($result->num_rows>0){
                        while ($rowCom = $result->fetch_assoc()) {

                          echo '<tr><td scope="col">'. $rowCom['parts'] .'</td>
                      <td scope="col">'. $rowCom['comments'] .'
                      </td>
                      <td scope="col"> <input class="form-control input-md" id="pageno-'. $rowCom['id'] .'" type="text" style="font-weight: bold; pattern="[0-9-]{3}" name="'. $rowCom['id'] .'"readonly value="'. $rowCom['page'] .'"></td>
                      <td scope="col"><button class="btn btn-danger btn-md" id="page-edit[]" name="'. $rowCom['id'] .'">Edit</button></td></tr>';
                        }
                      }else{
                        echo '                      <tr>
                        <td scope="col" colspan="4"><center>No Comments yet.</center></td>
                        </tr>
                    ';
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
                <div class="row ml-1 mt-2 mr-1">
                  <a href="comment_reports.php?paper_trail=<?php echo $trail_id  ?>" target="_blank" class="ml-auto">
                    <button class="btn btn-success mb-3">Print Comments</button>
                  </a>
                </div>
           </div>