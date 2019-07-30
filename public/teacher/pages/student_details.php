<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 27-07-2019
 * Time: 16:27
 */

$page_title = "Student Details";
 include_once("../../../helpers/Helper.class.php");
// include_once ("");

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
        include_once($helper->getBasePath()."includes/sidenav.php");?>

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
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title;?></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                               <th>Sr No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email Address</th>
                                <th>Contact No</th>

                            </tr>
                            </thead>
                            <tbody>

        <?php
        $query = "select person_id from user where user_id in (select user_id from student where batch_id in (select batch_id from teaches where teacher_id in (select teacher_id from teacher where user_id =  " . $_SESSION['user_id'] . ")))";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        $persons = $statement->fetchAll(\PDO::FETCH_ASSOC);
        for($i = 0;$i<sizeof($persons);$i++) {
            $query = "select first_name,last_name,address,email,contact,image from person where person_id  = " . $persons[$i]['person_id'];
                $pdoObject = new PdoConnection();
                $connection = $pdoObject->connectPdo();
                $statement = $connection->prepare($query);
                $statement->execute();
                $j = $i + 1;
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $address = $row['address'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $image = $row['image'];
                    echo <<<DETAILS
<tr>
<td>$j</td>
<td><img src="../../images/$image" class="img-fluid"></td>
<td>$first_name $last_name</td>
<td>$address</td>
<td>$email</td>
<td>$contact</td>

<td></td>
</tr>
DETAILS;
                }
            }

        return null;


        ?>
                    </tbody>
                </table>
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