$('#btn-editProfile').on('click', function () {

	var state = $(this).text();
	if(state!="Save"){
		$(this).text("Save");
		$(this).css("background-color", "#33cc33");
		$('#nameActive').hide();
		$('#bibActive').hide();
		$('#nameEdit').show();
		$('#profileBib').val($('#bibActive').text());
		//alert($('#bibActive').text());
		$('#bibEdit').show();
      	$('#profileContact').attr("readonly", false);
      	$('#profileContact').css("background-color", "#fff");
      	$('#profileContact').css("border-left", "5px solid #33cc33");
      	$('#profileContact').css("padding-left", "15px");

    	$('#profileEmail').attr("readonly", false);
      	$('#profileEmail').css("background-color", "#fff");
      	$('#profileEmail').css("border-left", "5px solid #33cc33");
      	$('#profileEmail').css("padding-left", "15px");

      	$('#profileAddress').attr("readonly", false);
      	$('#profileAddress').css("background-color", "#fff");
      	$('#profileAddress').css("border-left", "5px solid #33cc33");
      	$('#profileAddress').css("padding-left", "15px");
      	$(this).hide();
      	//$(this).removeAttr("type").attr("type", "submit");
      	$('#btn-save').show();
	}else{
		
		
	}
		
            
});