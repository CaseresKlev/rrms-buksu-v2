$("#submit").click(function(){

    if(document.getElementById("file").files.length == 0){
      alert("Please Choose File!");
    }else{
      alert("Book id:" + $("#bookid").val());
      $("#fileForm").ajaxSubmit(

           {
            url: 'upload.php',
            type: 'post',
            beforeSend:function()
               {
                //$("#prog").show();
                //$("#prog").attr('value','0');

               },
               uploadProgress:function(event,position,total,percentCompelete)
               {
                  //$("#prog").attr('value',percentCompelete);
                   //$("#percent").html(percentCompelete+'%');
               },
               success:function(data){
                //$("#log").html(data);
                //$("#content").html(data);
                //alert(data);
                var msg = data.split("-");
                //alert(data);
                if(msg[0]=="#error"){
                  $(msg[0]).html(msg[1]);
                  $(msg[0]).fadeIn();
                  $(msg[0]).fadeOut(3000);
                }else{
                  window.location.href = "index.php";
                }


                //alert(msg[1]);

               }
           });
    }
    //e.preventDefault();

});


function startIndexing(fileLocation){


}
