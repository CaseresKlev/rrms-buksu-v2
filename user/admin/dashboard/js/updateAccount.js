
$("#btn-update").click(function(){
//	alert("h");

	var opsw = $("#oldpsw").val();
	var npsw = $("#npsw").val();

	

	var ncpsw = $("#ncpsw").val();
	//alert(ncpsw);
	var gname = $("#gname").val();
	if(opsw==''|| npsw=='' || ncpsw==''){
		$("#result").show();
		$("#result").html("Please fill all fields!");
		$("#result").fadeOut(5000);
	}else{
      
		if(ncpsw==npsw){
            
			document.getElementById('admin-frm-updateAcc').reset();
			$.ajax({
				url: 'valUpdateAccount.php',
				type:"POST",
        		cache:false,
        		data: {
        			ncpsw:ncpsw,
        			gname:gname,
        			opsw:opsw

        	},
        	success: function (data) {
          
           		$("#result").show();
            	$("#result").html(data);

        	}
			});
		}else{
			$("#result").html("Password Didnt Match!");
            $("#result").show();
		}
	}

});
