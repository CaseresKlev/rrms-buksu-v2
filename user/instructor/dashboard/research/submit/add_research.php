<form action="validate/" enctype="multipart/form-data" method="POST" id="form-add">
              <input type="number" name="bookID" class="d-none" value="<?php echo $bookDet['book_id'] ?>" readonly>
              <input type="number" name="trailID" class="d-none" value="<?php echo $_GET['trail'] ?>" readonly>
              
              <div class="content shadow p-3">
                <div class="form-group data-head bg-dark text-white mb-3">
                Research Details
              </div>
                <div class="form-group" style="margin-bottom: 60px">
                  <div class="row">
                    <div class="col-md-5 col-sm-12">
                      <label for="file">File: <em class="note text-danger" >*Required pdf format (Max file size: 40MB)</em></label>
                      <br>
                      <input type="file" id="file" name="file" class="form-control-file" required>
                    </div> 
                    <div class="col-md-5 col-sm-12 st-5">
                      <label for="cover">Cover: <em class="note text-info">*jpg/jpeg/png Optional (Maximum size: 2MB)</em> </label>
                      <br>
                      <input type="file" class="form-control-file" id="cover" name="cover" accept="image/*" data-buttonText="Your label here.">
                    </div> 
                  </div>
                </div>    
              <div class="form-group">
                <label for="textArea-title">Title: <em class="note text-danger">*Required</em></label>
                  <textarea id="textArea-title" class="form-control" name="title" placeholder="Title" required readonly><?php echo $bookDet['book_title']; ?></textarea>
              </div>
              <div class="form-group">
                <label for="textArea-abstract">Abstract: <em class="note text-danger">*Required</em></label>
                  <textarea id="textArea-abstarct" class="form-control" name="abstract" rows="10" placeholder="Abstract" required><?php echo $bookDet['abstract']; ?></textarea>
              </div>
              <!--<div class="form-group">
                <?php  ?>
                <label for="select-Department">Department: <em class="note text-danger">*Required</em></label>
                <select class="form-control" id="select-Department" name="department">
                  <?php 

                    $query = 'SELECT id, CONCAT(`college`, " - ", `cat_name`) as name FROM `department` WHERE `id` = ? ORDER BY college';
                    $stmt = $con->prepare($query);
                    $stmt->bind_param("i", $bookDet['department']);
                    $stmt->execute();
                    //echo $query;
                    $dept = $stmt->get_result();
                    //echo $result->num_rows;
                    if($dept->num_rows>0){
                      while ($row = $dept->fetch_assoc()) {
                      
                      echo '<option value="'. $row['id'] .'">'. $row['name'] .'</option>';
                      }
                    }

                   ?>
                  
                </select>
              </div>-->
              <div class="form-group">
                <label for="textarea-keywords">Keywords: <em class="note text-danger">*Required</em></label>
                <textarea id="textarea-keywords" name="keywords" class="form-control" placeholder="keywords" required><?php echo $bookDet['keywords'] ?></textarea>
              </div>
              <div class="form-group">
                <label for="references">References: <em class="note text-danger">*Required (Separate with [new line per entry])</em></label>
                <textarea class="form-control" name="references" required rows="15" placeholder="Ex:

Bigirimana S., Jagero N., & Chizema P., (2015). An Assessment of the Effectiveness of Electronic Records Management. Retrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools

