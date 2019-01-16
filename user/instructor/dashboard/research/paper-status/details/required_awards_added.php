            


<div class="container rounded mt-5 shadow">
                <div class=" container bg-dark text-white ml-0">
                  <h4>Awards</h4>
                </div>
                <div class="row ml-1 mt-2 mr-1">
                  <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                      <tr>
                        <th scope="col">Awards</th>
                        <th scope="col">Giving Parties</th>
                        <th scope="col">Location</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tbody>
                      <?php
                      if($result->num_rows>0){
                        while ($rowdis= $result->fetch_assoc()) {
                            echo '   
                              <td scope="col">'. $rowdis['awards'] .'</td>
                              <td scope="col">'. $rowdis['parties'] .'</td>
                              <td scope="col">'. $rowdis['location'] .'</td>
                              <td scope="col">'. $rowdis['description'] .'</td>
                              <td scope="col">'. $rowdis['date'] .'</td>
                            </tr>';
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
           </div>