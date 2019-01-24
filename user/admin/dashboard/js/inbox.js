var receiver_id ="";
var receiver_name = "";
var visible = false;
var acc_list = [];

$.ajax({
		url:"getaccount.php?action=getname",
		type:"POST",
		cache:false,
		data:{
			
		},
		success:function(data){
			//alert(data);
			if(data==="none"){
				alert("Cannot found Contact");
				//$("#buffer").css("display", "none");
			}else{
				var str = data.split("-");

				for( var i = 0; i<str.length; i++){
					if(str[i]!==""){
						acc_list.push(str[i]);
						//alert(str[i]);
					}
				}
			}
            //$("#removable").remove();
			//alert(data);
            //window.location.reload();
            //$("#messagewindow").html(data);
		}

		});



$("#messagewindow").animate({scrollTop:$("#messagewindow").height()},1000);

window.setInterval(function(){

//alert($("#messagewindow").scrollTop() + " px");
		/*var str = '<div class="row" id="sender" style="width: 80%; ">'
                   + '<div class="col-md-12">'
                    +    '<h5 style="font-weight: bold;">Research Unit</h5>'
                    + '</div>'
                    + '<div class="col-md-12" style="background-color: #00cccc; height: auto; border-radius: 25px;">'
                    +   '<h5>'
                    +        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. '
                    +   '</h5>'
                    +    '<div class="row" style="padding-left: 15px;">'
                    +        'July 15, 2018 5:56PM'
                    +    '</div>'
                    + '</div>'
                + '</div>';
        $("#chat").append(str);
        *///$()
        //alert(receiver_id);

        if(receiver_id!==""){
        	//alert(receiver_id);
        	$.ajax({
		url:"getmsg.php",
		type:"POST",
		cache:false,
		data:{
			receiver_id: receiver_id
		},
		success:function(data){
           $("#buffer").css("display", "none");

			//alert(data);
            //window.location.reload();
            $("#messagewindow").html(data);
            //document.getElementById('messagewindow').scrollTop -= 1000;
            visible = true;
            
		}

	});
        }
        

}, 1000);
		

$("div[id='msg-block[]").mouseover(function(){
	$(this).css("background-color", "#80ffcc");
	//alert('k');
})

$("div[id='msg-block[]").mouseout(function(){
	$(this).css("background-color", "#1affa3");
	//alert('k');
})

$("div[id='msg-block[]").click(function(){

	//alert();
	var name = receiver_id = $(this).attr('name');
	var str = name.split("-");

	 receiver_id = str[0];
	 receiver_name = str[1];
	//alert(receiver_id);
 $("#receiver_id").html(receiver_id);
	//alert('k');
	$("#chat").css("display", "block");
	$("#txt-selcted-contact").css("display", "block");
	$("#msg-msg-list").css("display", "none");
	$("#chat-input").css("display", "block");
	$("#talking-to").html(receiver_name);
	//var test = document.getElementById("messagewindow").scrollHeight;
	//alert(test);
	
	
})





$("#btn-send-msg").click(function(){
	//alert('g');
	var temp = $("#txt-msg").val();
	var msg = "";
	//alert(msg);
	//alert($("#buff-msg").html());
	if(temp!==""){
		
		for (var i = 0; i < temp.length; i++) {
  			if(temp.charAt(i)=="'"){
  				msg = msg + "\\" + temp.charAt(i);
  			}else{
  				msg = msg + temp.charAt(i);
  			}
		}
		//alert(msg);
		
		$("#buff-msg").html(msg);
		$("#buffer").toggle();
		//alert(receiver_id);


		$.ajax({
		url:"sendmsg.php",
		type:"POST",
		cache:false,
		data:{
			receiver: receiver_id,
			msg: msg
		},
		success:function(data){
			//alert(data);
			if(data==="success"){

				//$("#buffer").css("display", "none");
			}
            //$("#removable").remove();
			//alert(data);
            //window.location.reload();
            //$("#messagewindow").html(data);
		}

		});
	}
	$("#txt-msg").val("");
	$('#messagewindow').animate({
        scrollTop: $('#messagewindow')[0].scrollHeight}, 2000);
	
});


$("#contact-selected").click(function(){
	var val = $("#contact-list option:selected").val();
	if(val!==""){
		var tmp = val;
		str = tmp.split("-");
		receiver_name = str[1];
		receiver_id = str[0];
		$("#chat").css("display", "block");
		$("#txt-selcted-contact").css("display", "block");
		$("#msg-msg-list").css("display", "none");
		$("#chat-input").css("display", "block");
		$("#talking-to").html(receiver_name);
	}
})

$("#btn-search-contact").click(function(){
	var contact_search = $("#contact-search").val();
	$.ajax({
		url:"getaccount.php?action=getid&search="+contact_search,
		type:"POST",
		cache:false,
		data:{
			
		},
		success:function(data){
			//alert(data);
			if(data==="none"){
				alert("Cannot found Contact");
				//$("#buffer").css("display", "none");
			}else{
				alert(data);
			}
            //$("#removable").remove();
			//alert(data);
            //window.location.reload();
            //$("#messagewindow").html(data);
		}

		});

})





function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/


autocomplete(document.getElementById("contact-search"), acc_list);





	