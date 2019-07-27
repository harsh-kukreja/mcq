<?php $page_title = "Students";


include_once("../../helpers/Helper.class.php");

$helper = new Helper();?>
<!DOCTYPE html>
<html>
<?php
include_once ("../../includes/header.php");
session_start();
if(isset($_SESSION['role_id'])) {
    if ($_SESSION['role_id'] == 4) {
        ?>
        <body>
        <?php

        include_once ("../../includes/sidenav.php");
        ?>

        <!-- Main content -->
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <?php

            include_once ("../../includes/top-nav.php");
            include_once("../../includes/header-breadcrums.php");
            ?>

            <!-- Header -->
            <!-- Header -->

            <?php
            if(isset($_GET['source'])){
//                echo $_GET['source'];
                $source = $_GET['source'];
            }else{
                $source="";
            }
            switch($source){
                case "add_student":
                    include_once ("pages/student/add-student.php");
                    break;
                case "edit_student":
                    include_once ("pages/student/edit-student.php");
                    break;
               case "delete_student":
                    include_once ("pages/student/delete-student.php");
                    include_once ("pages/student/view-all-students.php");
                    break;
                default:
                    include_once ("pages/student/view-all-students.php");
            }
            ?>


            <!-- Page content -->

        </div>
        <!-- Argon Scripts -->
        <!-- Core -->
        <?php
        include_once ("../../includes/core_scripts.php");
        ?>
        </body>
        <?php
    }//END OF IF
    else{
        include_once ("../../includes/no-access.php");
    }
}else {
    include_once ("../../includes/no-access.php");
}
?>

</html>