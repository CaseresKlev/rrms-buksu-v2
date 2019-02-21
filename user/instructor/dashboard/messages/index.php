<?php
  $currentDIR = "messages";
  include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");  
  include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/preload.php";
  $currentDIR =  basename(__DIR__);

  

  $dbconfig = new dbconfig();
  $con = $dbconfig ->getCon();
  $query = "SELECT `a_id`, `a_fname`, `a_mname`, `a_lname`, `a_suffix`, `bib`, `a_add`, `a_contact`, `a_email`, `a_pic` FROM `author` WHERE `login` = " . $uid;
  $author = null;
  $result = $con->query($query);
  if($result->num_rows>0){
      $author = $result->fetch_assoc();
      //print_r($author);
  }

  $convo = 0;
  if(isset($_GET['c']) && !empty($_GET['c'])){
    $convo = $_GET['c'];
  }
 
?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard - Messages </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--bootstrap-->
        <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!--<script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.slim.min.js")?> "></script>-->
    <script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1_2.js"); ?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo(PROJECT_ROOT . "css/bootstrap-min-4.1.0.css"); ?>">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/dashboard.css"); ?>">
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/Animate.css"); ?>">
    <!-- scrollbar -->
    <link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/custom_scroll.css"); ?>">

    <script defer src="<?php echo(PROJECT_ROOT . "js/solid.js"); ?>"></script>
    <script defer src="<?php echo(PROJECT_ROOT . "js/fontawesome.js"); ?>"></script>
    <script defer src="<?php echo(PROJECT_ROOT . "js/bootstrap-notify.js"); ?>"></script>
        <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
          position: fixed;
          left: 0px;
          top: 0px;
          width: 100%;
          height: 100%;
          z-index: 9999;;
          background: url(<?php echo PROJECT_ROOT . 'img/loader-64x/Preloader_3.gif'?> ) center no-repeat #fff;
        }
        </style>
</head>
<script type="text/javascript">
          $(window).on('load', function () {
      //alert("Window Loaded");
      // Animate loader off screen
            jQuery(".se-pre-con").hide();
      //$(".se-pre-con").fadeOut("slow");
        });
</script>
<body>

    <!-- Paste this code after body tag -->
    <div class="se-pre-con"></div>
    <!-- Ends -->
	<div class="wrapper">
        <!-- Sidebar  -->
        
         <?php  include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/sidebar.php"  ?>

        <!-- Page Content  -->
        <div id="content">
          <!-- Toggle Menu  -->
            <?php include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/toggle_menu.php"; ?>


           <!---- PLACE YOUR DIVS HERE --->
           <?php include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/messages/ff.php"; ?>

           <!---- AYAW NAG LAPAS DIRI --->
        </div>
    </div>
    <?php //include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/chatbox.php"; ?>

    <!-- Popper.JS -->
    <script src="<?php echo(PROJECT_ROOT . "js/popper.min.js")?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo(PROJECT_ROOT . "js/bootstrap.min-4.1.0.js") ?>"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <div class="d-none notif-message">
      Find out&nbsp;<a class="badge badge-info" href="#" onclick="showDetailedNotification()">Here</a> &nbsp;or click the "Notification" above.<br><br>I got it <span class="badge badge-danger donotshow" onclick="doNotShow()">Do not show next time</span>
    </div>
    

    <script src="<?php echo PROJECT_ROOT . "js/dashboard.js" ?>"></script>
    <?php 
        $query = "SELECT * FROM `notification` where author_id = " . $_SESSION['owner'];
        $result = $con->query($query);
        $notifShowRow = $result->fetch_assoc();
        $showNotif = false;
        if($notifShowRow['isShow']==1){
            $showNotif = true;
        }
        if($resultCount->num_rows>0 && $showNotif){
          echo '<script>

          $(document).ready(function(){
        setTimeout(function() { 
          showNotification("top", "right");
          
          //alert(message);

          
          //showNotification();

          });
        }, 5000); 


          </script>';
        }


       ?>
    <script type="text/javascript">
      //$('#suf').val($('#suf').val());
      var s = $('#suf-val').val();
      $('#suf').val(s).change();
      //alert(s);


      
        

      


    </script>
    <div id="sound"></div>
    <style type="text/css">
      .container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_people:hover{
  cursor: pointer;
}

.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}

.chat_list:hover{
  background-color: #e0ebeb;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}


    </style>
     
     <script type="text/javascript">
      //salert("getMsg.php?c=" + c + "&l=" + limit + "&o=" + offset);
       function getMsg(){
          
          //alert(offset);
          $.ajax({    //create an ajax request to display.php
            type: "GET",
            url: "getMsg.php?c=" + c + "&l=" + limit + "&o=" + offset,             
            dataType: "html",   //expect html to be returned                
            success: function(response){

                $(".msg_history").html(response); 
                //alert(response);
            }

          });           

          
        }

        //getMsg();
        setInterval(function() {
          //alert("j");
          if( c!=0 && c!="" && !isNaN(c)){
            //alert("valid");
            getMsg();
          }
          
        }, 3000);
     </script>
</body>

<script type="text/javascript">
  $(document).ready(function(){
          var pre = 0;
          if(c>0){
            //alert("scroll");
            setInterval(function() {
                if(pre==0){
                  scroll(1000);
                  pre = 1;
                }
              }, 3000);
          }
        });
</script>

<?php
  if(isset($_GET['c']) && !empty($_GET['c'])){
    $query = "UPDATE messages SET `seen` = 1 WHERE `receiver` = ? and `chat_id` = ?;";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $_SESSION['owner'], $_GET['c']);
    if($stmt->execute()){
      //echo '<h1>Success'. $_SESSION['owner'] .'</h1>';
    }else{
      //echo $query;
    }
  }

?>
</html>
