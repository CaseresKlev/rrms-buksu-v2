/*$("#btn-search").click(function(){
	//alert("k");
	var searchkey = $("#search-key").val();
	//alert(searchkey);

	/*$.ajax({
		type: "GET",
		cache: false,
		data:{
			searchkey:searchkey
		},
		success:function(data){
			//alert(data);
			//$("#debug").html(data);
		}
	});
	window.location.replace("admindashboard.php?search="+searchkey);

})*/

$("#viewall").click(function(){
	//alert(this.name);
	window.location.replace("view-stat.php?book_id="+ this.name);
})

$("#viewall-instructor").click(function(){
	//alert(this.name);
	window.location.replace("paper-status.php?book_id="+ this.name);
})
$("button[id='btn[]").click(function(){
	//alert("f");
	//alert(this.index());
	var name = this.name;
	var str = name.split("-");
	//alert(name);
	var txt = $(this).html();
	var idf = "#select-" + str[0];
	var step = str[2];
	var trail = str[1];
	//alert(idf);
	var stat = $(idf).val();
	//alert(stat);

	if(stat===""){
		alert("Please choose status!");
	}else{
		window.location.replace('admin-update-paper-status.php?trail=' +trail + '&stat=' + stat + '&step=' + step);
	}


})

$("#submit1").click(function(){

//alert("sadasdasf");
if ( $("#department").val()==""|| $("#college").val()=="") {
	alert("Please Fill all Fields!");
}else {
	var dept = $("#department").val().toUpperCase();
	var college = $("#college").val().toUpperCase();

	$.ajax({
		url:"valdept.php",
		type:"POST",
		cache:false,
		data:{
			dept:dept,
			college:college,
			task:"add"
		},
		success:function(data){
            
			alert(data);
            window.location.reload();
		}

	});
}




})

$("#btn-del").click(function(){

	var dept= $("#deldept").val();
	//alert(dept);

	$.ajax({
		url:"valdept.php",
		type:"POST",
		cache:false,
		data:{
			dept:dept,
			task:"del"
		},
		success: function(data){
			alert(data);
			location.reload(true);
		}

	});



})


$("#btn-save").click(function(){
	var trail_id = $(this).attr('name');
	var origin = $("#origin").val();
	var parts = $("#parts-man").val();
	var comments = $("#comments").val();
	var page = $("#page-num").val();
	var temp = "";
	for (var i = 0; i < comments.length; i++) {
					if(comments.charAt(i)==="'"){
						temp += "\\" + comments.charAt(i);
					}else{
						temp += comments.charAt(i);
					}
  					
				}
			comments = temp;

	//alert(trail_id + " " +origin + " " + parts + " " + comments + " " + page);
	$.ajax({
		url:"admin-save-updated-paper.php",
		type:"POST",
		cache:false,
		data:{
			trail_id: trail_id,
			origin: origin,
			parts: parts,
			page: page,
			comments
		},
		success: function(data){
			//alert(data);
			if(data==="success"){
				location.reload(true);
			}else{
				alert("Error While Saving your Comments");
			}
			//location.reload(true);
		}

	});
})

$("button[id='btn-dis-delete[]").click(function(){
	alert(thsi.name);
})


$("button[id='page-edit[]").click(function(){
	var todo = $(this).html();
	var comments_id = $(this).attr("name");
	
	if(todo==="Edit"){
		$("#pageno-" + comments_id).prop("readonly", false);
		$("#pageno-" + comments_id).css('color', 'red');
	 	$("#pageno-" + comments_id).attr("Placeholder", "ex: 1-3 or 1,5,8");


	 	$("#parts-" + comments_id).prop("readonly", false);
	 	$("#parts-" + comments_id).prop("rows", "2");
	 	$("#parts-" + comments_id).css("background", "white");
	 	$("#parts-" + comments_id).css("display", "block");
	 	$("#parts-i-" + comments_id).css("display", "none");
	 	
	 	$("#parts-" + comments_id).css('font-weight', 'bold');
	 	$("#parts-" + comments_id).css('color', 'red');
	 	document.getElementById("parts-" + comments_id).rows = "5";

	 	$("#parts-" + comments_id).attr("Placeholder", "ex: Introduction, Abstract");
	 	$("#comments-" + comments_id).prop("readonly", false);
	 	$("#comments-" + comments_id).css('font-weight', 'bold');
	 	$("#comments-" + comments_id).css('color', 'red');
	 	document.getElementById("comments-" + comments_id).rows = "5";
	 	$("#comments-" + comments_id).css('background', 'white');
	 	//$("#comments-" + comments_id).css("height", "" + (25+$("#comments-" + comments_id).scrollHeight)+"px");
	 	
	 	
	 	//alert(height);
	 	$("#comments-" + comments_id).css("display", "block");
	 	$("#comments-i-" + comments_id).css("display", "none");
	 	$("#comments-" + comments_id).css('background', 'white');
	 	$("#comments-" + comments_id).attr("Placeholder", "Abstract");

	 	$("#pageno-" + comments_id).css("display", "block");
	 	$("#pageno-" + comments_id).css("font-weight", "bold");
	 	$("#pageno-" + comments_id).css("font-size", "14pt");
	 	$("#pageno-i-" + comments_id).css("display", "none");

	 	$(this).html('Save');
	 	$(this).attr('class', 'btn btn-success btn-sm');
	}else{
		var page = $("#pageno-" + comments_id).val();
		var parts = $("#parts-" + comments_id).val();
		var comments = $("#comments-" + comments_id).val();
		var temp = "";

		
		//alert(parts + " " + comments + " " + page);
		if(parts=="" || comments==""){
			alert("Please complete require Fields.");
		}else{
			//alert(page);
				for (var i = 0; i < comments.length; i++) {
					if(comments.charAt(i)==="'"){
						temp += "\\" + comments.charAt(i);
					}else{
						temp += comments.charAt(i);
					}
  					
				}

				comments = temp;

				//alert(comments);

					$.ajax({
                        url:"savepage.php",
                        type:"POST",
                        cache:false,
                        data:{           // multiple data sent using ajax
                            comments_id: comments_id,
                            parts: parts,
                            comments: comments,
                            page:page,
                            sender: "admin",
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
	}
	 
})


$("button[id='page-cancel[]").click(function(){
	window.location.reload();
})

$("button[id='page-delete[]").click(function(){
					var comments_id = $(this).attr("name");

					$.ajax({
                        url:"savepage.php",
                        type:"POST",
                        cache:false,
                        data:{           // multiple data sent using ajax
                            comments_id: comments_id,
                            action: "delete",
                             sender: "admin"

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
})