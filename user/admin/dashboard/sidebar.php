<?php include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php"); ?>

<nav id="sidebar" style="position: -webkit-sticky; position: sticky; top: 0">
            <div class="sidebar-header">
                <h4>Research Record Mangement System</h4>
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
                    <a href="admindashboard.php">Research
                      <i class="fas fa-circle fa-xs" style="color:red"></i>
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

                    <a href="updateAcc.php" >Account</a>
                </li>
                <li <?php if($cur==="accesscode"){echo 'class="active"';} ?>>
                    <a href="accesscode.php" >Access Codes</a>
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
                <li>
                    <a href="book_reports.php?title=&dept=&status=&author=&from=0&to=2018" target="_blank">Reports</a>
                </li>
                <li <?php if($cur==="post"){echo 'class="active"';} ?>>
                    <a href="post.php">Post</a>
                </li>
            </ul>

        </nav>