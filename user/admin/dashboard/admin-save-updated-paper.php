<?php
	

	if(isset($_POST['trail_id'])){
		$trail_id = $_POST['trail_id'];
		$origin = $_POST['origin'];
		$parts = $_POST['parts'];
		$comments=$_POST['comments'];
		$page = $_POST['page'];

		include_once 'connection.php';
		$dbconfig= new dbconfig();
        $con= $dbconfig -> getCon();
        $query= "INSERT INTO `comments` (`id`, `trail_id`, `parts`, `comments`, `origin`, `page`) VALUES (NULL, '$trail_id', '$parts', '$comments', '$origin', '$page')";
        //echo $query;
        $result = $con -> query($query);
        if($result){
        	echo "success";

        }else{
        	echo "" . mysqli_error($con);
        }
	}
	
?>