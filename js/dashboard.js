var notify;

function playSound(filename){
	var filename = "http://" + window.location.hostname + "/rrms-buksu/notification/" + filename;
	var mp3Source = '<source src="' + filename + '.mp3" type="audio/mpeg">';
	var oggSource = '<source src="' + filename + '.ogg" type="audio/ogg">';
	var embedSource = '<embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3">';
	document.getElementById("sound").innerHTML='<audio autoplay="autoplay">' + mp3Source + oggSource + embedSource + '</audio>';
}



function working(sender,  cancel,  action, spin_img, container, destination, param, working_entry){
	//alert(param);
	//alert("Action: " + action + " Spinner: " + spin_img + " container: " + container );

	$(sender).prop('disabled', true);
	$(cancel).prop('disabled', true);
	$(container).show();
	$(spin_img).attr('src', 'http://' + window.location.hostname + '/rrms-buksu/img/loader-32x/loader1.gif');

	var url = "http://" + window.location.hostname + "/rrms-buksu/" + destination;
	var http = new XMLHttpRequest();
	var params = 'action='+ action +  param;

	http.open('POST', url, true);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	http.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			//var obj = JSON.parse(this.responseText);
			//alert(this.responseText);
			var responce = this.responseText.split(":");
			if(responce[1]==="error"){
				$(container).html("<b class='text-danger'>" + responce[1] + "</b>");
			}else{
				$(container).html("<b class='text-success'>" + responce[1] + "</b>");
				//alert(responce[1]);
				setTimeout(function(){ $(working_entry).toggle() }, 2000);
			}
			
			//if(obj)
			/*if(this.responseText=="Success"){
				notify.update('title', '<strong>I got it!</strong><br>');
				notify.update('message', 'I will not show next time');
			}else{
				notify.update('title', '<strong>Sorry something went wrong</strong><br>');
				notify.update('message', 'I will be showing next time');
			}*/
		}
	}
	http.send(params);

}



function doNotShow(){

	var url = "http://" + window.location.hostname + "/rrms-buksu/server_script/notification.php";
	//alert(url);
	var http = new XMLHttpRequest();
	
	var params = 'show='+ 0;
	http.open('POST', url, true);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	http.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			//var obj = JSON.parse(this.responseText);
			//alert(this.responseText);
			//if(obj)
			if(this.responseText=="Success"){
				notify.update('title', '<strong>I got it!</strong><br>');
				notify.update('message', 'I will not show next time');
			}else{
				notify.update('title', '<strong>Sorry something went wrong</strong><br>');
				notify.update('message', 'I will be showing next time');
			}
		}
	}
	http.send(params);
	



	
	setTimeout(function() { 
		notify.close();
	}, 1500);
}

function showNotification(fromLoc, alignFrom){
	//alert(fromLoc);
	//alert("it is notification");
	var coor_x = 20;
	var coor_y = 90;
	if(fromLoc=="bottom"){
		coor_x = 0;
		coor_y = 20;
	}

	var message = $(".notif-message").html();
	notify = $.notify({
	    title: "<i class=\"fas fa-bell fa-lg\"></i> <strong>You have new Author request:</strong><br>",
	    message: message
	  },{
	    icon_type: "image",
	    animate: {
	      enter: "animated fadeInRight",
	      exit: "animated fadeOutRight"
	    },
	    placement: {
	      from: fromLoc,
	      align: alignFrom
	    },
	    type: "info",
	    mouse_over: "pause",
	    delay: 7000,
	    offset: {
	      x: coor_x,
	      y: coor_y
	    }
	}
	);
	playSound('notif');
}

function showDetailedNotification(){
	if(notify!=null){
		
	notify.close();
	}
	$("#modalNotification").modal("toggle");
}


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

$('#btn-edit-title').click(function(){
	$('.edited_title').html($('.title').html());
	$('#modalEditText').modal('toggle');
})

$('#btn-edit-author').click(function(){
	$('.onViewAuthor').hide();
	$('.onEditAuthor').show();
})

