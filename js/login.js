

$("#submit").click(function() {
  //alert("Hello");
  if ($("#u_name").val()==="" || $("#password").val()==="" ) {
    alert("Please fill all fields!");
  }
  else {
    var uname = $("#u_name").val();
    var upass = $("#password").val();
    //alert(uname + " " + upass);
    //alert(upass);

    $.ajax({
      url:"server_script/validate_login.php",
      type:"POST",
      cache:false,
      data:{
        username:uname,
        password:upass,
      },
      success: function(data) {
        //alert(data);
        var str= data.split(":");
          //alert(str[0]);
          //alert(str[1]);
        if (str[0]==="Success") {
          window.location.replace("index.php");


        }else {
          $(".error-msg").html(str[1]);
          //$(".error-msg").html(data);
          $(".error-msg").show();
        }

      }

    });
  }
})
