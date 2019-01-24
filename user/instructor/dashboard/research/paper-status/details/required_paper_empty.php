               <div class="container rounded mt-5 shadow">
               	<div class=" container bg-dark text-white ml-0">
               		<h4><?php echo $paper_stat; ?></h4>
               	</div>
               	<div class="row ml-1">
               		<h5>Submitted Paper:</h5>
               	</div>
               	<div class="row ml-1">
               		<h5 class="text-danger font-weight-bold">No submitted paper &nbsp;(*required)</h5>
               	</div>
               	<div class="row ml-1 mt-4">
               		<h6><button class="btn btn-primary btn-sm" id="submit-paper" data-toggle="modal" data-target="#modalsubmit" onclick="showModal('#modalsubmit')">Submit paper</button></h6>
               	</div>
               </div>


               <div class="modal fade" id="modalsubmit" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                         <form id="fileForm-upload" action="validate/upload-revision.php" method="POST" enctype="multipart/form-data">
                             <div class="modal-header">

                               <h4 class="modal-title" id="modal-title">Upload Revision </h4>
                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                             </div>
                             <div class="modal-body">
                               

                                   <div class="form-group" style="">
                                        <input class="d-none" type="number" name="trailID" value="<?php echo $_GET['trail'] ?>" readonly>
                                        <input type="file" class="form-control-file" id="file-upload"  name="file" required>
                                        <div class="note text-danger">*pdf format max size 10mb </div>

                                   </div>

                               
                             </div>
                             <div class="modal-footer">
                               <input type="submit" class="btn btn-success" id="uploadpaper" value="Submit">
                             </div>
                         </form>
                      </div>

                    </div>
                  </div>