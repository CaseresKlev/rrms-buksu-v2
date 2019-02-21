<div class="col border-left border-danger mt-5 mb-3 h4" style="border-width: 6px !important; ">
		Add Author(s) Here..
	</div>
<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="form-row">
		    <div class="col">
		      <label class="sr-only" for="inlineFormInputGroup">Search Author</label>
		      <div class="input-group mb-2">
		        <input type="text" class="form-control" id="key" name="key" placeholder="Search Author">
		        <div class="input-group-prepend">
		          <div class="group-text btn btn-primary" id="btn-search">Search</div>
		        </div>
		      </div>
		      <div id="authorlist">
		      	<table class="table table-striped table-bordered table-hover table-condensed">
				  <thead>
				  	<!--SELECT a1.a_id, CONCAT(a1.a_fname, ' ', SUBSTRING(a1.`a_mname`, 1,1), '. ', a1.`a_lname`, ' ', a1.`a_suffix` ) as name FROM `author` a1 WHERE NOT EXISTS (SELECT ja.aut_id from junc_authorbook ja WHERE ja.book_id = 179 and ja.aut_id = a1.a_id) and (`a_fname` like '%%' or `a_mname`like '%%' or `a_lname`like '%%')-->
				    <tr>
				      <th scope="col">Name</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <div class="row ml-1 my-3" id="refresh">
				  		<span class="badge badge-info"><a href="">Refres List</a></span>
				  </div>
				  <tbody id="list-authorlist">
				  	
				  	<input class="d-none" type="number" name="bookid" id="bookid" value="<?php echo $bid ?>">
				  	<?php
				  		$stmt = $con->prepare("SELECT a1.a_id, CONCAT(a1.a_fname, ' ', SUBSTRING(a1.`a_mname`, 1,1), '. ', a1.`a_lname`, ' ', a1.`a_suffix` ) as name FROM `author` a1 WHERE NOT EXISTS (SELECT ja.aut_id from junc_authorbook ja WHERE ja.book_id = ". $bid ." and ja.aut_id = a1.a_id) and (`a_fname` like '%%' or `a_mname`like '%%' or `a_lname`like '%%') ORDER BY `a_fname` ASC LIMIT 10");
				  		$stmt->execute();
				  		$res = $stmt->get_result();
				  		if($res->num_rows>0){
				  			while ($row=$res->fetch_assoc()) {
				  				echo '<tr>
				      <td>'. $row['name'] .'</td>
				      <td><div class="btn btn-primary btn-sm" onclick="addThisAuthor('. $row['a_id'] .')">add</div></td>
				    </tr>';
				  			}
				  		}
				  	?>
				    
				    <!--<tr>
				      <td>the Bird</td>
				      <td><div class="btn btn-primary btn-sm">add</div></td>
				    </tr>-->
				  </tbody>
				</table>
				<div class="alert alert-info border-left-danger" >
					Author not found? Use Search to find the author.
				</div>
		      </div>
		    </div>
	  	</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<table class="table table-striped table-bordered table-hover table-condensed">
				  <thead>
				  	<!--SELECT a1.a_id, CONCAT(a1.a_fname, ' ', SUBSTRING(a1.`a_mname`, 1,1), '. ', a1.`a_lname`, ' ', a1.`a_suffix` ) as name FROM `author` a1 WHERE NOT EXISTS (SELECT ja.aut_id from junc_authorbook ja WHERE ja.book_id = 179 and ja.aut_id = a1.a_id) and (`a_fname` like '%%' or `a_mname`like '%%' or `a_lname`like '%%')-->
				    <tr>
				      <th scope="col" class="bg-info text-white" colspan="2">Current Authors</th>
				    </tr>
				    <tr>
				      <th scope="col">Name</th>
				    </tr>
				  </thead>
				  <tbody id="current-author">
				  	<?php
				  		$stmt = $con->prepare("SELECT CONCAT(a1.a_fname, ' ', SUBSTRING(a1.`a_mname`, 1,1), '. ', a1.`a_lname`, ' ', a1.`a_suffix` ) as name FROM `junc_authorbook` INNER JOIN author a1 on a1.a_id = junc_authorbook.aut_id WHERE `book_id` = ?");
				  		$stmt->bind_param("i", $_GET['bid']);
				  		$stmt->execute();
				  		$res = $stmt->get_result();
				  		if($res->num_rows>0){
				  			while($row = $res->fetch_assoc()){
				  				echo "<tr>
				      <td>". $row['name'] ."</td>
				    </tr>";
				  			}

				  			
				  		}else{
				  			echo '<tr>
				      <td class="bg-danger">No Author</td>
				    </tr>';
				  		}
				  	?>
				  </tbody>
				</table>
	</div>
	<input type="number" class="d-none" name="bid" id="bid" value="<?php echo $_GET['bid'] ?>">
</div>

<script type="text/javascript">
	$('#refresh').hide();
	$('#btn-search').click(function(){
		//alert($('#key').val());
		var key = $('#key').val();
		var bid = $('#bid').val();
		if($('#key').val()!==''){
			$.ajax({
				url:"validate/searchAuthor.php",
				type:"POST",
				cache:false,
				data:{
					key: key,
					bid: bid
				},
				success:function(data){
		            
					/*alert(data);
					var result = data.split(":");
					if(result[0]==="success"){
						window.location.reload();
					}else{
						alert(result[1]);
					}
		            */
		            $('#list-authorlist').html(data);
		            $('#refresh').show();
				}

			});
		}
	})

	$('#key').keypress(function (e) {
     	var key = e.which;
     	if(key == 13){
        	$('#btn-search').click();
        return false;  
      }
    });

	function addThisAuthor(a_id){
		var bid = $('#bid').val();
		$.ajax({
			url:"validate/addNewAuthor.php",
			type:"POST",
			cache:false,
			data:{
				bid:bid,
				a_id:a_id,
			},
			success:function(data){
	            
				//alert(data);
				var result = data.split(":");
				if(result[0]==="success"){
					window.location.reload();
				}else{
					alert(result[1]);
				}
	            
			}

		});
	}
</script>