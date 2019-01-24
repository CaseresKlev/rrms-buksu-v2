$("#anneselect").click(function(){
    var type=$("#anneselect").val();

      if (type=="Instructor") {
        $(".studiv").hide();
          $("#tblins").show();


      }else {

          $("#tblins").hide();
          $(".studiv").show();
      }
})

function reset(){
  $("#ins_fname").val("");
  $("#ins_mname").val("");
  $("#ins_lname").val("");
  $("#suff").val("");
  $("#ins_email").val("");
  $("#ins_u_name").val("");
  $("#ins_password").val("");
  $("#ins_access").val("");
  $("#g_name").val("");
  $("#stud_u_name").val("");
  $("#stud_password").val("");
  $("#stud_access").val("");
  $("#msg").hide();
}


$("#submit").click(function(){

  //////////////////// FOR STUDENT //////////////////////////////

  var type=$("#anneselect").val();
  if(type=="Student"){
    
    var g_name = $("#g_name").val();
    var uname = $("#stud_u_name").val();
    var upass = $("#stud_password").val();
    var access = $("#stud_access").val();

    //console.log(g_name + " " + uname + " " + upass + " " + access);

    if(g_name=="" || uname=="" || upass=="" || access==""){
      
      $("#msg").html("Please fill all fields!");
      $("#msg").show();
    }else{
      //alert("else");
        $.ajax({
          url:"validateStudentacc.php",
          type:"POST",
          cache:false,
          data:{
            access: access,
            groupname:g_name,
            uname:uname,
            password:upass,

          },
          success: function (data) {
              //alert(data);
              var str=data.split(":");
              //alert(str[0]);
              if (str[0]==="Success") {
                alert(data);

                window.location.replace("new-login.php");
              }else {
                alert(data);
              }
                      //$("#result").html(data);
          }
        });
    }





    ////////////////////// END of STUDENT ACCOUNT ///////////////////////////////

  }else{


    /////////////////// Instructor Account /////////////////////////////////////
    var fname = $("#ins_fname").val();
    var mname = $("#ins_mname").val();
    var lname = $("#ins_lname").val();
    var suf = $("#suff").val();
    if(suf=="Suffix"){
      suf = "";
    }
    var email = $("#ins_email").val();
    var uname = $("#ins_u_name").val();
    var upass = $("#ins_password").val();
    var access = $("#ins_access").val();
    //alert(suf);

    //console.log(fname + " " + mname + " " + lname + " Suf: " + suf + " " + email + " " + uname + " " + upass + " " +access);

    if(fname=="" || mname =="" || lname=="" || email=="" || uname=="" || upass=="" || access==""){
       $("#msg").html("Please fill all fields!");
      $("#msg").show();

    }else{
      //var str2 = "DEFG";
      
      if(email.indexOf("@") != -1){
        
         $.ajax({
          url:"validateinsacc.php",
          type:"POST",
          cache:false,
          data:{
            fname:fname,
            mname: mname,
            lname: lname,
            suf: suf,
            email: email,
            access: access,
            uname:uname,
            upass:upass,

          },
          success: function (data) {
              //alert(data);

              var str=data.split(":");
              //alert(str[0]);
              if (str[0]==="Success") {
                alert(data);

                window.location.replace("new-login.php");
              }else {
                alert(data);
              }
                      //$("#result").html(data);
          }
        });





      }else{
        $("#msg").html("Email not valid!");
        $("#msg").show();
      }

    }

  }

  //////////// END of Instructor Account //////////////////

 
})

$("#clear").click(function(){
  reset();
})

$("#anneselect").change(function(){
  reset();
})



$("#show-password").change(function(){
     //alert("dsgsdd");
     if ($(this).is(':checked')) {
         $(":password").attr("type","text");
     }else {

       $("#stud_password").attr("type","password");
       $("#ins_password").attr("type","password");
        //alert("not check");
     }

});
