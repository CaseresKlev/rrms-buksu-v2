/*$("#status").change(function(){
	//$(".btn-radio").prop('checked', false);
	//alert($("#status").val());
	if($("#status").val()==="Disseminated / Presented"){
		$(".fieldset-published").hide();
		$(".fieldset-disseminated").slideDown("slow");
		//$(".fieldset-disseminated").css("background-color","red");
	}else if($("#status").val()==="Published"){
		$(".fieldset-disseminated").hide();
		$(".fieldset-published").slideDown("slow");
	}else{
		$(".fieldset-published").hide();
		$(".fieldset-disseminated").hide();
	}
})*/

var editstr = "";

$("button[id='btn-pub-edit[]").click(function(){
	//alert(this.name);
	$("#instructor-btn-pub-save").text("Update");
	$("#modal-title-pub").html("Update publication information");
	var name = this.name;
	var str	= name.split("-");
	editstr = str[0];
	
	var issn = $("#issn-" +str[1]).html();
	var journal = $("#journal-" +str[1]).html();
	var type = $("#type-" +str[1]).html();
	var date = $("#date-" +str[1]).html();
	//alert(issn);

			$("#isdn").val(issn);
			$("#journal").val(journal);
			$("#type").val(type);
			$("#pubdate").val(date);

	/*$.ajax({

		url: 'uploadPublished.php',
		type: 'POST',
		cache: false,
		data:{
			issn: issn,
			journal: journal,
			type: type,
			date: date,
			book_id: id,
			status: status,
			pub_id:str[0],
			action: "update"
		}, 
			success: function(data){
			alert(data);
			//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
			window.location.reload();
			}
		});*/
});

$("button[id='btn-dis-del[]").click(function(){
	//alert(this.name);
	$.ajax({

				url: 'uploadDisseminated.php?dis-id',
				type: 'POST',
				cache: false,
				data:{
					dis_id:this.name
					
				}, 
				success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
				}

			});
})


var updateDis = "";
$("button[id='btn-dis-edit[]").click(function(){
	var name = this.name;
	var str = name.split("-");
	//alert(str[0] + " " + str[1]);
	var type = $("#dis-type-td-" + str[1]).html();
	var conven = $("#dis-conven-td-" + str[1]).html();
	var disloc = $("#dis-loc-td-"+str[1]).html();
	var date = $("#dis-date-td-" + str[1]).html();

	updateDis = str[0];
	//alert(updateDis);
	//alert(type);
	$("#dis-type").val(type);
	$("#dis-con").val(conven);
	$("#con-ven").val(disloc);
	$("#disdate").val(date);
	$("#instructor-btn-dis-save").text("Update");
	$("#modal-title-dis").html("Update dissemination information");

})


$("button[id='btn-util-del[]").click(function(){
	//alert("delete");
	//alert(this.name);
	//window.location.replace("uploadUtil.php?action=delete&util_id="+ this.name);
	$.ajax({

				url: 'uploadUtil.php?util_id='+ this.name,
				type: 'POST',
				cache: false,
				data:{
					action: "delete"
				}, 
				success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
				}

			});
})


$("button[id='btn-awards-del[]").click(function(){
	//alert("delete");
	//alert(this.name);
	//window.location.replace("uploadUtil.php?action=delete&util_id="+ this.name);
	$.ajax({

				url: 'uploadAwards.php?action=delete&awards_id='+ this.name,
				type: 'POST',
				cache: false,
				data:{
					action: "delete"
				}, 
				success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
				}

			});
			//alert(this.name);
})

$("#btn-util-addnew").click(function(){
	//alert("d");
	$("#instructor-btn-util-save").text("SAVE");
	$("#modal-title-util").html("Add new utilization information");
})


$("#btn-awards-addnew").click(function(){
	//alert("d");
	//$("#instructor-btn-util-save").text("SAVE");
	$("#modal-title-awards").html("Add new awards information.");
})

$("#instructor-btn-wards-save").click(function(){
	var book_id = $("#awards_book_id").val();
	var awards = $("#awards").val();
	var parties = $("#parties").val();
	var awardsloc = $("#awards-loc").val();
	var awardsdesc = $("#awards-desc").val();
	var awardsdate = $("#awards-date").val();
	//alert($("#awards_book_id").val());
	//alert(awards + " " + parties + " " + awardsloc + " " + awardsdesc + " " + awardsdate);
	if(awards==="" || parties==="" + awardsloc==="" || awardsdesc==="" || awardsdate ===""){
		alert("please provide awards information.");
	}else{
		$("#awards-form").ajaxSubmit(
			{
				url: 'uploadAwards.php?action=save',
				type: 'POST',
				success: function(data){
					alert(data);
					window.location.reload();
				}
			 });
	}
})

