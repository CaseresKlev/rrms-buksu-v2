$("#entry").on('submit',(function(e) {
    e.preventDefault();
    $.ajax({
        url: "handler.php",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            console.log(data);
        }           
    });
}));