var dep_lock = 1;

$('#btn-edit-department').click(function(){

	if(dep_lock==1){
		$(this).attr('class', 'badge badge-success ml-auto');
		$(this).html(" Save");
		$('.onViewDepartment').hide();
		$('#department').show();
		$('#label-department').show();
		dep_lock = 0;
	}else{
		$(this).attr('class', 'badge badge-warning ml-auto');
		$(this).html(" Save");
		

		//update dept
		var val = $('#department').val();
		saveUpdate(val, "department");
		$('.onViewDepartment').show();
		$('#department').hide();
		$(this).html(" Edit");
		$('#label-department').hide();
		dep_lock = 1;
	}
	//alert("!" + );
	
	
})

function saveUpdate(val, pointer){
		//alert(dept);
		var book_id = $('#book_id').val();
		
		var http = new XMLHttpRequest();
		var url = 'validate/update.php';
		var params = 'value='+ val +"&pointer=" + pointer + "&book_id=" + book_id;
		http.open('POST', url, true);
		http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		http.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200) {
				var obj = JSON.parse(this.responseText);
				//alert(this.responseText);
				//if(obj)
				if(obj.status=="success"){
					window.location.reload();
					//$('.departmentID').html($('#department option:selected').html());
				}else{
					//alert("Operation not Successful!");
				}
			}
		}
		http.send(params);
}

$('#btn-edit-keywords').click(function(){
	$('#kw-hint').attr("class", "note text-white badge-info d-inline");
	//$('#kw-hint').show();
	$('.edit-Keywords').hide();
	$('#keywords').show();
	$('#btn-edit-keywords-save').attr("class","badge badge-success ml-auto d-inline");
	$(this).hide();
})

$('#btn-edit-keywords-save').click(function(){
	//alert("k");
	var kw = $('#keywords').val();
	if(kw!=""){
		saveUpdate(kw,"keywords");
	}else{

	alert("Error: Keywords cannot be empty!");
	}
})

$('#btn-edit-abstract').click(function(){
	$('#edit-abstract').hide();
	$('#abstract').show();
	$('#btn-edit-abstract-save').attr("class","badge badge-success ml-auto d-inline");
	$(this).hide();
})

$('#btn-edit-file').click(function(){
	$('#file-upload').attr("accept", "application/pdf");
	$('#uploadFile-note').html("*(PDF Format - Max file size 40MB)");
	$('#modal-fileUpload-title').html("Change File");
	$('#file-action').val("file");
	$('#modalFileUpload').modal("toggle");
})

$('#btn-edit-cover').click(function(){
	$('#file-upload').attr("accept", ".png, .jpg, .jpeg");
	$('#uploadFile-note').html("*(JPEG, JPG or PNG Format - Max file size 2MB)");
	$('#modal-fileUpload-title').html("Change Cover");
	$('#file-action').val("cover");
	$('#modalFileUpload').modal("toggle");
})
	


$('#btn-edit-abstract-save').click(function(){
	var abs = $('#abstract').val();
	if(abs!=""){
		saveUpdate(abs, "abstract");
	}else{

		alert("Error: Abstract cannot be empty!");
	}
})

$('#btn-downloadable').click(function(){
	if($(this).is(':checked')){
		//alert("checked");
		saveUpdate(1,"downloadable");
	}else{
		saveUpdate(0,"downloadable");
	}

})

$('#btn-del-reffvgbhjk').click(function(){
	
})

function removeEditRef(title, link, index, action){
	//alert(title);
	if(action=="delete"){
		saveUpdate(index + "-" + action, "references");
	}else if(action=="edit"){

		$("#modal-addAuthor-title").html("Edit Reference");
		$('#ref-link').val(link);
		$('#ref-title').html(title);
		$('#form-ref-id').val(index);
		$('#modalAddEditRef').modal("toggle");
		$('#ref-citation').val("--empty-null--");
		$('.option-select').hide();
	}else{
		$("#modal-addAuthor-title").html("Add new Reference");
		$('#ref-link').val("");
		$('#ref-title').html("");
		$('#form-ref-id').val(0);
		$('.option-select').show();
		$('#ref-citation').val("--empty-null--");
		$('#modalAddEditRef').modal("toggle");
		//alert("add");
	}
	//
}

