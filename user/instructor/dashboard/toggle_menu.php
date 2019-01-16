<nav class="navbar navbar-expand-lg" style="background: #CDCDD8">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo PROJECT_ROOT; ?>"><i class="fas fa-home fa-lg"></i>&nbsp; Home</a>
                            </li>
                            <li class="nav-item">
                                <!--<i class="fas fa-bell fa-3x nav-link"></i>-->
                                <a class="nav-link viewNotification" href="#" onclick="showDetailedNotification()">
                                      <i class="fas fa-bell fa-lg"></i> 
                                       Notification
                                          <?php  
                                            $stmt = $con->prepare('SELECT `id`, `action`, on_update_author.`book_id`, book.book_title, CONCAT(author.a_fname, " ", SUBSTRING(author.a_mname, 1,1), ". ", author.a_lname, " ", author.a_suffix ) as referer FROM `on_update_author` INNER JOIN book on book.book_id = on_update_author.book_id INNER JOIN author on author.a_id = referer WHERE `author` = ?');
                                            $stmt->bind_param("i", $_SESSION['owner']);
                                            $stmt->execute();
                                            $resultCount = $stmt->get_result();
                                            //$notif = $resultCount->fetch_assoc();
                                            if($resultCount->num_rows>0){
                                                 echo '<span class="badge badge-danger">'. $resultCount->num_rows .'</span>';
                                            }

                                            ?>
                                      
                                </a>
                                <!--<div class="badge badge-success">
                                    You have new notification
                                </div>-->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo PROJECT_ROOT . "logout.php"?>"><i class="fas fa-sign-out-alt fa-lg"></i>&nbsp;Log out</a>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="modal fade" id="modalNotification" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" style="max-width: 720px;">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="modal-fileUpload-title">Author Request:</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body m-2">
                        <div class="container" style="font-size: 11pt;">
                            <?php 

                                if($resultCount->num_rows>0){
                                    while ($notif = $resultCount->fetch_assoc()) {
                                        $action = $notif['action'];
                                        $classType = "";
                                        if($notif['action']==="added"){
                                            $classType = "border-success";
                                        }else if($notif['action']==="remove"){
                                            $classType = "border-danger";
                                        }

                                        echo '<div class="row working-entry border-left ' . $classType . ' pl-4 mt-3" style="border-width: 6px !important;">
                                <div class="col-*-12">
                                    <a href="#"><strong>'. $notif['referer'] .'</strong></a>&nbsp;<em class="bg-info text-white">'. $action .'</em> you as an Author to the research titled <em><strong>Buksu Research Record Management System</strong></em>
                                </div>
                                <div class="col-*-12 pt-1 pb-1">
                                    <button type="button" class="btn btn-outline-success btn-sm btn-confim" onclick=\'working(this, ".btn-cancel","confirm", "#spin", ".working", "server_script/author_request.php", "&param='. $notif['id'] .'&book_id='. $notif['book_id'] .'", ".working-entry")\'>Confirm</button>
                                    <button class="btn btn-outline-danger btn-sm btn-cancel" onclick=\'working(this, ".btn-confim","cancel", "#spin", ".working", "server_script/author_request.php", "&param='. $notif['id'] .'&book_id='. $notif['book_id'] .'", ".working-entry")\'>Cancel</button>
                                    <div class="text working pt-2" style="display: none"><img src="" id="spin" style="max-width: 20px; max-height: 20px;"> Working on it...</div>
                                </div>
                            </div>';
                                    }
                                }else{
                                    echo "No Author Request";
                                }

                            ?>
                            

                        </div>
                        
                    </div>
                      
                    

                  </div>

                </div>
            </div>