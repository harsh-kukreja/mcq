<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 27-07-2019
 * Time: 16:27
 */

 $page_title = "Student Details";


    include_once("../../../helpers/Helper.class.php");
    $helper = new Helper();?>
<!DOCTYPE html>
<html>
<?php
include_once ($helper->getBasePath()."includes/header.php");
$helper = new Helper();
session_start();
if(isset($_SESSION['role_id'])) {
    if ($_SESSION['role_id'] == 1) {
        ?>
        <body>
        <?php


        include_once($helper->getBasePath()."includes/sidenav.php"); ?>

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
                                        <li class="breadcrumb-item active" aria-current="page"><?php $page_title; ?></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
           
        </div>
        <!-- Argon Scripts -->
        <!-- Core -->
        <?php include_once($helper->getBasePath()."includes/core_scripts.php") ?>
        </body>
        <?php
    }//END OF IF
    else{
        include_once ($helper->getBasePath()."includes/no-access.php");
    }
}else{
    include_once ($helper->getBasePath()."includes/no-access.php");
}
?>

</html>