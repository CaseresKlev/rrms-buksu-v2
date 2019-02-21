<label class="sr-only" for="inlineFormInputGroup">Search Author</label>
<div class="input-group mb-2">
	<input type="text" class="form-control" id="key" name="key" placeholder="Search Book Title">
	<div class="input-group-prepend">
	  <div class="group-text btn btn-primary" id="btn-search">Search</div>
	</div>
</div>
<div class="" id="resultHolder">
	<div class="text-dark border-left-info mt-5 h5 p-2">
		Search Result:
	</div>
	<div class="list-group" id="list-result">
	</div>
</div>


		      <script type="text/javascript">
		      	$('#resultHolder').hide();
		      	$('#btn-search').click(function(){
					//alert($('#key').val());
					var key = $('#key').val();
					var bid = $('#bid').val();
					var url = "<?php echo PROJECT_ROOT . "user/admin/dashboard/paper/getSearchResult.php" ?>";
					if($('#key').val()!==''){
						$.ajax({
							url: url,
							type:"POST",
							cache:false,
							data:{
								key: key,
								bid: bid
							},
							success:function(data){
					            
								//alert(data);
								/*var x = data.split(":");
								if(x[0]==='success'){
									var link = window.location  +"?bid=" + x[1];
								}else{
									var link = window.location +"?msg=" + x[1];
								}
								//window.location.replace(link);
								alert(data);*/
								$('#list-result').html(data);
								$('#resultHolder').show();
								
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

		      </script>