Bongor et al., (2009). Cognitive Computing: Where Big Data Is Driving Us. Retrieved from
https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools
"><?php echo $bookDet['refrences']; ?></textarea>
              </div>
              <!--<div class="form-group">
                  <label for="status">Research Status: <em class="note text-danger">*Please select aleast one (1) required status.</em> </label>
                  <div class="form-row">
                    <div class="col-md-6 col-sm-12">
                      <fieldset class="border p-2 border-danger">
                        <legend class="w-auto h6">Required Status:</legend>
                        <div class="form-group">
                          <input type="checkbox" name="isPublished" required checked> My paper was Published
                        </div>
                        <div class="form-group">
                          <input type="checkbox" name="isDisseminated" required> My paper was Disseminated
                        </div>
                      </fieldset>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <fieldset class="border p-2 border-success h-100">
                        <legend class="w-auto h6">Optional Status:</legend>
                        <div class="form-group">
                          <input type="checkbox" name="isUtilized"> My paper was Utilized
                        </div>
                      </fieldset>
                    </div>
                  </div>
              </div>
              <div class="form-group publication mt-5">
                <fieldset class="border p-2 border-danger">
                  <legend class="w-auto h6">Provide details for Publication :</legend>
                  <div class="form-group">
                    <label for="util-org-name">ISBN: <em class="note text-danger">*Required</em></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">ISBN</div>
                      </div>
                      <input type="tel" name="util-org-name" id="util-org-name" placeholder="Ex. 978-3-16-148410-0" class="form-control" required oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="util-org-address">Journal Type: <em class="note text-danger">*Required</em></label>
                    <input type="text" name="util-org-address" id="util-org-name" placeholder="Organization Name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="util-org-date">Utilization Date: <em class="note text-danger">*Required</em></label>
                    <input type="date" name="util-org-date" id="util-org-name" placeholder="Organization Name" class="form-control" required>
                  </div>
                </fieldset>
              </div>
              <div class="form-group dissemination mt-5">
                <fieldset class="border p-2 border-danger">
                  <legend class="w-auto h6">Provide details for Dissemination :</legend>
                  <div class="form-group">
                    <label for="util-org-name">Organization Name: <em class="note text-danger">*Required</em></label>
                    <input type="text" name="util-org-name" id="util-org-name" placeholder="Organization Name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="util-org-address">Organization Address: <em class="note text-danger">*Required</em></label>
                    <input type="text" name="util-org-address" id="util-org-name" placeholder="Organization Name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="util-org-date">Utilization Date: <em class="note text-danger">*Required</em></label>
                    <input type="date" name="util-org-date" id="util-org-name" placeholder="Organization Name" class="form-control" required>
                  </div>
                </fieldset>
                
              </div>
              <div class="form-group mt-5 utilization">
                <fieldset class="border p-2 border-danger">
                  <legend class="w-auto h6">Provide details for Utilization :</legend>
                  <div class="form-group">
                    <label for="util-org-name">Organization Name: <em class="note text-danger">*Required</em></label>
                    <input type="text" name="util-org-name" id="util-org-name" placeholder="Organization Name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="util-org-address">Organization Address: <em class="note text-danger">*Required</em></label>
                    <input type="text" name="util-org-address" id="util-org-name" placeholder="Organization Name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="util-org-date">Utilization Date: <em class="note text-danger">*Required</em></label>
                    <input type="date" name="util-org-date" id="util-org-name" placeholder="Organization Name" class="form-control" required>
                  </div>
                </fieldset>
                
              </div>
              <div class="form-group publication">
                
              </div>-->

              <div class="form-group data-head bg-dark text-white mt-5">
                Authors
              </div>
              <div class="form-group mb-5">
                <?php 
                  $stmt=$con->prepare('SELECT `a_id`, CONCAT(a_fname, " ", SUBSTRING(a_mname, 1, 1), ".", a_lname, " ", a_suffix) as name FROM `author` INNER JOIN junc_authorbook on junc_authorbook.aut_id = author.a_id and junc_authorbook.book_id = ?');
                  $stmt->bind_param("i", $bookDet['book_id']);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  if($result->num_rows>0){
                    while ($row = $result->fetch_assoc()) {
                      # code...
                      echo '<div class="col-md-6 col-sm-12 alert alert-info mt-1">
                      '. $row['name'] .'
                    </div>';
                    }
                  }


                ?>
                </div>
              <div class="form-group">
                <input type="checkbox" name="isDownload"> I want my file to be downloadable
              </div>
              <input class="btn btn-success w-100" type="submit">
            </form>

            <script type="text/javascript">
              $("#status").change(function(){
                //alert("l");
                if(this.value=="Disseminated"){

                $(".publication").html('<fieldset class="border p-2 border-danger">' +
                  '<legend class="w-auto h6">Provide Utilization Information:</legend>' +
                  '<div class="form-group">' +
                    '<label for="util-org-name">Organization Name: <em class="note text-danger">*Required</em></label>' +
                    '<input type="text" name="util-org-name" id="util-org-name" placeholder="Organization Name" class="form-control" required>' +
                  '</div>' +
                  '<div class="form-group">' +
                    '<label for="util-org-address">Organization Address: <em class="note text-danger">*Required</em></label> '+
                    '<input type="text" name="util-org-address" id="util-org-name" placeholder="Organization Name" class="form-control" required>'+
                  '</div>'+
                  '<div class="form-group">'+
                    '<label for="util-org-date">Utilization Date: <em class="note text-danger">*Required</em></label>'+
                    '<input type="date" name="util-org-date" id="util-org-name" placeholder="Organization Name" class="form-control" required>' +
                  '</div>' +
                '</fieldset>');
                }else{
                   $(".utilization").html('');
                }
              });
            </script>