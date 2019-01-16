<?php
	session_start();
	if(isset($_SESSION)){
		session_unset();
  		session_destroy(); 
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>RRMS-Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" type="text/css" href="css/bootstrap-min-4.1.0.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="row error-msg">
			Your Username and password is not correct! Try again.
		</div>
	</div>
		<div class="form-group login-form">
			<div class="container">
				<div class="row form-header" >
					<b>BukSU-RRMS</b>
				</div>
			</div>
			<div class="container">
				<div class="row txt-userLogin" >
					<b>User Login</b>
				</div>
			</div>
			
				<form style="padding: 10px;">		
					<div class="form-group">
					    <label for="exampleInputEmail1">Username</label>
					    <input type="text" class="form-control" id="u_name" aria-describedby="emailHelp" placeholder="Enter username">
					 </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="password" placeholder="Password">
					    <div class="form-check">
					    	<center>
					    	<label for="show-password" class="field-toggle">
								<input type="checkbox" id="show-password" onclick="showPass();" class="field-toggle-input" />Show password
        					</label>
        					</center>
					  	</div>
					  </div>
					  
					  <button type="button" class="btn btn-primary" id="submit" style="width: 100%">Submit</button>
				</form>
			<center><a href="#"><small class="text-center">Create New Account</small></a></center>
		</div>
	<script>

        function showPass()
        {
          var password = document.getElementById('password');
          //alert(password.va);
          if (document.getElementById('show-password').checked)
          {
            password.setAttribute('type','text');

          }else{

              password.setAttribute('type','password');
          }



        }

      </script>
	
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/bootstrap.min-4.1.0.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
</body>
</html>