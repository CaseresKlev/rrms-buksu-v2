<nav id="sidebar">
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
                <li id="link-myProfile" <?php if($currentDIR==="profile") echo 'class="active"';?> >
                    <a href="<?php echo(PROJECT_ROOT . "user/student/dashboard/profile/") ?>">My Profile
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
                <li <?php if($currentDIR==="research") echo 'class="active"';?>>
                    <a href="<?php echo(PROJECT_ROOT . "user/student/dashboard/research/") ?>">My Research</a>
                </li>
                <li <?php if($currentDIR==="account") echo 'class="active"';?>>
                    <a href="<?php echo(PROJECT_ROOT . "user/student/dashboard/account/") ?>" >My Account</a>
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
                <!--<li>
                    <a href="book_reports.php?title=&dept=&status=&author=&from=0&to=2018" target="_blank">Reports</a>
                </li>
                <li>
                    <a href="dept.php">Department</a>
                </li>-->
            </ul>

        </nav>