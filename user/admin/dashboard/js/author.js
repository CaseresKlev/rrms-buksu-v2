$("#add-bib").click(function (){
	$("#addbib").show();
})

$("#submitbib").click(function(){
	//alert("c");
	var bib = $("#bibText").val();
	var auth_id = $("#auth_id").val();
	//alert(bib);

	$.ajax({
			url:"saveBibiography.php",
           type: "POST",
            cache: false,
             data:{
                 bib:bib,
                 auth_id:auth_id
             },
             success: function(data){
                 if(data==="Success"){
                 	window.location.reload();
                 }	

                 //alert(data);
             }
	})
})