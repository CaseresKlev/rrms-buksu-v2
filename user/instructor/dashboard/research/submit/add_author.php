

<div class="container data-group">
                    <div class="row bg-secondary text-white data-head">
                      Author(s):
                      <div  class="badge badge-warning ml-auto" id="btn-edit-author" style="margin: auto; margin-right: 10px;"><i class="fas fa-pencil-alt"></i> Edit</div>
                    </div>
                    <div class="row data-content">
                      <div class="row onViewAuthor">
                        <ul>
                          <?php
              
                            $stmt = $con->prepare('SELECT author.a_id, author.a_fname, CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1, 1), ". ", author.a_lname, " " , author.a_suffix) as name FROM `junc_authorbook` INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE book_id = ?');
                            $stmt->bind_param("i", $_GET['b']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row=$result->fetch_assoc()) {
                              echo '<li>'.$row['name'] .'</li>';
                            }
                          ?>


                          
                        </ul>
                         
                        <?php
                          $isremoved = $con->query('SELECT id, referer as referer_id, CONCAT(a1.a_fname, " ", SUBSTRING(a1.a_mname,1,1), ". ", a1.a_lname) as name, `action`, CONCAT(a2.a_fname, " ", SUBSTRING(a2.a_mname,1,1), ". ", a2.a_lname) as referer, `date` FROM `on_update_author` JOIN author a1 on a1.a_id = `author` JOIN author a2 on a2.a_id = `referer` WHERE book_id = '. $_GET['b'] .' ORDER BY date DESC');
                              $isAction = "";
                              $by = "";
                              if($isremoved->num_rows>0){
                                echo '<div class="note" style="margin-left: 10px;"> <b class="badge-danger" style="padding: 0px  5px 0px 5px;">Pending:</b>
                        <ul class="text-secondary">';
                                while ($isRemoveRow=$isremoved->fetch_assoc()) {
                                  $date = new DateTime($isRemoveRow['date']);
                                  echo '<li><b>'. $isRemoveRow['name'] .'</b> was <b>'. $isRemoveRow['action'] .'</b> as Author to this research by '. $isRemoveRow['referer'] .' last '. $date->format('F jS, Y');
                                  
                                  if($isRemoveRow['referer_id']==$_SESSION['owner']){
                                    echo '<a href="#" id="link-remove-author" onclick="removeRequest('. $isRemoveRow['id'].')"><br>Cancel Request</a>';
                                  }

                                   echo '</li>';
                                }
                                echo '</ul>
                        </div>';
                              }

                        ?>
                       
                          
                            
                          
                        
                      </div>
                      <div class="container onEditAuthor">
                        <div class="row">
                          <?php 
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while($row=$result->fetch_assoc()){
                              if($_SESSION['owner']!==$row['a_id']){
                                 echo '<div class="input-group mb-3">
                                      <input type="text" class="form-control onEdit" aria-label="Recipient\'s username" aria-describedby="basic-addon2" value="'. $row['name'] .'" id="author-5" readonly>
                                      <div class="input-group-append">
                                        <div class="btn btn-outline-danger" type="button" onclick="removeAuthor('. $row['a_id'].', \''. $row['name'].'\')"><i class="fas fa-trash-alt"></i></div>
                                      </div>
                                    </div>';
                              }
                             
                            }


                          ?>
                          
                          <div class="input-group mb-3">
                            <input type="text" class="form-control onEdit txt-searchAuthor"  placeholder="Search Author to Add" aria-label="Recipient's username" aria-describedby="basic-addon2" >
                            <div class="input-group-append">
                              <div class="btn btn-outline-success" id="btnSearchAuthor" type="button"><i class="fas fa-search"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>