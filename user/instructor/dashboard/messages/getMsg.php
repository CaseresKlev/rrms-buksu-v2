<?php

	//session_start();
	include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
	include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/preload.php";
	if(!(isset($_SESSION['uid']))){
		exit();
	}

	if(!(isset($_GET['c']) && !empty($_GET['c']))){
		exit();
	}
	$c_id = $_GET['c'];
	$offset = 0;
	$limit = 0;

	if(isset($_GET['l']) && !empty($_GET['l'])){
		$limit = $_GET['l'];
	}

  $dbconfig = new dbconfig();
    $con = $dbconfig->getCon();

	if(isset($_GET['o']) && !empty($_GET['o'])){
		$offset = $_GET['o'];
	}else{
    $stmt = $con->prepare("SELECT COUNT(id) as 'count' FROM `messages` WHERE `chat_id` = ?");
    $stmt->bind_param("i", $c_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $m_count = $res->fetch_assoc();
    
    $limit = 20;
    $offset = $m_count['count'] - $limit;
    if($offset<0)
      $offset = 0;
  }

  //print_r($_GET);
	 
	

	$query = "SELECT * FROM `messages` WHERE `chat_id` = ? order by (date) ASC limit $limit offset $offset";
	//echo $query;
  //exit();
	$stmt = $con->prepare($query);
        //print_r($stmt);
        //exit();
        $stmt->bind_param("i", $_GET['c']);
        if(!$stmt->execute()){
          echo '<div class="alert alert-warning">Nothing to show.</div>';
        }
       
        $res = $stmt->get_result();
        $indicator = 0;
        $loaded = 0;
        $cDate = "";
        if($res->num_rows>0){
          while ($row = $res->fetch_assoc()) {
            $date = strtotime(date($row['date']));
            $current = strtotime(date("Y-m-d"));
            

            $datediff = $date - $current;
            $difference = floor($datediff/(60*60*24));


            
            echo '<p class="text-center h6">'; 
            if($difference==0){
            	if($indicator!=0){
           			$indicator = 0;
           			$loaded = 0;
           		}

            	if($loaded == 0 && $indicator == 0){
            		echo '<span class="time_date">----- Today -----</span>';
            		$loaded = -5;
            	}
              
           }
           else if($difference < -1){
           		$baseDate = date('F j, Y', strtotime($row['date']));
           		//echo $baseDate;
           		if($indicator!=-1){
           			$indicator = -1;
           			//$loaded = 0;
           			//$cDate = $baseDate;
           			
           		}
           		//echo " BDATE: $baseDate || CDATE: $cDate";

           		if($indicator == -1 && $baseDate!=$cDate){

           			echo '<span class="time_date">----- '. $baseDate .' -----</span>';
           			//$loaded = -5;
           			$cDate = $baseDate;
           		}

              /*echo '<span class="time_date"> '. date('h:i:s a | F j, Y', strtotime($row['date']
)) .'</span>';*/
           }else{
              //echo '<span class="time_date">----- dawaYesterday -----</span>';
           		if($indicator!=-2){
           			$indicator = -2;
           			$loaded = 0;
           		}
           		
           		if($loaded == 0 && $indicator == -2){
           			echo '<span class="time_date">----- Yesterday -----</span>';
           			$loaded = -5;
           		}
              
           } 


            echo'</p>';





            if($row['receiver'] == $_SESSION['owner']){
              echo '<div class="incoming_msg mb-4 mt-3">
      <div class="incoming_msg_img "> <img src="'. PROJECT_ROOT .'img/user-profile.png" alt="sunil"> </div>
      <div class="received_msg">
        <div class="received_withd_msg bg-warning" id="clickableMSG" onclick="showDetails(this)">
          <p>'. nl2br($row['msg']);  


          echo '<span class="time_date pt-1"> '. date('h:i:s a ', strtotime($row['date']
)) .'</span>';

          echo'</p>
          ';

          
          
          /* if($difference==0){
              echo '<span class="time_date d-none"> '. date('h:i:s a ', strtotime($row['date']
)) .'    |     Today</span>';
           }
           else if($difference < -1){
              echo '<span class="time_date d-none"> '. date('h:i:s a | F j, Y', strtotime($row['date']
)) .'</span>';
           }else{
              echo '<span class="time_date d-none"> '. date('h:i:s a', strtotime($row['date']
)) .'    |     Yesterday</span>';
           } */
          echo'</div>
      </div>
    </div>';
            }else{
              echo '<div class="outgoing_msg">
      <div class="sent_msg">
        <p>'. $row['msg']; 


        echo '<span class="time_date pt-1 text-white"> '. date('h:i:s a ', strtotime($row['date']
)); 
        if($row['seen']!==0){
        	echo "   | Seen";
        }
        echo '</span>';


        echo'</p>';

        /*
        if($difference==0){
              echo '<span class="time_date d-none"> Sent '. date('h:i:s a ', strtotime($row['date']
)) .'    |     Today</span>';
           }
           else if($difference < -1){
              echo '<span class="time_date d-none"> Sent '. date('h:i:s a | F j, Y', strtotime($row['date']
)) .'</span>';
           }else{
              echo '<span class="time_date d-none"> Sent '. date('h:i:s a', strtotime($row['date']
)) .'    |     Yesterday</span>';
           }*/
        
    echo'</div></div>';
            }
          }
        }else{
          echo '<div class="alert alert-warning">No Messages.</div>';
        }
      



?>