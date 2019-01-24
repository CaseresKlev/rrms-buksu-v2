

$("#submit").click(function() {
  alert("Hello");
  if ($("#u_name").val()==="" || $("#password").val()==="" ) {
    alert("Please fill all fields!");
  }
  else {
    var uname = $("#u_name").val();
    var upass = $("#password").val();
    //alert(uname);
    //alert(upass);

    $.ajax({
      url:"validatelogin.php",
      type:"POST",
      cache:false,
      data:{
        username:uname,
        password:upass,
      },
      success: function(data) {
        var str= data.split(":");
          //alert(str[0]);
        if (str[0]==="Success") {
          window.location.replace("index.php");


        }else {
          $("#msg").html(data);
          $("#msg").show();
        }

      }

    });
  }
})
