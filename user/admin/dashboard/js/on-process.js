$("button[id='page-edit[]").click(function(){
	var todo = $(this).html();
	var comments_id = $(this).attr("name");
	var book_id = $("#pageno").attr("name");
	//alert(book_id);
	if(todo==="Edit"){
		$("#pageno-" + comments_id).prop("readonly", false);
        $("#pageno-" + comments_id).css('color', 'red');
	 	$("#pageno-" + comments_id).attr("Placeholder", "ex: 1-3 or 1,5,8");
	 	$(this).html('Save');
	 	$(this).attr('class', 'btn btn-success btn-sm');
	}else{
		var page = $("#pageno-" + comments_id).val();

		
			//alert(page);
					$.ajax({
                        url:"savepage.php",
                        type:"POST",
                        cache:false,
                        data:{           // multiple data sent using ajax
                            comments_id: comments_id,
                            page:page,
                            sender: "instructor",
                            action: "save"

                        },
                        success: function (data) {
                           if(data==="Success"){
                           	window.location.reload();
                           }else{
                           	alert(data);
                           }

                           // $("#debug").html(data);

                        }
                    });
		}
		//alert(page);
	
	 
})



/*
var pages = "";
$('#pageno').on('input',function(e){
    //alert('Changed!')
    var temp = $('#pageno').val();
    var ch = temp.slice(-1);
    if(isNaN(ch)){
    	alert("isNaN");
    	if(ch==="," || ch==="-" || ch===""){
    		pages = pages + ch;
    		$('#pageno').val(pages);
    	}else{
    		$('#pageno').val(pages);
    	}
    	
    	
    }else{
    	alert("else");

    	pages = pages + ch;
    	$('#pageno').val(pages);
    }
});*/
