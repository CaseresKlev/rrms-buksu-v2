function savePost(editor){
	var html = $(editor).html();

	//alert(html);
	$('#editorhtml').val(html);
}

$('#featured').mousedown(function() {
   /* if (!$(this).is(':checked')) {
        $('#fileholder').html('<div class="form-group">'+
                            '<label for="FileCover">Featured Cover:&nbsp<span class="text-danger muted">*&nbsp;6MB Maximum&nbsp;&nbsp;</span></label>'+   
                            '<input type="file" name="feauturedCover" style="font-size: 11pt" required>'+
                        '</div>');
    }else{
    	$('#fileholder').html('');
    }*/
    if (!$(this).is(':checked')) {
        $('#feauturedCover').prop( "disabled", false );
    }else{
        $('#feauturedCover').prop( "disabled", true )
    }
    
});