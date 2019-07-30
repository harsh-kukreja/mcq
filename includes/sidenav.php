
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="#">
                <img src="<?php echo $helper->getPublic("images/argon/brand/blue.png") ?>" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <?php

                if ($_SESSION['role_id']==1) { ?>
                    <!-- Teacher Nav items -->
                    <ul class="navbar-nav">


                        <li class="nav-item">
                            <a class="nav-link" href="pages/student_details.php">
                                <i class="ni ni-archive-2 text-green"></i>
                                <span class="nav-link-text">Student Details</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-AOA" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-AOA">
                                <i class="ni ni-ungroup text-orange"></i>
                                <span class="nav-link-text">AOA</span>
                            </a>
                            <div class="collapse" id="navbar-AOA">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Create Test</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Reports</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Add Question</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">View All Question</a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-COA" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-COA">
                                <i class="ni ni-ui-04 text-info"></i>
                                <span class="nav-link-text">COA</span>
                            </a>
                            <div class="collapse" id="navbar-COA">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Create Test</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Reports</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Add Question</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">View All Question</a>
                                    </li>


                                </ul>
                            </div>
                        </li>
                    </ul>
                    <?php
                }else if($_SESSION['role_id']==2) {


                    ?>
                    <!-- Student Nav items -->
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-examples">
                                <i class="ni ni-ungroup text-orange"></i>
                                <span class="nav-link-text">COA</span>
                            </a>
                            <div class="collapse" id="navbar-examples">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Practice Quiz</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Reports</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-components" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-components">
                                <i class="ni ni-ui-04 text-info"></i>
                                <span class="nav-link-text">AOA</span>
                            </a>
                            <div class="collapse" id="navbar-components">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Practice Quiz</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Reports</a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="ni ni-archive-2 text-green"></i>
                                <span class="nav-link-text">Report</span>
                            </a>
                        </li>
                    </ul>
                    <?php
                }else if ($_SESSION['role_id']==3) {


                    ?>

                    <!-- Parent Nav items -->
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-COA" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-COA">
                                <i class="ni ni-ungroup text-orange"></i>
                                <span class="nav-link-text">COA</span>
                            </a>
                            <div class="collapse" id="navbar-COA">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">View Report</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-AOA" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-AOA">
                                <i class="ni ni-ui-04 text-info"></i>
                                <span class="nav-link-text">AOA</span>
                            </a>
                            <div class="collapse" id="navbar-AOA">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">View Report</a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="ni ni-archive-2 text-green"></i>
                                <span class="nav-link-text">Report</span>
                            </a>
                        </li>
                    </ul>
                    <?php
                }else if ($_SESSION['role_id']==4) {


                    ?>

                    <!-- Admin Nav items -->
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-student" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-COA">
                                <i class="ni ni-ungroup text-orange"></i>
                                <span class="nav-link-text">Student</span>
                            </a>
                            <div class="collapse" id="navbar-student">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Add a Student</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">View All Students</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-teacher" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-AOA">
                                <i class="ni ni-ui-04 text-info"></i>
                                <span class="nav-link-text">Teacher</span>
                            </a>
                            <div class="collapse" id="navbar-teacher">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Add a Teacher</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">View All Teachers</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-parent" data-toggle="collapse" role="button"
                               aria-expanded="false" aria-controls="navbar-AOA">
                                <i class="ni ni-ui-04 text-info"></i>
                                <span class="nav-link-text">Parent</span>
                            </a>
                            <div class="collapse" id="navbar-parent">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Add a Parent</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">View All Parents</a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                    </ul>
                    <?php
                }else{
                    echo "Session Not set";
                }
                ?>
            </div>
        </div>
    </div>
</nav>