$('#use-citation').click(function(){
	if($(this).is(':checked')){
		$('.option1').hide();
		$('.option2').show();
		$('#form-ref-id').val(-1);
		$('#ref-link').val("--empty-null--");
		$('#ref-title').html("--empty-null--");
		$('#ref-citation').val("");
	}else{
		$('.option1').show();
		$('.option2').hide();
		$('#form-ref-id').val(0);
		$('#ref-citation').val("--empty-null--");
		$('#ref-link').val("");
		$('#ref-title').html("");
	}
})


$(".txt-searchAuthor").on('keyup', function (e) {
	//alert(e.keyCode);
    if (e.keyCode == 13) {
        var book_id = $('#book_id').val();
	var k = $('.txt-searchAuthor').val();
	var http = new XMLHttpRequest();
	var url = 'validate/add-author.php';
	var params = 'key='+ k + '&book_id='+book_id;
	http.open('POST', url, true);

	//Send the proper header information along with the request
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	http.onreadystatechange = function() {	//Call a function when the state changes.
	    if(this.readyState == 4 && this.status == 200) {
	        //alert(this.responseText);
	        $('#author-search-list').html("");
	        var myObj = JSON.parse(this.responseText);
	        if(myObj.length>0){
	        	for (x in myObj) {
			      var name = myObj[x].name;
			      //alert(myObj[x].a_id);
			      $('#author-search-list').append('<tr>'                           
	                                +'<td>'+ name + '</td>'
	                                +'<td><div class="badge badge-primary ml-auto btn-select-add-author" '
	                                +' onclick="addEditAuthor('+ myObj[x].a_id +', \'added\')" >'
	                                +'<i class="fas fa-plus"></i> Add</div>'
	                                 +'</td>'
	                              +'</tr>');

			    }
	        }else{
	        	$('#author-search-list').append('<td colspan="2"><h5>No Search found Matching your query.<br>Try Again!</h5></td>')
	        }
		    
		    //document.getElementById("demo").innerHTML = txt;
		     $('#modalAuthorADD').modal("toggle");
	    }
	}
	http.send(params);
    }
});

$('#btnSearchAuthor').click(function(){
	//alert("k");
	var book_id = $('#book_id').val();
	var k = "";
	k = $('.txt-searchAuthor').val();
	var http = new XMLHttpRequest();
	var url = 'validate/add-author.php';
	var params = 'key='+ k + '&book_id='+book_id;
	http.open('POST', url, true);

	//Send the proper header information along with the request
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	http.onreadystatechange = function() {	//Call a function when the state changes.
	    if(this.readyState == 4 && this.status == 200) {
	        //alert(this.responseText);
	        $('#author-search-list').html("");
	        var myObj = JSON.parse(this.responseText);
	        if(myObj.length>0){
	        	for (x in myObj) {
			      var name = myObj[x].name;
			      //alert(myObj[x].a_id);
			      $('#author-search-list').append('<tr>'                           
	                                +'<td>'+ name + '</td>'
	                                +'<td><div class="badge badge-primary ml-auto btn-select-add-author" '
	                                +' onclick="addEditAuthor('+ myObj[x].a_id +', \'added\')" >'
	                                +'<i class="fas fa-plus"></i> Add</div>'
	                                 +'</td>'
	                              +'</tr>');

			    }
	        }else{
	        	$('#author-search-list').append('<td colspan="2"><h5>No Search found Matching your query.<br>Try Again!</h5></td>')
	        }
		    
		    //document.getElementById("demo").innerHTML = txt;
		     $('#modalAuthorADD').modal("toggle");
	    }
	}
	http.send(params);
})

