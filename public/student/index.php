<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 26-08-2019
 * Time: 16:27
 */

?>

<!DOCTYPE html>
<html>

<?php
    $page_title = "Student";

include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
//include_once("../../helpers/Helper.class.php");

$helper = new Helper();
//    include_once ("../../includes/header.php");
include_once ($helper->getBasePath()."includes/header.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/models/Test.class.php");
session_start();
if(isset($_SESSION['role_id'])) {
    if ($_SESSION['role_id'] == 2) {


        ?>


        <body>
        <!-- Sidenav -->
        <?php  include_once($helper->getBasePath()."includes/sidenav.php"); ?>
        <!-- Main content -->
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <?php
            include_once($helper->getBasePath()."includes/top-nav.php");
               ?>
            <!-- Header -->
            <!-- Header -->
            <div class="header bg-primary pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">

                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">

                                        <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Student</li>
                                    </ol>
                                </nav>
                            </div>

                        </div>

                        <!-- Card stats -->

                        <div class="row owl-carousel owl-dots owl-theme">
                        <?php

                            $test = new Test();
                            $tests = $test->showUpcomingTest($_SESSION['user_id']);
                            for($i = 0;$i< sizeof($tests); $i++){
                                $test_name = $tests[$i]['test_name'];
                                $teacher_id = $tests[$i]['teacher_id'];
                                $duration = $tests[$i]['duration'];
                                $total_marks = $tests[$i]['total_marks'];
                                $subject_id = $tests[$i]['subject'];
                                $start_time = $tests[$i]['start_time'];
                                $end_time = $tests[$i]['end_time'];
                                $teacher_name  = $test->getTeacherName($teacher_id);
                                $first_name = "";
                                $last_name = "";
                                for($i = 0;$i<sizeof($teacher_name);$i++){
                                    $first_name = $teacher_name[$i]['first_name'];
                                    $last_name = $teacher_name[$i]['last_name'];

                                }
                                ?>
                            <div class="">

                                <div class="card card-stats">
                                    <!-- Card body -->

                                    <div class="card-body">

                                        <div class="row">


                                            <div class="col">


                                                <h5 class="card-title text-uppercase text-muted mb-0"><?php echo "By " . $first_name;
                                                    echo " ";
                                                    echo $last_name; ?></h5>
                                                <span class="h2 font-weight-bold mb-0"><?php echo $test_name ?></span>
                                                <div class="h5 font-weight-bold mb-0"><?php echo $total_marks ?>MARKS
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                                    <i class="ni ni-active-40"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-sm text-center">
                                            <?php date_default_timezone_set("Asia/Calcutta");
                                            $date = date('Y-m-d H:i:s:u', time());

                                            if ($start_time <= $date && $end_time >= $date) {
                                                ?>
                                                <button type="button" class="btn btn-outline-primary pl-4 pr-4">Start
                                                </button>
                                            <?php } else {
                                                $start = strtotime($start_time);
                                                $curr_date = date('Y-m-d', time());
                                                $start_date = date('Y-m-d', $start);
                                                if ($curr_date == $start_date) {
                                                    echo "Starts at " . date('h:ia', $start);
                                                } else {
                                                    echo "Starts at " . date("d-M-y h:ia");
                                                }


                                            }


                                            ?>


                                        </p>

                                    </div>

                                </div>

                            </div>

                            <?php }?>

                  </div>


                    </div>

                </div>

            </div>


            <!-- Page content -->
            <div class="container-fluid mt--6">
                <div class="row ">
                    <div class="col-xl-12">
                        <div class="card bg-default">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                                        <h5 class="h3 text-white mb-0">Sales value</h5>
                                    </div>
                                    <div class="col">
                                        <ul class="nav nav-pills justify-content-end">
                                            <li class="nav-item mr-2 mr-md-0" data-toggle="chart"
                                                data-target="#chart-sales-dark"
                                                data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}'
                                                data-prefix="$" data-suffix="k">
                                                <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                                    <span class="d-none d-md-block">Month</span>
                                                    <span class="d-md-none">M</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark"
                                                data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}'
                                                data-prefix="$" data-suffix="k">
                                                <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                                    <span class="d-none d-md-block">Week</span>
                                                    <span class="d-md-none">W</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <!-- Chart -->
                                <div class="chart">
                                    <!-- Chart wrapper -->
                                    <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer -->

            </div>
        </div>


        <!-- Argon Scripts -->
        <!-- Core -->
        <?php

//        include_once("../../includes/core_scripts.php");
        include_once ($helper->getBasePath()."includes/core_scripts.php");
        ?>
        </body>

        <?php
    }//END OF IF
    else {
//        include_once("../../includes/no-access.php");
        include_once ($helper->getBasePath()."includes/no-access.php");
    }

}else{
//        include_once ("../../includes/no-access.php");
    include_once ($helper->getBasePath()."includes/no-access.php");
    }
    ?>

</html>