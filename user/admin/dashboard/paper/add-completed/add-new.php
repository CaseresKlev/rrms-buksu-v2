<form action="<?php echo PROJECT_ROOT . 'user/admin/dashboard/paper/add-completed/validate/' ?>" enctype="multipart/form-data" method="POST" id="form-add">
                 
              <div class="form-group">
                <label for="textArea-title">Title: <em class="note text-danger">*Required</em></label>
                  <textarea id="textArea-title" class="form-control" name="title" placeholder="Title" required></textarea>
              </div>
              <div class="form-group">
                <label for="select-Department">Department: <em class="note text-danger">*Required</em></label>
                <select class="form-control" id="select-Department" name="department">
                  <?php 

                    $stmt = $con->prepare("SELECT * FROM `department` WHERE `college` = 'Faculty'");
		            $stmt->execute();
		            $res = $stmt->get_result();
		            $deptName = "Uncategorized";
		            $deptID = 0;
		            if($res->num_rows>0){
		              $row = $res->fetch_assoc();
		              $deptID = $row['id'];
		              $deptName = $row['college'];
		              echo '<option value="'. $deptID .'">'. $deptName . ' - ' . $deptName .'</option>';
		            }

                   ?>
                  
                </select>
              </div>
              <input class="btn btn-success w-100" type="submit" name="submit">
            </form>

            