$('#btnSearchAuthorOnProcess').click(function(){
	//alert("k");
	var book_id = $('#book_id').val();
	var k = "";
	k = $('.txt-searchAuthor').val();
	if(k==""){
		alert("Please Provide name to search");
		return;
	}
	var http = new XMLHttpRequest();
	var url = 'validate/add-author.php';
	var params = 'key='+ k + '&book_id='+book_id;
	http.open('POST', url, true);

	//Send the proper header information along with the request
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	http.onreadystatechange = function() {	//Call a function when the state changes.
	    if(this.readyState == 4 && this.status == 200) {
	        //alert(this.responseText);
	        $('#author-search-list').html("");
	        var myObj = JSON.parse(this.responseText);
	        if(myObj.length>0){
	        	for (x in myObj) {
			      var name = myObj[x].name;
			      //alert(myObj[x].a_id);
			      $('#author-search-list').append('<tr>'                           
	                                +'<td>'+ name + '</td>'
	                                +'<td><div class="badge badge-primary ml-auto btn-select-add-author" '
	                                +' onclick="addEditTempAuthor('+ myObj[x].a_id +', \'added\',\''+ name + '\')" >'
	                                +'<i class="fas fa-plus"></i> Add</div>'
	                                 +'</td>'
	                              +'</tr>');

			    }
	        }else{
	        	$('#author-search-list').append('<td colspan="2"><h5>No Search found Matching your query.<br>Try Again!</h5></td>')
	        }
		    
		    //document.getElementById("demo").innerHTML = txt;
		     $('#modalAuthorADD').modal("toggle");
	    }
	}
	http.send(params);
})

function addEditAuthor(id, action){
	var book_id = $('#book_id').val();
	var author = action +"-"+ id+ "-" + book_id;
	//alert(author);
	$('#author').val(author);
	$('#submit-author').trigger("click");
	
}

function addEditTempAuthor(id, action, name){
	var book_id = $('#book_id').val();
	//var author = action +"-"+ id+ "-" + book_id;
	var author = id + ": " + name;
	//alert(author);
	/*$('#author').val(author);
	$('#submit-author').trigger("click");*/

	var temp = ''+
                      '<div class="input-group pt-1">'+
                        '<div class="input-group-append">'+
                          '<div class="d-none">'+
                            '<input type="text" name="author[]" class="alert alert-info form-control" readonly value="'+ id +'">'+
                          '</div>'+
                        '</div>'+
                        '<input type="text" class="alert alert-info form-control" readonly value="'+ name +'">'+
                        '<div class="input-group-append">'+
                          '<div class="btn btn-outline-danger" type="button" onclick="removeTempAutor(this);"><i class="fas fa-trash-alt mt-2"></i></div>'+
                        '</div>'+
                      '</div>'+
                    '';
                    $('#modalAuthorADD').modal("toggle");
                    $('.txt-searchAuthor').val("");
	$('.listAuthor').append(temp);
}

function removeAuthor(author, name){
	//alert(name);
	$('#displayName').html(name);
	$('#displayName2').html(name);
	var book_id = $('#book_id').val();
	$('#author').val("remove-"+ author + "-" + book_id);
	//alert($('#author').val());
	$('#modalAuthor').modal('toggle');
	//var x = "#author-" + author;
	//alert("Are you sure you want to delete " + $(x).val());
}

function removeTempAutor(sender){
	var x = $(sender).parent().parent();
	$(x).remove();
}

function removeRequest(id){
	var http = new XMLHttpRequest();
	var url = 'validate/remove-author-request.php';
	var params = 'request_id='+ id;
	//alert(params);

	http.open('POST', url, true);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			//alert(this.responseText);
			var obj = JSON.parse(this.responseText);
			//if(obj)
			if(obj.status=="success"){
				window.location.reload();
			}else{
				alert("Operation not Successful!");
			}
		}

	}

	http.send(params);
}



///Update Account

$('#matchpass').on('keyup',function(){
	if($('#newpass').val()!=$('#matchpass').val()){
		$('.hint').show();
	}else{
		$('.hint').hide();
		$('#submit').prop('disabled', false);
	}
})
