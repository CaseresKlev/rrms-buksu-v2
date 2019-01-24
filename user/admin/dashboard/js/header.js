

$("#searchbtn").click(function(){
	/*if ($(".header_search-container").css("display") == 'none'){
		//alert("true");
		$(".header_search-container").slideDown("slow");
		//
		
	}
	else{
		$(".header_search-container").slideUp("slow");
	}
	*/



	//alert("ggg");
	// Get the modal
var modal = document.getElementById('modal');

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
//btn.onclick = function() {
    modal.style.display = "block";
//}

// When the user clicks on <span> (x), close the modal
//span.onclick = function() {
    //modal.style.display = "none";
//}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



});


$("#btn-search-home").click(function(){
	var skey = $("#skey").val();
	//alert("h");
	//var filterdate = $("#filterdate").val(); 
	//var by = "";



	//alert("Please provide terms to search");

	/*	if($('#search_title').is(':checked')){
		//alert("searct");
		by = "title";
		
		
	}else if($('#search_kw').is(':checked')){
		by = "kw";
	} */


	//var search = "" + skey + "-" + by + "-" + filterdate;

	window.location.replace("searchcontent.php?search="+skey);

	
	
});