<?php
  //print_r($_SESSION);

?>

<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <a href="../messages/?k="> <h4>Contacts <span class="badge badge-primary badge-md"><i class="fas fa-sync-alt"></i></span></h4></a>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar" id="search-bar" placeholder="Search" >
                <span class="input-group-addon">
                <button type="button" onclick="filterContact();"><i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
          <div class="inbox_chat">
            <div class="alert alert-info" role="alert">
              Note: You can only view the contacts of all authors associated to all of your researches <em class="bg-danger text-white p-1">with the account type as Instructor or administrator.</em>.
            </div>
            <!--<div class="btn btn-primary" id="scroll">Scroll</div>-->
            <?php
            $contactArray = array();
            $stmt = $con->prepare("SELECT a_id as 'aut_id', a_lname as 'co-authours' FROM `author` WHERE `a_fname` = 'Administrator' and `a_mname` = 'Administrator' and `a_lname` = 'Administrator'");
            $stmt->execute();
            $res = $stmt->get_result();
            if($res->num_rows>0){
              $row = $res->fetch_assoc();
              array_push($contactArray, $row);
            }

            /*
            $stmt = $con->prepare("SELECT DISTINCT(id), a1.a_fname as 'name1', a2.a_fname as 'name2', `author1`, `author2` from chat inner join author a1 on a1.a_id = author1 INNER JOIN author a2 ON a2.a_id = chat.author2 where chat.author1 = ? or chat.author2 = ?");
            $stmt->bind_param("ii", $_SESSION['owner'], $_SESSION['owner']);
            if(!$stmt->execute()){
              echo "Error executing command!";
              exit();
            }

            //

            $res = $stmt->get_result();
            if($res->num_rows>0){
              $i = 0;
              while($row = $res->fetch_assoc()){
                //echo $row['id'] . "\n";
                if($i = 0){
                  //$convo = $row['id'];
                  $i++;
                }
                $convoWith = $row['name1'];
                $convoWithId = $row['author1'];
                if($_SESSION['owner'] == $row['author1']){
                  $convoWith = $row['name2'];
                  $convoWithId = $row['author2'];
                }
                //print_r($row);

                echo '<a href="?c='. $row['id'] .'">
              <div class="chat_list '; 
              if($convo == $row['id']){
                echo "active_chat";
              }

              echo'">
                <div class="chat_people">
                  <div class="chat_img">
                    <img src="'. PROJECT_ROOT .'img/user-profile.png" alt="sunil">
                  </div>
                  <div class="chat_ib h5">
                    '. $convoWith .'
                  </div>
                </div>
              </div>
            </a>';
                //echo "CONVO with: " . $convoWith . " ID: " . $row['id'];
              }
            }
            

  */
          ?>

          <?php
          //$query = 'SELECT DISTINCT(jb2.aut_id), CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1,1), ". ", author.a_lname, " ", author.a_suffix ) as "co-authours" FROM junc_authorbook jb1 JOIN junc_authorbook jb2 on jb2.book_id = jb1.book_id join author on author.a_id = jb2.aut_id WHERE jb1.aut_id = ? and jb2.aut_id != ?';
            $query = 'SELECT DISTINCT(jb2.aut_id), CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1,1), ". ", author.a_lname, " ", author.a_suffix ) as "co-authours" FROM junc_authorbook jb1 JOIN junc_authorbook jb2 on jb2.book_id = jb1.book_id join author on author.a_id = jb2.aut_id JOIN account on account.id = author.login WHERE jb1.aut_id = ? and jb2.aut_id != ? and account.type = "INSTRUCTOR"';

            if(!isset($k) && !empty($_GET['k'])){
              $query = 'SELECT DISTINCT(jb2.aut_id), CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1,1), ". ", author.a_lname, " ", author.a_suffix ) as "co-authours" FROM junc_authorbook jb1 JOIN junc_authorbook jb2 on jb2.book_id = jb1.book_id join author on author.a_id = jb2.aut_id JOIN account on account.id = author.login WHERE jb1.aut_id = ? and jb2.aut_id != ? and account.type = "INSTRUCTOR" and (author.a_fname like ? or author.a_lname like ?)';
            }

            $stmt = $con->prepare($query);

            if(!isset($k) && !empty($_GET['k'])){
              $cf = "%". $_GET['k'] ."%";
              $stmt->bind_param("iiss", $_SESSION['owner'], $_SESSION['owner'], $cf, $cf);
            }else{
              $stmt->bind_param("ii", $_SESSION['owner'], $_SESSION['owner']);
            }

            
            $stmt->execute();
            $res = $stmt->get_result();
            if($res->num_rows>0){
              while($coAuthors = $res->fetch_assoc()){
                array_push($contactArray, $coAuthors);

               

              }
            }


            $query = "SELECT DISTINCT(m1.sender), (SELECT COUNT(id) from messages m2 where m2.sender = m1.sender and m2.seen = 0 and m2.receiver = ?) as 'msgcount' from messages m1 WHERE m1.receiver = ? and m1.seen = 0";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ii", $_SESSION['owner'], $_SESSION['owner']);
            $stmt->execute();
            $res = $stmt->get_result();
            $unreadSender = array();
            $unreadCount = array();
            if($res->num_rows>0){
              while($row = $res->fetch_assoc()){
                array_push($unreadSender, $row['sender']);
                array_push($unreadCount, $row['msgcount']);
              }
            }


            //print_r($unreadSender);
            //print_r($unreadCount);

            $finalContact = array();
            foreach ($contactArray as $key) {
              if(in_array($key['aut_id'], $unreadSender)){
                $index = array_search($key['aut_id'], $unreadSender);
                $tempArray =  array($key['aut_id'], $key['co-authours'], $unreadCount[$index]);
              }else{
                $tempArray =  array($key['aut_id'], $key['co-authours'], 0);
              }
              array_push($finalContact, $tempArray);
            }


            $msgCount  = array_column($finalContact, 2);
            array_multisort($msgCount, SORT_DESC, $finalContact);
            
            foreach ($finalContact as $key) {
              echo '
              <div class="chat_list ';
              $convo = 0;
              if(isset($_GET['s']) && !empty($_GET['s'])){
                $convo = $_GET['s'];
              }
              if($convo == $key[0] ){
                echo 'active_chat';
              }
              echo '">';
              echo'
                <div class="chat_people" onclick="getConvo('.$key[0].')">
                  <div class="chat_img">
                    <img src="'. PROJECT_ROOT .'img/user-profile.png" alt="sunil">
                  </div>
                  <div class="chat_ib h5">

                    '. $key[1];

                    if($key[2]>0){
                      $viewingConvo = 0;
                      //echo "<h1>". $key['aut_id'] ." " . $viewingConvo . "</h1>";
                      if(isset($_GET['s']) && !empty($_GET['s'])){
                        $viewingConvo = $_GET['s'];
                      }

                      if($viewingConvo!=$key[0]){

                        echo ' <span class="badge badge-danger">'. $key[2] .'</span>';
                      }
                    }

                     echo '</div>
                </div>
              </div>
            ';
            }

            /*foreach ($contactArray as $key) {
               echo '
              <div class="chat_list '; 
              $convo = 0;
              if(isset($_GET['s']) && !empty($_GET['s'])){
                $convo = $_GET['s'];
              }
              if($convo == $key['aut_id'] ){
                echo 'active_chat';
              }
              echo '">';
              echo'
                <div class="chat_people" onclick="getConvo('.$key['aut_id'].')">
                  <div class="chat_img">
                    <img src="'. PROJECT_ROOT .'img/user-profile.png" alt="sunil">
                  </div>
                  <div class="chat_ib h5">

                    '. $key['co-authours']; 

                    if(in_array($key['aut_id'], $unreadSender)){
                      $index = array_search($key['aut_id'], $unreadSender);
                      //echo $index;
                      $viewingConvo = 0;
                      //echo "<h1>". $key['aut_id'] ." " . $viewingConvo . "</h1>";
                      if(isset($_GET['s']) && !empty($_GET['s'])){
                        $viewingConvo = $_GET['s'];
                      }

                      if($viewingConvo!=$key['aut_id']){

                        echo ' <span class="badge badge-danger">'. $unreadCount[$index] .'</span>';
                      }
                       
                    }

                    

                    
                      //echo' <span class="badge badge-danger">1</span>';
                    

                    
                  echo '</div>
                </div>
              </div>
            ';
            }*/

            //print_r($contactArray);
            

          ?>
            <!--<div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
                  <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                </div>
                <div class="chat_ib">
                  <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                </div>
              </div>
            </div>-->
          </div>
        </div>
        <div class="mesgs">
          <?php $c_id = 0; ?>
            <input type="number" class="d-none" readonly id="c" value="<?php echo $c_id; ?>">
            <input type="number" class="d-none" readonly id="cw" value="<?php //echo $convoWithId ?>">
            <div class="mb-2" style="border-bottom: 1px solid black">

              <?php
                $stmt = $con->prepare("SELECT (CASE WHEN c1.author1 = ? THEN (SELECT author.a_fname FROM author where author.a_id = c1.author2) ELSE (SELECT author.a_fname FROM author where author.a_id = c1.author1) end) as 'sender' FROM `chat` c1 WHERE c1.id = ?");
                $stmt->bind_param("ii", $_SESSION['owner'], $_GET['c']);
                $stmt->execute();
                $res = $stmt->get_result();
                $row = $res->fetch_assoc();

              ?>
              <h3>Conversation with <?php echo $row['sender']; ?></h3>
            </div>
           <div class="row btn btn-secondary w-100 mb-3" id="prevMsg" onclick="ShowPrevMsg()"><span class="h6"> View previous messages. </span></div>
          <div class="msg_history">
            <?php
              if(!isset($_GET['c']) || empty($_GET['c'])){
                echo '<div class="alert alert-info">
              Please choose Conversation to view messages.
            </div>';
              }
            ?>
            
            <?php
              date_default_timezone_set('Asia/Manila');
              $offset = 0;
              //
              $convoFound = false;
              if(isset($_GET['c']) && !empty($_GET['c'])){
                echo '<div class="alert alert-info">
              <img src="'. PROJECT_ROOT . "img/loader-32x/loader2.gif" . '" class="pr-2">
            Fetching Messages... Please wait..</div>';
                $c_id = $_GET['c'];
                $stmt = $con->prepare("SELECT COUNT(id) as 'count' FROM `messages` WHERE `chat_id` = ?");
                $stmt->bind_param("i", $_GET['c']);
                $stmt->execute();
                $res = $stmt->get_result();
                $m_count = $res->fetch_assoc();
                
                $limit = 20;
                $offset = $m_count['count'] - $limit;
                if(isset($_GET['o']) && !empty($_GET['o'])){
                  $offset = $_GET['o'] - $limit;
                }
                if($offset<0){
                  $offset = 0;
                }
                //echo $offset;
                //exit();
                //exit();
                //$query = "SELECT * FROM `messages` WHERE `chat_id` = ? limit $limit offset $offset";
                //echo $query;
                //
                //echo '<input type="text" class="d-none" readonly id="q" value="'. $query .'">';
                echo '<input type="number" class="d-none" readonly id="limit" value="'. $limit .'">';
                echo '<input type="text" class="d-none" id="offset" readonly value="';  

                if(isset($_GET['o']) && !empty($_GET['o'])){
                  //$offset;
                  echo $_GET['o'];
                }else{
                  echo "";
                }
                

                echo'">';
                $ssender = 0;
                if(isset($_GET['s']) && !empty($_GET['s'])){
                  $ssender = $_GET['s'];
                }
                echo '<input type="text" class="d-none" id="sender" readonly value="'. $ssender .'">';
                
                 /*
                $stmt = $con->prepare($query);
                //print_r($stmt);
                //exit();
                $stmt->bind_param("i", $_GET['c']);
                if(!$stmt->execute()){
                  echo '<div class="alert alert-warning">Nothing to show.</div>';
                }
               
                $res = $stmt->get_result();
                if($res->num_rows>0){
                  while ($row = $res->fetch_assoc()) {
                    $date = strtotime(date($row['date']));
                    $current = strtotime(date("Y-m-d"));
                    

                    $datediff = $date - $current;
                    $difference = floor($datediff/(60*60*24));

                    if($row['receiver'] == $_SESSION['owner']){
                      echo '<div class="incoming_msg mb-4">
              <div class="incoming_msg_img"> <img src="'. PROJECT_ROOT .'img/user-profile.png" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>'. nl2br($row['msg'])  .'</p>
                  ';

                  
                  
                   if($difference==0){
                      echo '<span class="time_date"> '. date('h:i:s a ', strtotime($row['date']
)) .'    |     Today</span>';
                   }
                   else if($difference < -1){
                      echo '<span class="time_date"> '. date('h:i:s a | F j, Y', strtotime($row['date']
)) .'</span>';
                   }else{
                      echo '<span class="time_date"> '. date('h:i:s a', strtotime($row['date']
)) .'    |     Yesterday</span>';
                   } 
                  echo'</div>
              </div>
            </div>';
                    }else{
                      echo '<div class="outgoing_msg">
              <div class="sent_msg">
                <p>'. $row['msg'] .'</p>';
                if($difference==0){
                      echo '<span class="time_date"> Sent '. date('h:i:s a ', strtotime($row['date']
)) .'    |     Today</span>';
                   }
                   else if($difference < -1){
                      echo '<span class="time_date"> Sent '. date('h:i:s a | F j, Y', strtotime($row['date']
)) .'</span>';
                   }else{
                      echo '<span class="time_date"> Sent '. date('h:i:s a', strtotime($row['date']
)) .'    |     Yesterday</span>';
                   }
                
            echo'</div></div>';
                    }
                  }
                }else{
                  echo '<div class="alert alert-warning">No Messages.</div>';
                }
              }
              */
              //echo "";
              }
            ?>

            
            
          



          
        </div>
        <div class="row btn btn-secondary w-100 mb-3" id="lastMsg" onclick="ShowLastMsg()"><span class="h6"> View Latest messages. </span></div>
        <div class="type_msg">
            <div class="input_msg_write mt-2">
              <div class="input-group">
                <textarea class="form-control" cols="50" rows="2" placeholder="Type a message" id="txtMsg"></textarea>
                <div class="input-group-prepend badge">
                  <button class="btn btn-outline-primary rounded-circle" onclick="sendMsg(this)"><i class="fas fa-paper-plane fa-lg"></i></button>
                  
                </div>
              </div>
            </div>
          </div>
      </div>
      <input type="number" name="owner" id="owner" value="<?php echo $_SESSION['owner'] ?>" readonly class="d-none">
      <input type="number" name="owner" id="receiver" value="" readonly class="d-none">
      <script type="text/javascript">
        $('#c').val(<?php echo $c_id; ?>);
        //alert("C: " + $('#c').val() + " limit: " + $('#limit').val() + " offset: " + $('#offset').val());
        var c = $('#c').val();
        var limit = $('#limit').val();
        var offset = $('#offset').val();
        var sender = $('#sender').val();
        $('#receiver').val(sender);
        function ShowPrevMsg(){
          var add = location.protocol + '//' + location.host + location.pathname;
          //alert(add);

          window.location.href = add + "<?php if(isset($_GET['c']) && !empty($_GET['c'])) echo '?c=' . $_GET['c'] . '&o='; 

          if($offset - 20 >0){echo ($offset-20);}else{echo '0';} 


            ?>" + "&s=" + sender;

        }
        //$('#prevMsg').hide();

        <?php

          if($offset == 0){
            echo "$('#prevMsg').hide();";
          }
        ?>

        <?php
          if(!isset($_GET['o']) || empty($_GET['o'])){
            echo "$('#lastMsg').hide();";
          }
        ?>

        function ShowLastMsg(){
          var add = location.protocol + '//' + location.host + location.pathname;
          window.location.href = add + "<?php if(isset($_GET['c']) && !empty($_GET['c'])) echo '?c=' . $_GET['c']; ?>" + "&s=" + sender;
        }

        function sendMsg(senderObg){
          if($('#txtMsg').val()==""){
            alert("Message is Empty!");
            return;
          }

          $(senderObg).attr('disabled', true);
          $('#txtMsg').attr('disabled', true);
          //alert("k");
          //alert($('#txtMsg').val());
          $(senderObg).html('<img src="<?php echo PROJECT_ROOT . "img/loader-32x/loader2.gif" ?>">');

          var c_id = $('#c').val();
          var msg = $('#txtMsg').val();
          var r = $('#receiver').val();
          //alert(r);
          //return;
          //ughjkn
          $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "sendMsg.php", 
            data:{
              c_id: c_id,
              msg: msg,
              r:r
            },            
            dataType: "html",   //expect html to be returned                
            success: function(response){

                //$(".msg_history").html(response); 
                //alert(response);
                if(response=="success"){
                  
                  
                  $(senderObg).attr('disabled', false);
                  $(senderObg).html('<i class="fas fa-paper-plane fa-lg"></i>');
                  $('#txtMsg').val("");
                  $('#txtMsg').attr('disabled', false);
                  scroll(1000);
                  //alert("j");
                }
                //alert(response);
            }

          }); 


        }

        function scroll(time){
          //alert("k");
          $('.msg_history').animate({scrollTop: $('.msg_history').get(0).scrollHeight}, time); 
        }


        $('.incoming_msg').hover(function(){
          alert("l");
        })
        
        $("#clickableMSG" ).click(function() {
          //$( this ).fadeOut( 100 );
          //$( this ).fadeIn( 500 );
          alert("o");
        });

        
        function showDetails(sender){
          //$(sender).hide();
        }

        $('.chat_peopled').click(function(){
          alert('k');
        })

        function getConvo(senderID){
         // alert("j");
          //return;
          //var owner = $('#owner').val();
          $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "getconvo.php", 
            data:{
              sender: senderID,
            },            
            dataType: "html",   //expect html to be returned                
            success: function(response){
              //var
              var res = response.split(":");
              if(res[0]=="success"){
                var add = location.protocol + '//' + location.host + location.pathname;
                window.location.replace(add + res[1]);
              }else{
                alert(response);
              }
              
            }

          }); 

        }

        function filterContact(){
          var add = location.protocol + '//' + location.host + location.pathname;
          var k = $('#search-bar').val();
          window.location.replace(add + "?k=" + k);
        }



        $('#search-bar').keypress(function(event){
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            filterContact(); 
          }
        });
        


        

      </script>
      