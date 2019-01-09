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
                                <a class="nav-link" href="<?php echo PROJECT_ROOT; ?>"><i class="fas fa-home fa-lg"></i></a>
                            </li>
                            <li class="nav-item">
                                <!--<i class="fas fa-bell fa-3x nav-link"></i>-->
                                <a class="nav-link" href="<?php echo PROJECT_ROOT . "user/student/dashboard/author-request/" ; ?>">
                                      <i class="fas fa-bell fa-lg"></i> 
                                          <?php  
                                            $stmt = $con->prepare("SELECT count(`id`) as count FROM `on_update_author` WHERE `author` = ?");
                                            $stmt->bind_param("i", $_SESSION['owner']);
                                            $stmt->execute();
                                            $resultCount = $stmt->get_result();
                                            $notif = $resultCount->fetch_assoc();
                                            if($notif['count']>0){
                                                 echo '<span class="badge badge-danger">'. $notif['count'] .'</span>';
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