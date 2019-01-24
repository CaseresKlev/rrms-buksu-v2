<?php
	if(isset($_POST['comments_id']) && $_POST['sender'] && $_POST['action']){
	       
                $action = $_POST['action'];

                if($action==="save"){
                        $sender = $_POST['sender'];
                       if($sender==="admin"){

                        $comments_id = $_POST['comments_id'];
                        $parts = $_POST['parts'];
                        $comments = $_POST['comments'];
                        $page = $_POST['page'];

                        //echo "$sender $parts $comments_id $page";



                        include_once 'connection.php';
                        $dbconfig = new dbconfig();
                        $conn = $dbconfig->getCon();
                        $query = "UPDATE `comments` SET `parts` = '$parts', `comments` = '$comments', `page` = '$page' WHERE `comments`.`id` = $comments_id";
                        //echo $query;
                        $result = $conn->query($query);

                        if($result){
                                echo "Success";
                        }else{
                                echo "" . mysql_error();
                        }

                       }else{

                        $comments_id = $_POST['comments_id'];
                        $page = $_POST['page'];
                        include_once 'connection.php';
                        $dbconfig = new dbconfig();
                        $conn = $dbconfig->getCon();
                        $query = "UPDATE `comments` SET `page` = '$page' WHERE `comments`.`id` = $comments_id";
                        $result = $conn->query($query);

                        if($result){
                                echo "Success";
                        }else{
                                echo "" . mysql_error($conn);
                        }
                       }
                }else{
                        $comments_id = $_POST['comments_id'];
                        include_once 'connection.php';
                        $dbconfig = new dbconfig();
                        $conn = $dbconfig->getCon();
                        $query = "DELETE FROM `comments` WHERE `comments`.`id` = $comments_id";
                        
                        //echo $query;
                        $result = $conn->query($query);
                        if($result){
                                echo "Success";
                        }else{
                                echo "" . mysql_error();
                        }
                }


                

	}else{
                header("Location: admindashboard.php");
        }

?>