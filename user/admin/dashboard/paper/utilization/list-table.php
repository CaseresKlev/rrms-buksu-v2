<div class="my-5">
	<!--<div class="alert alert-info border-left-success">
		Dissemination information.
	</div>-->
	<div class="row">
		<!--<div class="col-md-6 col-sm-6">
			
			
			<form method="POST" action="validate/" class="table border">
				<table class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<tr>
						<th scope="col" class="bg-success text-white" colspan="4">Add / Edit Dissemination</th>
					</tr>
				</thead>
			</table>
				<div class="form-group px-2">
					<label for="type">Type: <span class="text-danger">*</span></label>
					<select class="form-control" name="type" id="type">
						<option value="Institutional">Institutional</option>
						<option value="National">National</option>
						<option value="International">International</option>
					</select>
				</div>
				<div class="form-group px-2">
					<label for="type">Convension Name: <span class="text-danger">*</span></label>
					<input type="text" name="convension" class="form-control">
				</div>
				<div class="form-group px-2">
					<label for="type">Location: <span class="text-danger">*</span></label>
					<input type="text" name="location" class="form-control">
				</div>
			</form>
		</div>-->
		<div class="col-md-12">
			<button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#modalutil" id="btn-util-addnew">Add new Utilization</button>
			<table class="table table-striped table-bordered table-hover table-condensed">
				  <thead>
				  	<!--SELECT a1.a_id, CONCAT(a1.a_fname, ' ', SUBSTRING(a1.`a_mname`, 1,1), '. ', a1.`a_lname`, ' ', a1.`a_suffix` ) as name FROM `author` a1 WHERE NOT EXISTS (SELECT ja.aut_id from junc_authorbook ja WHERE ja.book_id = 179 and ja.aut_id = a1.a_id) and (`a_fname` like '%%' or `a_mname`like '%%' or `a_lname`like '%%')-->
				    <tr>
				      <th scope="col" class="bg-info text-white" colspan="6">Utilization Information</th>
				    </tr>
				    <tr>
				      <td scope="col">Organization</td>
                      <td scope="col">Address</td>
                      <td scope="col">Date</td>
                      <td scope="col" colspan="2">Action</td>
				    </tr>
				  </thead>
				  <tbody id="current-author">
				  	<?php 
				  		$stmt = $con->prepare("SELECT * FROM `utilize` WHERE `book_id` = ?");
				  		$stmt->bind_param("i", $_GET['bid']);
				  		$stmt->execute();
				  		$res = $stmt->get_result();
				  		if($res->num_rows>0){
				  			$counter=0;
				  			while($row = $res->fetch_assoc()){
				  				echo '<tr>
                                      <td scope="col" id="util-orgname-td-'. $counter .'">'. $row['orgname'] .'</td>
                                      <td scope="col" id="util-orgadd-td-'. $counter .'">'. $row['orgaddress'] .'</td>
                                      <td scope="col" id="util-date-td-'. $counter .'">'. $row['date'] .'</td>
                                      <td><button class="btn btn-warning btn-sm" id="btn-util-edit[]" data-toggle="modal" data-target="#modalutil"  name="'. $row['id'] .'-'. $counter .'">Edit</button>
                                      <td><button class="btn btn-danger btn-sm" id="btn-util-del[]" name="'. $row['id'] .'">Delete</button>
                                    </tr>';

				    	$counter++;
				  			}

				  			
				  		}else{
				  			echo '<tr>
				      <td class="" colspan="5">No Publication Details.</td>
				    </tr>';
				  		}
				  	?>
				  </tbody>
				</table>
		</div>
	</div>
	
</div>

