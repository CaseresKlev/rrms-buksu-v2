$("#admin-btn-generate").click(function(){
  //alert("g");
		var count = $("#access-count").val();
		var type = "INSTRUCTOR";
		//alert(count); 
		if(count<1){
			alert("Please input greater than 0");
		}else{
			$.ajax({
			url: "getAccessCodes.php",
    		type:"POST",
    		cache:false,
    		data:{
    			count:count,
    			type:type

    		},
    		//onProgress: function(event,position,total,percentCompelete)
    		onProgress: function(e)

               {
                  //$("#prog").attr('value',percentCompelete); 
                   //$("#percent").html(percentCompelete+'%');
                   //alert(e);
               },
    		success: function(data){
          //alert(data);
    			location.reload(true);
    			
    		}



		});
		}

		


	
});


$("#instructor-frm-generate").click(function(){
    //alert("true");
    //alert("g");
        var count = $("#access-count").val()
        var type = "STUDENT";
        //alert(count); 
        if(count<1){
            alert("Please input greater than 0");
        }else{
            $.ajax({
            url: "getAccessCodes.php",
            type:"POST",
            cache:false,
            data:{
                count:count,
                type:type

            },
            //onProgress: function(event,position,total,percentCompelete)
            onProgress: function(e)

               {
                  //$("#prog").attr('value',percentCompelete); 
                   //$("#percent").html(percentCompelete+'%');
                   alert(e);
               },
            success: function(data){
            
                location.reload(true);
                
            }



        });
        }

        


    
});