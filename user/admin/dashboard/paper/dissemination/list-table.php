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
			<button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#modaldis">Add new Dissemination</button>
			<table class="table table-striped table-bordered table-hover table-condensed">
				  <thead>
				  	<!--SELECT a1.a_id, CONCAT(a1.a_fname, ' ', SUBSTRING(a1.`a_mname`, 1,1), '. ', a1.`a_lname`, ' ', a1.`a_suffix` ) as name FROM `author` a1 WHERE NOT EXISTS (SELECT ja.aut_id from junc_authorbook ja WHERE ja.book_id = 179 and ja.aut_id = a1.a_id) and (`a_fname` like '%%' or `a_mname`like '%%' or `a_lname`like '%%')-->
				    <tr>
				      <th scope="col" class="bg-info text-white" colspan="6">Dessimination Information</th>
				    </tr>
				    <tr>
				      <th scope="col">Type</th>
				      <th scope="col">Convension</th>
				      <th scope="col">Location</th>
				      <th scope="col">Date</th>
				      <th scope="col" colspan="2">Action</th>
				    </tr>
				  </thead>
				  <tbody id="current-author">
				  	<?php 
				  		$stmt = $con->prepare("SELECT * FROM `disseminated` WHERE `book_id` = ?");
				  		$stmt->bind_param("i", $_GET['bid']);
				  		$stmt->execute();
				  		$res = $stmt->get_result();
				  		if($res->num_rows>0){
				  			$counter=0;
				  			while($row = $res->fetch_assoc()){
				  				echo '<tr>
				      <td id="dis-type-td-'. $counter .'">'. $row['type'] .'</td>
				      <td id="dis-conven-td-'. $counter .'">'. $row['convension'] .'</td>
				      <td id="dis-loc-td-'. $counter .'">'. $row['location'] .'</td>
				      <td id="dis-date-td-'. $counter .'">'. $row['date'] .'</td>
				      <td><button class="btn btn-warning btn-sm" id="btn-dis-edit[]" data-toggle="modal" data-target="#modaldis"  name="'. $row['id'] .'-'. $counter .'">Edit</button>
                                      <td><button class="btn btn-danger btn-sm" id="btn-dis-del[]" name="'. $row['id'] .'">Delete</button></td>
				    </tr>';

				    	$counter++;
				  			}

				  			
				  		}else{
				  			echo '<tr>
				      <td class="" colspan="5">No Dissemination Details</td>
				    </tr>';
				  		}
				  	?>
				  </tbody>
				</table>
		</div>
	</div>
	
</div>

<!--dissemination modal-->
                  <div class="modal fade" id="modaldis" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">

                          <h4 class="modal-title" id="modal-title-dis">Add new dissemination information</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form id="dis-form">
                            <div class="form-group">
                              <input type="text" name="book_id" value="<?php echo $bid; ?>" style="display: none;">
                            </div>
                            <div class="form-group">
                              <label for="dis-type">Type: <em style="color: red">*</em></label>
                              <select style= "font-size: 13pt;  font-weight: bold"; id="dis-type" name="dis-type" class="form-control">
                               <option class="tbl-radiocontainer" id="institutional" style="font-size: 12pt"> Institutional </option>
                                <option class="tbl-radiocontainer" id="national" style="font-size: 12pt"> National </option>
                               <option class="tbl-radiocontainer" id="international" style="font-size: 12pt"> International </option>
                            </select>
                            </div>
                            <div class="form-group">
                              <label for="dis-con"> Name of Conference: <em style="color: red">*</em></label>
                              <input type="text" placeholder="Conference name" id="dis-con" name="dis-con"
                                  style= "font-size: 15px; font-weight: bold;" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="con-ven">Venue of Conference: <em style="color: red">*</em></label>
                               <input type="text" placeholder="Conference venue" id="con-ven" name="con-ven" class="form-control"
                                    style= " font-size: 15px; font-weight: bold;">
                            </div>
                            <div class="form-group">
                              <label for="disdate"> Date: <em style="color: red">*</em></label>
                              <input type="date" width="100%" name="disdate" id="disdate"  class="form-control"
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
                          <button type="button" id="instructor-btn-dis-save" class="btn btn-success" style="float: right">SAVE</button>
                        </div>
                      </div>

                    </div>
                  </div>
