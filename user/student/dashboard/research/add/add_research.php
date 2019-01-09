<form action="validate/" enctype="multipart/form-data" method="POST" id="form-add">
              <div class="content">
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
                  <textarea id="textArea-title" class="form-control" name="title" placeholder="Title" required></textarea>
              </div>
              <div class="form-group">
                <label for="textArea-abstract">Abstract: <em class="note text-danger">*Required</em></label>
                  <textarea id="textArea-abstarct" class="form-control" name="abstract" rows="10" placeholder="Abstract" required></textarea>
              </div>
              <div class="form-group">
                <label for="select-Department">Department: <em class="note text-danger">*Required</em></label>
                <select class="form-control" id="select-Department" name="department">
                  <?php 

                    $query = 'SELECT id, CONCAT(`college`, " - ", `cat_name`) as name FROM `department` WHERE 1 ORDER BY college';
                    //echo $query;
                    $dept = $con->query($query);
                    //echo $result->num_rows;
                    if($dept->num_rows>0){
                      while ($row = $dept->fetch_assoc()) {
                      
                      echo '<option value="'. $row['id'] .'">'. $row['name'] .'</option>';
                      }
                    }

                   ?>
                  
                </select>
              </div>
              <div class="form-group">
                <label for="textarea-keywords">Keywords: <em class="note text-danger">*Required</em></label>
                <textarea id="textarea-keywords" name="keywords" class="form-control" placeholder="keywords" required></textarea>
              </div>
              <div class="form-group">
                <label for="references">References: <em class="note text-danger">*Required (Separate with [new line per entry])</em></label>
                <textarea class="form-control" name="references" required rows="15" placeholder="Ex:

Bigirimana S., Jagero N., & Chizema P., (2015). An Assessment of the Effectiveness of Electronic Records Management. Retrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools

Bongor et al., (2009). Cognitive Computing: Where Big Data Is Driving Us. Retrieved from
https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools
"></textarea>
              </div>
              <div class="form-group">
                  <label for="status">Reserach Status: </label>
                  <select id="status" class="form-control" name="status">
                    <option value="Unpublished">Unpublished</option>
                    <option value="Utilized">Utilized</option>
                  </select>
              </div>
              <div class="form-group utilization">
                
              </div>
              <div class="form-group">
                <input type="checkbox" name="isDownload"> I want my file to be downloadable
              </div>
              <input class="btn btn-success w-100" type="submit" name="submit">
            </form>

            <script type="text/javascript">
              $("#status").change(function(){
                if(this.value=="Utilized"){

                $(".utilization").html('<fieldset class="border p-2 border-danger">' +
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