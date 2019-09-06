<!DOCTYPE html>
<html>

<?php
    $page_title = "Quiz";
    include_once("../../helpers/Helper.class.php");
    $helper = new Helper();
    include_once ("../../includes/header.php");
    session_start();
    if(isset($_SESSION['role_id'])) {
        if ($_SESSION['role_id'] == 2) {    
?>
        <body>
        <!-- Sidenav -->
        <?php include_once("../../includes/quiz-sidenav.php") ?>
        <!-- Main content -->
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <?php
                include_once ("../../includes/top-nav.php") ;?>
            <!-- Header -->
            <!-- Header -->
            <div class="header bg-primary pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        
                    </div>
                </div>
            </div>
            <!-- Page content -->
            <div class="container-fluid mt--6">
                <div class="row ">
                    <div class="col-xl-12">
                        <div class="card bg-white">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="text-dark mb-0 d-inline">Conducted by Himanshu Thakkar</h5>
                                        <i class="fa fa-angle-right text-dark"></i>
                                        <h5 class="text-dark mb-0 d-inline">Practice Test</h5>
                                        <i class="fa fa-angle-right text-dark"></i>
                                        <h5 class="text-dark mb-0 d-inline">English</h5>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-5">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-header text-center pb-1">
                                                <p class="float-left font-weight-bold text-left">1. What is the full form of HTTP?Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, ullam. Vitae, similique illo fuga error ipsum doloremque, quibusdam facere minima rem dolorum, optio facilis quae quisquam maxime suscipit! Itaque, beatae!</p>
                                                <p class="float-right font-weight-bold">2m</p>
                                                <div class="clearfix"></div>
                                                <img src="https://place-hold.it/800x500" alt="" class="img-responsive">
                                            </div>
                                            <div class="card-body pt-1">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form class="form-select-tiles">
                                                            <div class="inputGroupQuiz">
                                                                <input id="radio_ans_1" name="radio" type="radio"/>
                                                                <label for="radio_ans_1"> 
                                                                <div>
                                                                    <span class="font-weight-bold">a) </span>
                                                                    <p class="d-inline">HyperText proto</p>
                                                                </div>
                                                                </label>
                                                            </div>
                                                            <div class="inputGroupQuiz">
                                                                <input id="radio_ans_2" name="radio" type="radio"/>
                                                                <label for="radio_ans_2"> 
                                                                <div>
                                                                    <span class="font-weight-bold">b) </span>
                                                                    <p class="d-inline">HyperText New Protocol</p>
                                                                </div>
                                                                </label>
                                                            </div>
                                                            <div class="inputGroupQuiz">
                                                                <input id="radio_ans_3" name="radio" type="radio"/>
                                                                <label for="radio_ans_3"> 
                                                                <div>
                                                                    <span class="font-weight-bold">c) </span>
                                                                    <p class="d-inline">HyperText New version 4 protocol</p>
                                                                </div>
                                                                </label>
                                                            </div>
                                                            <div class="inputGroupQuiz">
                                                                <input id="radio_ans_4" name="radio" type="radio"/>
                                                                <label for="radio_ans_4"> 
                                                                <div>
                                                                    <span class="font-weight-bold">d) </span>
                                                                    <p class="d-inline">HyperText protocol</p>
                                                                </div>
                                                                </label>
                                                            </div>                                                                                                                                                                                    
                                                        </form>
                                                    </div>                                                      
                                                </div>                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <?php
                include_once("../../includes/footer.php");
                ?>
            </div>
        </div>
        <!-- Argon Scripts -->
        <!-- Core -->
        <?php
        include_once("../../includes/core_scripts.php");
        ?>
        </body>

    <?php
    }//END OF IF
    else {
        include_once("../../includes/no-access.php");
    }

}else{
        include_once ("../../includes/no-access.php");
    }
    ?>
</html>