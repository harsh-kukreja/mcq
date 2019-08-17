<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/mcq/models/Person.class.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/mcq/models/Users.class.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/mcq/includes/PdoConnection.class.php");
//include_once ($_SERVER['DOCUMENT_ROOT']."/mcq/helpers/");
include_once("../helpers/Helper.class.php");
$helper = new Helper();
session_start();
$obj = new Person();
$row = $obj->getDetails();
$userObj = new Users();
$username = $userObj->getUsername();


if(isset($_POST['edit-changes'])) {
    $user_id = $_SESSION['user_id'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $about_me = $_POST['about_me'];

    $currentDateTime = date('Y-m-d H:i:s');


    $query = "UPDATE person SET email='$email',first_name='$first_name' , last_name = '$last_name', address='$address' , contact='$contact' , about_me = '$about_me',updated_by=$user_id ,updated_at = '$currentDateTime' WHERE person_id = (select person_id from user where user_id = $user_id)";
    //die($query);
    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query);

    if($statement->execute())
        echo "updated";
    else
        echo "some err";
}



?>

<!DOCTYPE html>
<html>
<?php
$page_title = "profile";

include_once($helper->getBasePath()."/includes/header.php");
?>

<body>
<!-- Sidenav -->
<?php


include_once($helper->getBasePath()."/includes/sidenav.php");
?>

<div class="main-content" id="panel">
    <!-- Topnav -->
    <?php
    include_once ("../includes/top-nav.php");
    ?>
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../public/images/argon/theme/img-1-1000x600.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hello <?php echo $row['first_name']?></h1>
                    <p class="text-white mt-0 mb-5">This is your profile page. You can see the information and your personal details along with it you can modify your personal details entered.</p>
                    <a href="#submit_changes" class="btn btn-neutral">Edit profile</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 order-xl-2">

                <!-- Progress track -->

            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="row">
                    <div class="col-lg-6">
     s                   <div class="card bg-gradient-info border-0">
                            <!-- Card body -->

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card bg-gradient-danger border-0">
                            <!-- Card body -->

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit profile </h3>
                            </div>
                            <div class="col-4 text-right">
<!--                                <button class="btn btn-sm btn-primary" name="edit-changes" type="submit">submit changes</button>-->
<!--                                <a href="#!" class="btn btn-sm btn-primary" type="submit">submit changes</a>-->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" id="input-username" class="form-control" placeholder="Username" value="<?php echo $username;?>" name="username" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email" id="input-email" class="form-control" placeholder="jesse@example.com" value="<?php echo $row['email']?>" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">First name</label>
                                            <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="<?php echo $row['first_name']?>" name="first_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Last name</label>
                                            <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="<?php echo $row['last_name']?>" name="last_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Address</label>
                                            <input id="input-address" class="form-control" placeholder="Home Address" value="<?php echo $row['address']?>" name="address">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="contact number">Contact</label>
                                            <input type="text" id="input-contact" class="form-control" placeholder="contact" value="<?php echo $row['contact']?>" name="contact">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">About me</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">About Me</label>
                                    <input type="text" value="<?php echo $row['about_me']?>" class="form-control" name="about_me" id="about_me">
<!--                                    <textarea rows="4" class="form-control" placeholder="A few words about you ..."></textarea>-->
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary" name="edit-changes" type="submit" id="submit_changes">submit changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer pt-0">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center text-lg-left text-muted">
                        &copy; 2019 <a href="https://www.creative-tim.com/" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/" class="nav-link" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://blog.creative-tim.com/" class="nav-link" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- Argon Scripts -->
<?php include_once ("../includes/core_scripts.php");?>
</body>

</html>
