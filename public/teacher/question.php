<?php $page_title = "Question";


include_once("../../helpers/Helper.class.php");

$helper = new Helper();?>
<!DOCTYPE html>
<html>
<?php
include_once ("../../includes/header.php");
session_start();
if(isset($_SESSION['role_id'])) {
    if ($_SESSION['role_id'] == 1) {
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
                $source = $_GET['source'];
            }else{
                $source="";
            }
            switch ($source){
                case "add_post":
                    include_once ("pages/question/add-question.php");
                    break;
                case "edit_post":
                    include_once ("pages/question/edit-question.php");
                    break;
//                case "delete_post":
//                    include_once ("pages/question/delete-post.php");
//                    include_once ("pages/posts/view-all-posts.php");
//                    break;
                default:
                    include_once ("pages/question/view-all-questions.php");
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