var util_id_update = "";
$("button[id='btn-util-edit[]").click(function(){
	var name = this.name;
	var str = name.split("-");
	//alert(str[1]);
	var orgname = $("#util-orgname-td-" + str[1]).html();
	var org_address = $("#util-orgadd-td-" + str[1]).html();
	var date = $("#util-date-td-" + str[1]).html();
	//alert(orgname + " " + og)
	var book_id = $("#util_book_id").html();
	var trail_id = $("#util-trail_id").val();
	//alert(trail_id);
	util_id_update = str[0];
	//alert(orgname + " " + org_address + " " + date + " " + book_id + "trail "+ trail_id);
	$("#org-name").val(orgname);
	$("#util-ad").val(org_address);
	$("#util-date").val(date);
	$("#instructor-btn-util-save").text("UPDATE");
	$("#modal-title-util").html("Update utilization information");
	/*$("#util-form").ajaxSubmit(
	{
		url: 'uploadUtil.php?action=edit&util_id=' + str[0],
		type: 'POST',
	success: function(data){
		alert(data);
		window.location.reload();
	}


	});
	
	//alert("delete");
	//alert(this.name);
	//window.location.replace("uploadUtil.php?action=delete&util_id="+ this.name);
	/*$.ajax({

				url: 'uploadUtil.php?util_id='+ this.name,
				type: 'POST',
				cache: false,
				data:{
					action: "delete"
				}, 
				success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
				}

			});*/
})


$("button[id='btn-pub-delete[]").click(function(){
	var name = this.name;
	var str	= name.split("-");
			$.ajax({

				url: 'uploadPublished.php',
				type: 'POST',
				cache: false,
				data:{
					pub_id:str[0],
					history: str[2],
					action: "delete"
				}, 
				success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
				}

			});
})

$("#btn-add-new-pub").click(function(){
	$("#instructor-btn-pub-save").text(" SAVE ");
	//$("#isdn").val();
	//$("#journal").val();
	//$("#type").val();
	//$("#pubdate").val();
	//alert("gggg");
})

$("#instructor-btn-util-save").click(function(){
	//alert("g");
	var book_id = $("#util-book_id").val();
	var trail_id = $("#util-trail_id").val();
	var orgname = $("#org-name").val();
	var org_address = $("#util-ad").val();
	var date = $("#util-date").val();
	var txt = $(this).text();
	//alert(txt);

	//alert(book_id + " " + trail_id + " " + orgname + " " + org_address + " " + " " + date);
	if(orgname==="" || org_address==="" || date===""){
		alert("please provide utilization information.");
	}else{
		if(txt==="SAVE"){
			$("#util-form").ajaxSubmit(
					 {
					 	url: 'uploadUtil.php?action=save',
					 	type: 'POST',
					 	success: function(data){
					 		alert(data);
					 		window.location.reload();
					 	}


					 });
		}else{
			$("#util-form").ajaxSubmit(
					 {
					 	url: 'uploadUtil.php?action=edit&util_id=' + util_id_update,
					 	type: 'POST',
					 	success: function(data){
					 		alert(data);
					 		window.location.reload();
					 	}


					 });
		}
					
		}
})



$("#instructor-btn-dis-save").click(function(){
		var txt = $("#instructor-btn-dis-save").text();
		//alert("!" + txt + "!");
		if(txt=="SAVE"){
			//var book_id = $("#book_id").val();
			//alert(book_id);
			//var title = $("#title").val();
			var status = $("#status").html();
			//alert(status);
			//var cited = $("#cite").val();
			//alert(cited);
			//alert(status);
			if(status=="Disseminated / Presented"){
				var distype = $("#dis-type").val();
				var discon = $("#dis-con").val();
				var conven = $("#con-ven").val();
				var disdate = $("#disdate").val();
				//var discert = $("#dis-cert").val();
				//alert(disdate);

				if(distype=="" || discon=="" || conven=="" || disdate==""){
					 alert("Please provide dissimination information.");
					
				}else{
					//alert("uploading");
					$("#dis-form").ajaxSubmit(
					 {
					 	url: 'uploadDisseminated.php?action=save',
					 	type: 'POST',
					 	success: function(data){
					 		alert(data);
					 		window.location.reload();
					 	}


					 });


					/*$.ajax({

						url: 'savechanges.php',
						type: 'POST',
						cache: false,
						data:{
							book_id: book_id,
							status: status,
							cited: cited,
							date: disdate
						}, 
						success: function(data){
							alert(data);
						}

					})*/
				}


				
				
			
			}
		}else{
			var status = $("#status").html();
			//alert(status);
			//var cited = $("#cite").val();
			//alert(cited);
			//alert(status);
			//alert("Update");
			if(status=="Disseminated / Presented"){
				var distype = $("#dis-type").val();
				var discon = $("#dis-con").val();
				var conven = $("#con-ven").val();
				var disdate = $("#disdate").val();
				//var discert = $("#dis-cert").val();
				//alert(disdate);
//alert('uploadDisseminated.php?action=update&dis_id=' + updateDis);
				if(distype=="" || discon=="" || conven=="" || disdate==""){
					 alert("Please provide dissimination information.");
					
				}else{
					//alert("uploading");
					$("#dis-form").ajaxSubmit(
					 {
					 	url: 'uploadDisseminated.php?action=update&dis_id=' + updateDis,
					 	type: 'POST',
					 	success: function(data){
					 		alert(data);
					 		window.location.reload();
					 	}


					 });


					/*$.ajax({

						url: 'savechanges.php',
						type: 'POST',
						cache: false,
						data:{
							book_id: book_id,
							status: status,
							cited: cited,
							date: disdate
						}, 
						success: function(data){
							alert(data);
						}

					})*/
				}


				
				
			
			}

		}
			
})

