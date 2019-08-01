<?php $page_title = "Test";


include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");

$helper = new Helper();?>
<!DOCTYPE html>
<html>
<?php
include_once ($helper->getBasePath()."includes/header.php");
session_start();
if(isset($_SESSION['role_id'])) {
    if ($_SESSION['role_id'] == 1) {
        ?>
        <body>
        <?php

        include_once ($helper->getBasePath()."includes/sidenav.php");
        ?>

        <!-- Main content -->
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <?php

            include_once ($helper->getBasePath()."includes/top-nav.php");
            include_once($helper->getBasePath()."includes/header-breadcrums.php");
            ?>

            <!-- Header -->
            <!-- Header -->

            <?php
            /*
             * Checking if initially if someone is coming directly from the link or not
             * */
            if(isset($_GET['subject_id'])){
                    include_once ("pages/test/create_test.php");
            }else if(isset($_GET["source"])){
                /*
                 * Checking what is the source this will
                 * */
                if($_GET["source"] === "display_test" )
                include_once ("pages/test/display_test.php");
            }

            ?>


            <!-- Page content -->

        </div>
        <!-- Argon Scripts -->
        <!-- Core -->
        <?php
        include_once ($helper->getBasePath()."includes/core_scripts.php");
        ?>
        </body>
        <?php
    }//END OF IF
    else{
        include_once ($helper->getBasePath()."includes/no-access.php");
    }
}else {
    include_once ($helper->getBasePath()."includes/no-access.php");
}
?>

</html>