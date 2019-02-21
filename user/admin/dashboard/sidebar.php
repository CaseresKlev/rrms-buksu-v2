<?php
    if(!$loaded){

        include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");
    } 

?>

<nav id="sidebar" style="position: -webkit-sticky; position: sticky; top: 0">
            <div class="sidebar-header">
                <h5>Research Record Mangement System</h5>
            </div>
            <div class="sidebar-header">
                <i class="fas fa-user-circle fa-3x"></i>
                <span style="position: absolute; margin-left: 10px">
                  <h5 style="color: #BDB5B5"><?php echo strtoupper($accname) ?></h5>
                  <h6> <?php echo strtoupper($acctype) ?></h6>
                </span>
            </div>
            <ul class="list-unstyled components" style="margin-left: 10%">
                <li  <?php if($cur==="research"){echo 'class="active"';} ?>>
                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/admindashboard.php' ?>">Research
                      
                    </a>

                    <!--<ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>-->
                </li>
                <li <?php if($cur==="account"){echo 'class="active"';} ?> >

                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/updateAcc.php'; ?>" >Account</a>
                </li>
                <li <?php if($cur==="accesscode"){echo 'class="active"';} ?>>
                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/accesscode.php'; ?>" >Access Codes</a>
                    <!--<ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>-->
                </li>
                <li <?php if($cur==="post"){echo 'class="active"';} ?>>
                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/post.php'; ?>">Post</a>
                </li>
                <li>
                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/book_reports.php?title=&dept=&status=&author=&from=0&to=2018';?>" target="_blank">Reports</a>
                </li>
                
            </ul>
            <ul class="list-unstyled " style="margin-left: 10%">
                <li <?php if($cur==="add-completed"){echo 'class="active"';} ?>>
                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/paper/add-completed/';?>" >Add Completed Paper</a>
                </li>
                <li <?php if($cur==="dissemination"){echo 'class="active"';} ?>>
                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/paper/dissemination/';?>" >Dissemination</a>
                </li>
                <li <?php if($cur==="publication"){echo 'class="active"';} ?>>
                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/paper/publication/';?>" >Publication</a>
                </li>
                <li <?php if($cur==="utilization"){echo 'class="active"';} ?>>
                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/paper/utilization/';?>" >Utilization</a>
                </li>
                <li>
                    <a href="<?php echo PROJECT_ROOT . 'user/admin/dashboard/paper/rewards/';?>" >Rewards</a>
                </li>
            </ul>
        </nav>