$("#instructor-btn-pub-save").click(function(){
	
	var txt = $(this).text();
	//alert("!" + txt + "!");
	if(txt===" SAVE "){
				//alert("hbbg");

			var book_id = $("#book_id").val();
			//alert(book_id);
			//var title = $("#title").val();
			var status = $("#status").html();
			//alert(status);
			//var cited = $("#cite").val();
			//alert(cited);
			//alert(status);
			if(status=="Disseminated / Presented"){
				var distype = $("#dis-type").val();
				var discon = $("#dis-con").val();
				var conven = $("#con-ven").val();
				var disdate = $("#disdate").val();
				//var discert = $("#dis-cert").val();
				//alert(disdate);

				if(distype=="" || discon=="" || conven=="" || disdate==""){
					 alert("Please provide dissimination information.");
					
				}else{
					alert("uploading");
					/*$("#dis-form").ajaxSubmit(
					 {
					 	url: 'uploadDisseminated.php',
					 	type: 'POST',
					 	success: function(data){
					 		alert(data);
					 		//window.location.replace("admindashboard.php");
					 	}


					 });


					$.ajax({

						url: 'savechanges.php',
						type: 'POST',
						cache: false,
						data:{
							book_id: book_id,
							status: status,
							cited: cited,
							date: disdate
						}, 
						success: function(data){
							alert(data);
						}

					})*/
				}


				
				
			
			}else if(status=="Published"){
				//alert("j");
				//var trail_id = $("#trail_id").html();
				//alert(trail_id);
				var issn = $("#isdn").val();
				var journal = $("#journal").val();
				var type = $("#type").val();
				var date = $("#pubdate").val();
				var id = $("#book_id").html();



				if(issn=="" || journal=="" || type=="" || date==""){
					alert("Please provide needed information.");
				}else{
					//alert(issn + " " + journal + " " + type + " " + date + " " + id);
					$.ajax({

						url: 'uploadPublished.php',
						type: 'POST',
						cache: false,
						data:{
							issn: issn,
							journal: journal,
							type: type,
							date: date,
							book_id: id,
							status: status,
							action: "save"
						}, 
						success: function(data){
							alert(data);
							//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
							window.location.reload();
						}

					});

				}
				
			}/*else if(status==""){
				alert("Please choose book status.");
			}else{
				//alert("ggggggg");

					var d = new Date();

					var date = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
					//alert(date);
				$.ajax({

						url: 'savechanges.php',
						type: 'POST',
						cache: false,
						data:{
							book_id: book_id,
							status: status,
							cited: cited,
							date: date
						}, 
						success: function(data){
							alert(data);
						}

					})
					

			}*/
			//alert(title);
		}else{

			


			/*var issn = $("#isdn").val();
			var journal = $("#journal").val();
			var type = $("#type").val();
			var date = $("#pubdate").val();
			var id = $("#book_id").html();
	*/
			
			


			//$("#book_id").html();

			/*$.ajax({

				url: 'uploadPublished.php',
				type: 'POST',
				cache: false,
				data:{
					issn: issn,
					journal: journal,
					type: type,
					date: date,
					book_id: id,
					status: status,
					pub_id:str[0],
					action: "update"
				}, 
					success: function(data){
					alert(data);
					//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
					window.location.reload();
					}
				});*/
				//alert(pub_id);
				var issn = $("#isdn").val();
				var journal = $("#journal").val();
				var type = $("#type").val();
				var date = $("#pubdate").val();
				var pub_id = editstr;
				//var id = $("#book_id").html();
				if(issn=="" || journal=="" || type=="" || date==""){
					alert("Please provide needed information.");
				}else{
					$.ajax({

						url: 'uploadPublished.php',
						type: 'POST',
						cache: false,
						data:{
							issn: issn,
							journal: journal,
							type: type,
							date: date,
							pub_id:pub_id,
							action: "update"
						}, 
							success: function(data){
							alert(data);
							//window.location.replace("admin-view-full-status.php?trail=" + &book_id=1");
							window.location.reload();
							}
						});
					
					

				}
		}
	
})