            


<div class="container rounded mt-5 shadow">
                <div class=" container bg-dark text-white ml-0">
                  <h4>Publication</h4>
                </div>
                <div class="row ml-1 mt-2 mr-1">
                  <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                      <tr>
                        <th scope="col">ISSN</th>
                        <th scope="col">Journal</th>
                        <th scope="col">Journal Type</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tbody>
                      <?php
                      if($result->num_rows>0){
                        while($rowpub =$result->fetch_assoc()){
                        echo '<tr>
                              <td scope="col">'. $rowpub['issn'] .'</td>
                              <td scope="col">'. $rowpub['journal'] .'</td>
                              <td scope="col">'. $rowpub['type'] .'</td>
                              <td scope="col">'. $rowpub['date'] .'</td>
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