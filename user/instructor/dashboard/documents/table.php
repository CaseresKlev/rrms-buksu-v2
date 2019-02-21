                      <?php 

                      foreach ($bookList as $key) {
                        //echo $key;
                        $query = "SELECT documents.id, documents.book_id, documents.documents, documents.orig_name, documents.submitted_by, documents.description, documents.date, book.book_title FROM documents inner JOIN book on book.book_id = documents.book_id where documents.book_id = " . $key;
                        //echo $query;
                        $result = $con->query($query);
                        if($result->num_rows>0){
                          while ($res = $result->fetch_assoc()) {
                            echo '<tr>
                        <td>
                          <a href="' . PROJECT_ROOT . $res['documents'] . '" class="text-info" target="_blank">'. $res['orig_name'] .'</a>
                        </td>
                        <td>
                          ' . $res['submitted_by'] . '
                        </td>
                        <td>
                          '. $res['description'] .'. For the paper: ' . $res['book_title'] . '
                        </td>
                        <td>';
                          $date = new DateTime($res['date']);
                          echo $date->format('F jS, Y');
                        echo'</td>
                      </tr>';
                          }
                        }
                      }
                      //
                      //print_r($bookList);
                      //echo $query;
                      //echo $param;
                      /*$stmt = $con->prepare("");
                      $stmt->bind_param("i", $key);
                      print_r($stmt);*/


                      ?>

                      

                      