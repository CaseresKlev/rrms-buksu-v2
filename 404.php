<!DOCTYPE html>
<html>
<head>
    <title>RRMS-Post</title>
    <?php
        include ($_SERVER["DOCUMENT_ROOT"] . '/rrms-buksu/includes/header.php');
    ?>
</head>
<body>

    <div class="container">
        <div class="row" id="fa-container">
                 <i class="fas fa-frown" id="sad-face" ></i>
           
        </div>
        <center>
            <?php
            $msg = "The page you are looking for is not Found on this Server!";
            if(isset($_GET['msg']) && !empty($_GET['msg'])){
                $msg = $_GET['msg'];
            }

            ?>
            <div class="alert alert-danger h1 m-3">
                <h1>404<br></h1>
                <?php echo $msg?>
            </div>
            <div class="btn btn-primary mb-3" onclick="goBack()">
                Go back Here
            </div>
            	

        </center>
        
    </div>

    <script>
	function goBack() {
    	window.history.go(-2);
    	//alert("jjj");
	}
</script>
<?php
        include $_SERVER['DOCUMENT_ROOT'] . '/rrms-buksu/includes/footer.php';
    ?>
</body>
</html>