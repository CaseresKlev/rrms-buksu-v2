function getMsg(){
          alert("k");
          $.ajax({    //create an ajax request to display.php
            type: "GET",
            url: "getMsg.php?c=" + c + "&l=" + limit + "&o=" + offset,             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                //$("#responsecontainer").html(response); 
                alert(response);
            }

          });           

          
        }

        getMsg(); 