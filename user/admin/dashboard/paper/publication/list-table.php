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
			<button class="btn btn-primary" style="float: right;" id="btn-add-new-pub" data-toggle="modal" data-target="#modaladdpub">Add new Publication</button>
			<table class="table table-striped table-bordered table-hover table-condensed">
				  <thead>
				  	<!--SELECT a1.a_id, CONCAT(a1.a_fname, ' ', SUBSTRING(a1.`a_mname`, 1,1), '. ', a1.`a_lname`, ' ', a1.`a_suffix` ) as name FROM `author` a1 WHERE NOT EXISTS (SELECT ja.aut_id from junc_authorbook ja WHERE ja.book_id = 179 and ja.aut_id = a1.a_id) and (`a_fname` like '%%' or `a_mname`like '%%' or `a_lname`like '%%')-->
				    <tr>
				      <th scope="col" class="bg-info text-white" colspan="6">Publication Information</th>
				    </tr>
				    <tr>
				      <td scope="col">ISSN</td>
                      <td scope="col">Journal</td>
                      <td scope="col">Journal Type</td>
                      <td scope="col">Date</td>
                      <td scope="col" colspan="2">Action</td>
				    </tr>
				  </thead>
				  <tbody id="current-author">
				  	<?php 
				  		$stmt = $con->prepare("SELECT * FROM `published` WHERE `book_id` = ?");
				  		$stmt->bind_param("i", $_GET['bid']);
				  		$stmt->execute();
				  		$res = $stmt->get_result();
				  		if($res->num_rows>0){
				  			$counter=0;
				  			while($row = $res->fetch_assoc()){
				  				echo '<tr>
				      <td id="issn-'. $counter .'">'. $row['issn'] .'</td>
				      <td id="journal-'. $counter .'">'. $row['journal'] .'</td>
				      <td id="type-'. $counter .'">'. $row['type'] .'</td>
				      <td id="date-'. $counter .'">'. $row['date'] .'</td>
				      <td><button class="btn btn-warning btn-sm" id="btn-pub-edit[]" data-toggle="modal" data-target="#modaladdpub"  name="'. $row['id'] .'-'. $counter .'">Edit</button>
                                      <td><button class="btn btn-danger btn-sm" id="btn-pub-delete[]" name="'. $row['id'] .'-'. $counter .'-'. $row['history'] .'">Delete</button></td>
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

<div class="modal fade" id="modaladdpub" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">

                          <h4 class="modal-title" id="modal-title-pub">Add new publication information</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form id="form-published">
                            <div class="form-group">
                              <label for="isdn">ISBN: <em style="color: red">*</em></label>
                              <input type="text/number" placeholder="ISBN Number" id="isdn" name="serial"  class="form-control" style= "font-family: Century Gothic; font-size: 13pt;  font-weight: bold;">
                            </div>
                            <div class="form-group">
                              <label for="journal"> Name of Journal: <em style="color: red">*</em></label>
                              <input type="text" placeholder="journal name" id="journal" name="journal" class="form-control"
                                    style= "font-family: Century Gothic; font-size: 13pt;  font-weight: bold;">
                            </div>
                            <div class="form-group">
                              <label for="type">Type of Journal: <em style="color: red">*</em></label>
                               <input type="text" placeholder="journal type" name="type" id="type" class="form-control"
                                  style= "font-family: Century Gothic; font-size: 13pt;  font-weight: bold;">
                            </div>
                            <div class="form-group">
                              <label for="pubdate">Date: <em style="color: red">*</em></label>
                              <input type="date" width="100%" name="pubdate" id="pubdate" placeholder="" class="form-control"
                                style= "font-family: Century Gothic; font-size: 13pt;  font-weight: bold;">
                            </div>


                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id= "instructor-btn-pub-save" class="btn btn-success" style="float: right"> SAVE </button>
                        </div>
                      </div>

                    </div>
                  </div>


<span id="url"></span>
<script type="text/javascript">

var editstr = "";

$("button[id='btn-pub-edit[]").click(function(){
	//alert(this.name);
	$("#instructor-btn-pub-save").text("Update");
	$("#modal-title-pub").html("Update publication information");
	var name = this.name;
	//alert("kk" + name);
	var str	= name.split("-");
	editstr = str[0];
	
	var issn = $("#issn-" +str[1]).html();
	var journal = $("#journal-" +str[1]).html();
	var type = $("#type-" +str[1]).html();
	var date = $("#date-" +str[1]).html();
	
			$("#isdn").val(issn);
			$("#journal").val(journal);
			$("#type").val(type);
			$("#pubdate").val(date);

	/*$.ajax({

		url: 'uploadPublished.php',
		type: 'POST',
		cache: false,
		data:{
			issn: issn,
			journal: journal,
			type: type,
			date: date,
			book_id: id,
			status: status,
			pub_id:str[0],
			action: "update"
		}, 
			success: function(data){
			alert(data);
			//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
			window.location.reload();
			}
		});*/
});


$("#instructor-btn-pub-save").click(function(){
	//alert("l");
	//return;
	var txt = $(this).text();
	//alert("!" + txt + "!");
	if(txt===" SAVE "){
				//alert("hbbg");

			var id = <?php echo $_GET['bid']; ?>;
			//alert(book_id);
			//var title = $("#title").val();
			var status = "Published";
			//alert(status);
			//var cited = $("#cite").val();
			//alert(cited);
			//alert(status);
			if(status=="Published"){
				//alert("j");
				//return;
				//var trail_id = $("#trail_id").html();
				//alert(trail_id);
				var issn = $("#isdn").val();
				var journal = $("#journal").val();
				var type = $("#type").val();
				var date = $("#pubdate").val();
				//var id = $("#book_id").html();



				if(issn=="" || journal=="" || type=="" || date==""){
					alert("Please provide needed information.");
				}else{
					//alert(issn + " " + journal + " " + type + " " + date + " " + id);
					var url = "<?php echo PROJECT_ROOT . "user/admin/dashboard/uploadPublished.php" ?>";
					$.ajax({

						url: url,
						type: 'POST',
						cache: false,
						data:{
							issn: issn,
							journal: journal,
							type: type,
							date: date,
							book_id: id,
							status: status,
							action: "save"
						}, 
						success: function(data){
							alert(data);
							//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
							window.location.reload();
						}

					});

				}
				
			}/*else if(status==""){
				alert("Please choose book status.");
			}else{
				//alert("ggggggg");

					var d = new Date();

					var date = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
					//alert(date);
				$.ajax({

						url: 'savechanges.php',
						type: 'POST',
						cache: false,
						data:{
							book_id: book_id,
							status: status,
							cited: cited,
							date: date
						}, 
						success: function(data){
							alert(data);
						}

					})
					

			}*/
			//alert(title);
		}else{

				var issn = $("#isdn").val();
				var journal = $("#journal").val();
				var type = $("#type").val();
				var date = $("#pubdate").val();
				var pub_id = editstr;
				//var id = $("#book_id").html();
				if(issn=="" || journal=="" || type=="" || date==""){
					alert("Please provide needed information.");
				}else{
					var url = "<?php echo PROJECT_ROOT . "user/admin/dashboard/uploadPublished.php" ?>";
					$.ajax({

						url: url,
						type: 'POST',
						cache: false,
						data:{
							issn: issn,
							journal: journal,
							type: type,
							date: date,
							pub_id:pub_id,
							action: "update"
						}, 
							success: function(data){
							alert(data);
							//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
							window.location.reload();
							}
						});
					
					

				}
		}
	
})

$("button[id='btn-pub-delete[]").click(function(){
	var name = this.name;
	var str	= name.split("-");
			var url = "<?php echo PROJECT_ROOT . "user/admin/dashboard/uploadPublished.php" ?>";
			$.ajax({

				url: url,
				type: 'POST',
				cache: false,
				data:{
					pub_id:str[0],
					history: str[2],
					action: "delete"
				}, 
				success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
				}

			});
})
</script>