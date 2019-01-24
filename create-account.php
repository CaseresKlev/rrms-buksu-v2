<!DOCTYPE html>
<html>
<head>
	<title>Create Account - RRMS-BUKSU</title>
    <?php
     	include 'includes/path.php';
    	include 'includes/connection.php';
    ?>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--bootstrap-->
<script src="<?php echo(PROJECT_ROOT . "js/jquery-3.3.1.js")?> "></script>

<link rel="stylesheet" type="text/css" href="<?php echo(PROJECT_ROOT . "/css/bootstrap-min-4.1.0.css"); ?>">
<!-- Our Custom CSS -->
<link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "/css/style.css"); ?>">
<link rel="stylesheet" href="<?php echo(PROJECT_ROOT . "css/Animate.css"); ?>">
<script defer src="<?php echo(PROJECT_ROOT . "/js/solid.js"); ?>"></script>
<script defer src="<?php echo(PROJECT_ROOT . "js/bootstrap-notify.js"); ?>"></script>
<!--<script defer src="<?php echo(PROJECT_ROOT . "/js/fontawesome.js"); ?>"></script>-->

    <style>
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;;
  background: url(<?php echo PROJECT_ROOT . 'img/loader-64x/Preloader_3.gif'?>) center no-repeat #fff;
}
</style>

</head>

<body>

	<div class="container shadow p-3 mb-5 bg-white rounded mt-4">

		<form action="server_script/create_account.php" method="POST">
			<?php  
            if(isset($_GET['msg'])){

              $alertType = "info";
              if(isset($_GET['alertType'])){
                $alertType = $_GET['alertType'];
              }
              //echo "$alertType";
              echo '
              <div class="alert alert-'. $alertType .' text-center text-dark rounded mb-3 mx-5" style="">
               <!--<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>-->
               <button type="button" class="close" style="margin-right: 10px;" onclick="this.parentElement.style.display=\'none\'"; aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
               '. $_GET['msg'] .'
           </div>';
            }

           ?>
			<div class="row form-header mx-5 mt-5">
				Create Account - BUKSU-RRMS
			</div>
			<div class="mx-5 mb-3 mt-1 alert alert-info" role="alert">
				<button type="button" class="close ml-auto" onclick="this.parentElement.style.display='none'" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
				<b>Note: </b>Create Account requires access code. Be sure to secure <em class="text-danger">VALID</em> one. <br> If you are a student, ask the access code to your Research Instructors. For Instructors, you can ask the Research Unit for your Access Code. 
				
			</div>
			<div class="mx-5 mt-3">
				<div class="content mb-2 border-bottom-only">
				  	<div class="bg-secondary text-white w-50 pl-2 form-header-2">Access Code</div>
				 </div>
				 <div class="form-row">
				 	<div class="form-group col-md-6">
				      <input type="text" class="form-control" name="access_code" placeholder="Access Code" required>
				    </div>
				 </div>
				 <div class="content mb-2 border-bottom-only">
				  	<div class="bg-secondary mt-3 text-white w-50 pl-2 form-header-2">Login Information</div>
				 </div>
				 <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="inputEmail4">Username <span class="text-danger">*</span></label>
				      <input type="text" class="form-control" id="inputEmail4" name="uname" placeholder="Username" required>
				    </div>
				    <div class="form-group col-md-3">
				      <label for="inputPassword4">Password <span class="text-danger">*</span></label>
				      <input type="password" class="form-control" id="inputPassword4" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z A-Z]).{8,}" title="Should Contain Letters and Numbers. Minimum of 8 characters" name="upass">
				    </div>
				    <div class="form-group col-md-3">
				      <label for="inputPassword5">Confirm Password <span class="text-danger">*</span></label>
				      <input type="password" class="form-control" id="inputPassword5" placeholder="Confirm Password" required pattern="(?=.*\d)(?=.*[a-z A-Z]).{8,}" title="Should Contain Letters and Numbers. Minimum of 8 characters" name="upass2">
				    </div>
				  </div>
				  <div class="content mb-2 border-bottom-only">
				  	<div class="bg-secondary mt-3 text-white w-50 pl-2 form-header-2">Personal Information</div>
				  </div>
				  
				  <div class="form-row">
				  	<div class="form-group col-md-3">
				  		<label for="fname">First Name <span class="text-danger">*</span></label>
				  		<input type="text" name="fname" id="fname" class="form-control" required>
				  	</div>
				  	<div class="form-group col-md-3">
				  		<label for="mname">Middle Name <span class="text-danger">*</span></label>
				  		<input type="text" name="mname" id="mname" class="form-control" required>
				  	</div>
				  	<div class="form-group col-md-3">
				  		<label for="lname">Last Name <span class="text-danger">*</span></label>
				  		<input type="text" name="lname" id="lname" class="form-control" required>
				  	</div>
				  	<div class="form-group col-md-3">
				  		<label for="suf_name">Suffix</label>
				  		<select class="form-control" name="suffix">
				  			<option value=""></option>
				  			<option value="SR.">SR.</option>
				  			<option value="JR.">JR.</option>
				  			<option value="I">I</option>
				  			<option value="II">II</option>
				  			<option value="III">III</option>
				  		</select>
				  	</div>
				  </div>
				  <div class="form-row">
				  	<div class="form-group col-md-6">
				  		<label for="fname">Contact Number <span class="text-danger">*Only administrator can view this number</span></label>
				  		<div class="input-group">
				  			<div class="input-group-prepend">
				  				<div class="input-group-text">09</div>
				  			</div>
				  			<input type="text" name="contact" id="contact" class="form-control" required maxlength="9" minlength="9" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
				  		</div>
				  		
				  		
				  	</div>
				  	<div class="form-group col-md-6">
				  		<label for="fname">Email <span class="text-danger">*</span></label>
				  		<input type="Email" name="email" id="email" class="form-control" required>
				  	</div>
				  </div>
				  <div class="form-group">
				    <label for="inputAddress">Address <span class="text-danger">*</span></label>
				    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St, City" required name="address">
				  </div>
				  <div class="form-row">
				    <div class="form-group col-md-12">
				      <label for="inputCity">About the Author</label>
				      <textarea class="form-control" name="biography"></textarea>
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <div class="form-check">
				      <input class="form-check-input" type="checkbox" id="gridCheck" required>
				      <label class="form-check-label" for="gridCheck">
				        I have read the <a href="#">Terms and Privacy Policy of BUKSU-RRMS</a>
				      </label>
				    </div>
				  </div>
			</div>
			<input type="submit" name="Submit" class="mx-5 btn btn-primary">
			<div class="row form-footer m-5 h-100">
				&nbsp;
			</div>
		</form>
	</div>






</body>
</html>