<span id="url"></span>
<script type="text/javascript">
	$("#instructor-btn-dis-save").click(function(){
		
		var txt = $("#instructor-btn-dis-save").text();
		//alert("!" + txt + "!");
		if(txt=="SAVE"){
			//var book_id = $("#book_id").val();
			//alert(book_id);
			//var title = $("#title").val();
			//var status = $("#status").html();
			var status = "Disseminated / Presented";
			//alert(status);
			//var cited = $("#cite").val();
			//alert(cited);
			//alert(status);
			if(status=="Disseminated / Presented"){
				var distype = $("#dis-type").val();
				var discon = $("#dis-con").val();
				var conven = $("#con-ven").val();
				var disdate = $("#disdate").val();
				//var discert = $("#dis-cert").val();
				//alert(disdate);
				var url = "<?php echo PROJECT_ROOT .  'user/admin/dashboard/uploadDisseminated.php?action=save' ?>"
				if(distype=="" || discon=="" || conven=="" || disdate==""){
					 alert("Please provide dissimination information.");
					
				}else{
					//alert("uploading");
					$("#dis-form").ajaxSubmit(
					 {
					 	url: url,
					 	type: 'POST',
					 	success: function(data){
					 		alert(data);
					 		window.location.reload();
					 	}


					 });
				}


				
				
			
			}
		}else{
			//var status = $("#status").html();
			var status = "Disseminated / Presented";
			//alert(status);
			//var cited = $("#cite").val();
			//alert(cited);
			//alert(status);
			//alert(updateDis);
			if(status=="Disseminated / Presented"){
				var distype = $("#dis-type").val();
				var discon = $("#dis-con").val();
				var conven = $("#con-ven").val();
				var disdate = $("#disdate").val();
				//var discert = $("#dis-cert").val();
				//alert(disdate);
//alert('uploadDisseminated.php?action=update&dis_id=' + updateDis);
				if(distype=="" || discon=="" || conven=="" || disdate==""){
					 alert("Please provide dissimination information.");
					
				}else{
					//alert("uploading");
					var url = "<?php echo PROJECT_ROOT . 'user/admin/dashboard/uploadDisseminated.php?action=update&dis_id=' ?>"
					$("#dis-form").ajaxSubmit(
					 {
					 	url: url + updateDis,
					 	type: 'POST',
					 	success: function(data){
					 		alert(data);
					 		window.location.reload();
					 	}


					 });


					/*$.ajax({

						url: 'savechanges.php',
						type: 'POST',
						cache: false,
						data:{
							book_id: book_id,
							status: status,
							cited: cited,
							date: disdate
						}, 
						success: function(data){
							alert(data);
						}

					})*/
				}


				
				
			
			}

		}
			
})


$("button[id='btn-dis-del[]").click(function(){
	//alert(this.name);
	//exit();
	var url = "<?php echo PROJECT_ROOT. 'user/admin/dashboard/uploadDisseminated.php?dis-id'; ?>"
	$.ajax({

				url: url,
				type: 'POST',
				cache: false,
				data:{
					dis_id:this.name
					
				}, 
				success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
				}

			});
})

var updateDis = "";
$("button[id='btn-dis-edit[]").click(function(){
	var name = this.name;
	var str = name.split("-");
	//alert(str[0] + " " + str[1]);
	var type = $("#dis-type-td-" + str[1]).html();
	var conven = $("#dis-conven-td-" + str[1]).html();
	var disloc = $("#dis-loc-td-"+str[1]).html();
	var date = $("#dis-date-td-" + str[1]).html();

	updateDis = str[0];
	//alert(updateDis);
	//alert(type);
	$("#dis-type").val(type);
	$("#dis-con").val(conven);
	$("#con-ven").val(disloc);
	$("#disdate").val(date);
	$("#instructor-btn-dis-save").text("Update");
	$("#modal-title-dis").html("Update dissemination information");

})
</script>