<div class="modal fade" id="modalutil" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">

                          <h4 class="modal-title" id="modal-title-util">Add new utilization information</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form id="util-form">
                            <div class="form-group">
                              <input type="text" name="util-book_id" id="util-book_id" value="<?php echo $_GET['bid']; ?>" style="display: none;">
                              <input type="text" name="util-trail_id" id="util-trail_id" value="<?php echo 0; ?>" style="display: none;">
                            </div>
                            <div class="form-group">
                              <label for="org-name">Organization: <em style="color: red">*</em></label>
                              <input type="text" name="org-name" id="org-name" class="form-control" style= "font-size: 15px; font-weight: bold;" placeholder="Oranization name" >
                            </select>
                            </div>
                            <div class="form-group">
                              <label for="util-ad">Address: <em style="color: red">*</em></label>
                              <input type="text" placeholder="Address" id="util-ad" name="util-ad"
                                  style= "font-size: 15px; font-weight: bold;" class="form-control">
                            </div>

                            <div class="form-group">
                              <label for="utildate"> Date: <em style="color: red">*</em></label>
                              <input type="date" width="100%" name="util-date" id="util-date"  class="form-control"
                                style= " font-size: 15px;  font-weight: bold;">
                            </div>
                            <div class="form-group">
                              <label for="dis-cert">Certificates if Available: <em style="color: red">*</em></label>
                              <input type="file" name="myFile[]" id="dis-cert" class="form-control"
                                style= "font-size: 15px; font-weight: bold;" multiple>
                            </div>


                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="instructor-btn-util-save" class="btn btn-success" style="float: right">SAVE</button>
                        </div>
                      </div>

                    </div>
                  </div>




<span id="url"></span>
<script type="text/javascript">
$("#instructor-btn-util-save").click(function(){
	//alert("g");
	var book_id = <?php echo $_GET['bid']; ?>;
	var trail_id = $("#util-trail_id").val();
	var orgname = $("#org-name").val();
	var org_address = $("#util-ad").val();
	var date = $("#util-date").val();
	var txt = $(this).text();
	//alert(txt);

	//alert(book_id + " " + trail_id + " " + orgname + " " + org_address + " " + " " + date);
	if(orgname==="" || org_address==="" || date===""){
		alert("please provide utilization information.");
	}else{
		if(txt==="SAVE"){
			var url = "<?php echo PROJECT_ROOT . "user/admin/dashboard/uploadUtil.php?action=save" ?>";
			$("#util-form").ajaxSubmit(
					 {
					 	url: url,
					 	type: 'POST',
					 	success: function(data){
					 		alert(data);
					 		window.location.reload();
					 	}


					 });
		}else{
			var url = "<?php echo PROJECT_ROOT . "user/admin/dashboard/uploadUtil.php?action=edit&util_id=" ?>" + util_id_update;
			//alert(url);
			//return;
			$("#util-form").ajaxSubmit(
					 {
					 	url:  url,
					 	type: 'POST',
					 	success: function(data){
					 		alert(data);
					 		window.location.reload();
					 	}


					 });
		}
					
		}
})

$("button[id='btn-util-del[]").click(function(){
	//alert("delete");
	//alert(this.name);
	//window.location.replace("uploadUtil.php?action=delete&util_id="+ this.name);
	var url = "<?php echo PROJECT_ROOT . "user/admin/dashboard/uploadUtil.php?util_id=" ?>";
	$.ajax({

				url: url + this.name,
				type: 'POST',
				cache: false,
				data:{
					action: "delete"
				}, 
				success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
				}

			});
})

var util_id_update = "";
$("button[id='btn-util-edit[]").click(function(){
	var name = this.name;
	var str = name.split("-");
	//alert(str[1]);
	var orgname = $("#util-orgname-td-" + str[1]).html();
	var org_address = $("#util-orgadd-td-" + str[1]).html();
	var date = $("#util-date-td-" + str[1]).html();
	//alert(orgname + " " + og)
	var book_id = $("#util_book_id").html();
	var trail_id = $("#util-trail_id").val();
	//alert(trail_id);
	util_id_update = str[0];
	//alert(orgname + " " + org_address + " " + date + " " + book_id + "trail "+ trail_id);
	$("#org-name").val(orgname);
	$("#util-ad").val(org_address);
	$("#util-date").val(date);
	$("#instructor-btn-util-save").text("UPDATE");
	$("#modal-title-util").html("Update utilization information");
	/*$("#util-form").ajaxSubmit(
	{
		url: 'uploadUtil.php?action=edit&util_id=' + str[0],
		type: 'POST',
	success: function(data){
		alert(data);
		window.location.reload();
	}


	});
	
	//alert("delete");
	//alert(this.name);
	//window.location.replace("uploadUtil.php?action=delete&util_id="+ this.name);
	/*$.ajax({

				url: 'uploadUtil.php?util_id='+ this.name,
				type: 'POST',
				cache: false,
				data:{
					action: "delete"
				}, 
				success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
				}

			});*/
})
</script>