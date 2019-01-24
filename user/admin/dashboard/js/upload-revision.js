$("#submit").click(function(){
    //alert('f');
    var fileloc = $("#fileloc").html();
    if(document.getElementById("file").files.length == 0){
      alert("Please Choose File!");
    }else{
      var trail_id = $("#trail_id").html();
      //alert(trail_id);
      //alert(document.getElementById("file").files.length == 0);
      $("#fileForm").ajaxSubmit(

           {
            url: 'upload-revision.php?trail_id=' + trail_id + "&file=" + fileloc,
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
                
                var msg = data.split("-");
                
                if(msg[0]=="#error"){
                  alert(data);
                }else{
                  window.location.reload();
                }


                //alert(msg[1]);

               }
           });
    }
    //e.preventDefault();

});

$("#instructor-btn-dis-save").click(function(){
  var book_id = $("#book_id").html();
        $("#dis-form").ajaxSubmit(
           {
            url: 'instructor-upload-files.php?book_id=' + book_id,
            type: 'POST',
            success: function(data){
              alert(data);
              window.location.reload();
            }


           });
})

$("#change").click(function(){
    //alert('f');
    var fileloc = $("#fileloc").html();
    alert(fileloc);
    if(document.getElementById("file-change").files.length == 0){
      alert("Please Choose File!");
    }else{
      var trail_id = $("#trail_id").html();
      //alert(trail_id);
      //alert(document.getElementById("file").files.length == 0);
      //alert($("#fileForm-change"));
      //alert('upload-revision.php?trail_id=' + trail_id + "&file=" + fileloc + "&action=revise");
      $("#fileForm-change").ajaxSubmit(

           {
            url: 'upload-revision.php?trail_id=' + trail_id + "&file=" + fileloc + "&action=revise",
            type: 'POST',
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
                  alert(data);
                }else{
                  window.location.reload();
                }


                //alert(msg[1]);

               }
           });
    }
    //e.preventDefault();

});

$("#uploadpaper").click(function(){
    //alert('f');
    
    var fileloc = $("#fileloc").html();
    //alert(fileloc);
    if(document.getElementById("file-upload").files.length == 0){
      alert("Please Choose File!");
    }else{
      var trail_id = $("#trail_id").html();
      //alert(trail_id);
      //alert(document.getElementById("file").files.length == 0);
      //alert('upload-revision.php?trail_id=' + trail_id + "&file=" + fileloc + "&action=revise");
      $("#fileForm-upload").ajaxSubmit(

           {
            url: 'upload-revision.php?trail_id=' + trail_id + "&file=" + fileloc + "&action=save",
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
                
                var msg = data.split("-");
                //alert(data);
                if(msg[0]=="#error"){
                  alert(data);
                }else{
                  window.location.reload();
                }


                //alert(msg[1]);

               }
           });
    }
    //e.preventDefault();
  
});



