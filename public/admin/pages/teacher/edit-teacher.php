<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 02-09-2019
 * Time: 09:58 PM
 */

include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/includes/PdoConnection.class.php");
include_once ($helper->getBasePath()."/includes/Crud.class.php");

if(isset($_GET['teacher_id'])){


    if(isset($_POST['edit'])){

        include_once($helper->getBasePath() . "/includes/functions.php");
        include_once($helper->getBasePath() . "/includes/PdoConnection.class.php");
        include_once($helper->getBasePath() . "/includes/Crud.class.php");


        $edit = new Crud();


        $user_id = $_SESSION['user_id'];
        $teacher_id = $_GET['teacher_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $division = $_POST['division'];
        $branch = $_POST['branch'];
        $semester = $_POST['semester'];
        $batch = $_POST['batch'];
        $subject = $_POST['subject'];

        $images = $_FILES["images"]["name"];
        $image = $_FILES['images']['name'];
        $post_image_temp = $_FILES['images']['tmp_name'];
        $about_me = $_POST["about_me"];
        move_uploaded_file($post_image_temp, "../images/$image");





        $pdoObject = new PdoConnection();
        $pdo = $pdoObject->connectPdo();
        $statement = $pdo->prepare($query = "SELECT user.person_id FROM teacher INNER JOIN user ON teacher.user_id = user.user_id INNER JOIN person ON user.person_id = person.person_id WHERE teacher_id = $teacher_id");
        $statement->execute();
        $person_id = null;
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $person_id = $row["person_id"];
        }

        $edit_person = array("first_name=".convertToString($first_name),"last_name=".convertToString($last_name),"address=".convertToString($address),"email=".convertToString("$email"),"contact=".convertToString("$contact"),"image=".convertToString("$image"),"about_me=".convertToString("$about_me"),"updated_by=".convertToString("$user_id"));
        $edit->updateDb("person",$edit_person,"person_id=$person_id");


        $edit_teaches = array("division_id=".convertToString($division),"batch_id=".convertToString($batch),"subject_id=".convertToString($subject));
        $edit->updateDb("teaches",$edit_teaches,"teacher_id=$teacher_id");
    }

    $teacher_id = $_GET['teacher_id'];
    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query="SELECT person.first_name, person.last_name, person.email, person.address, person.image, person.about_me , person.contact, batch.batch_name, batch.batch_id ,division.division_name, division.division_id, branch.branch_name, branch.branch_id, branch.branch_code, semester.semester_number ,teacher.teacher_id ,subject.subject_id, subject.subject_name from person INNER JOIN user ON person.person_id = user.person_id INNER JOIN teacher ON user.user_id = teacher.user_id INNER JOIN teaches ON teacher.teacher_id = teaches.teacher_id INNER JOIN division ON teaches.division_id = division.division_id INNER JOIN branch ON division.branch_id = branch.branch_id INNER JOIN subject ON teaches.subject_id = subject.subject_id INNER JOIN semester ON subject.semester_id = semester.semester_id INNER JOIN batch ON teaches.batch_id = batch.batch_id WHERE teacher.teacher_id = $teacher_id");
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $first_name = $row['first_name'];
        $branch_id = $row['branch_id'];
        $division_id = $row['division_id'];
        $batch_id = $row['batch_id'];
        $subject = $row['subject_name'];
        $last_name = $row['last_name'];
        $address = $row['address'];
        $semester_number = $row['semester_number'];
        $about_me = $row['about_me'];
        $image = $row['image'];
        $email = $row['email'];
        $contact = $row['contact'];
        $batch = $row['batch_name'];
        $division = $row['division_name'];
        $branch = $row['branch_name'];
        $semester = $row['semester_number'];
        $subject_id = $row['subject_id'];

    }


    ?>
    <div class="container">
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-12">

                    <label for="" class="form-control-label">Student Details</label>
                </div>

                <div class="col-6">
                    <label class="form-control-label" for="first_name">First Name</label>
                    <input class="form-control" value="<?php echo $first_name;?>" type="text" placeholder="" name="first_name" id="first_name">
                </div>
                <div class="col-6">
                    <label class="form-control-label" for="last_name">Last Name</label>
                    <input class="form-control" value="<?php echo $last_name;?>" type="search" placeholder="" name="last_name" id="last_name">
                </div>
                <div class="col-6">
                    <label for="example-search-input" class="form-control-label">Email</label>
                    <input class="form-control" value="<?php echo $email ;?>" type="search" placeholder="" id="email" name="email">
                </div>


                <div class="col-6">
                    <label for="example-search-input" class="form-control-label">Contact</label>
                    <input class="form-control" value="<?php echo $contact;?>" type="search" placeholder="" id="contact" name="contact">
                </div>

                <div class="col-6">
                    <label for="" class="form-control-label">Branch</label>
                    <select name="branch" id="branch" class="form-control">
                        <option value="" class="form-control">Select Branch</option>
                        <?php
                        include_once ($helper->getBasePath()."/models/Branch.class.php");
                        $branch_object = new Branch();
                        $branch_details = $branch_object->getAllBranch();
                        print_r($branch_details);



                        echo "<option value='$branch_id' selected>$branch</option>";



                        ?>
                    </select>
                </div>


                <div class="col-6">
                    <label for="division" class="form-control-label">
                        Division
                    </label>
                    <select name="division" id="division" class="form-control">
                        <option value="" class="form-control">Select Division</option>
                        <?php
                        include_once ($helper->getBasePath()."/models/Division.class.php");
                        $division_object = new Division();
                        $division_details = $division_object->getAllDivision();
                        print_r($division_details);
                        echo "<option value='$division_id'selected>$division</option>"
                        ?>

                    </select>
                </div>


                <div class="col-6">
                    <label for="semester" class="form-control-label">
                        Semester
                    </label>
                    <select name="semester" id="semester" class="form-control">
                        <option value="" class="form-control">Select Semester</option>
                        <?php
                        include_once ($helper->getBasePath()."/models/Semester.class.php");
                        $semester_object = new Semester();
                        $semester_details = $semester_object->getAllSemester();
                        print_r($semester_details);
                        echo "<option value='$semester_number'selected>$semester</option>"
                        ?>
                    </select>
                </div>


                <div class="col-6">
                    <label for="batch" class="form-control-label">
                        Batch
                    </label>
                    <select name="batch" id="batch" class="form-control">
                        <option value="" class="form-control">Select Batch</option>
                        <?php
                        include_once ($helper->getBasePath()."/models/Batch.class.php");
                        $batch_object = new Batch();
                        $batch_details = $batch_object->getAllBatch();
                        print_r($batch_details);
                        echo "<option value='$batch_id'selected>$batch</option>"
                        ?>
                    </select>
                </div>


                <div class="col-6">
                    <label for="subject" class="form-control-label">Subject</label>

                    <select name="subject" id="subject" class="form-control">
                        <?php
                            include_once ($helper->getBasePath()."/models/Subject.class.php");
                            $subject_object = new Subject();
                            $subject_details = $subject_object->getAllSubjects();
                            print_r($subject_details);
                            echo "<option value='$subject_id'selected>$subject</option>";

                        ?>
                    </select>
                </div>


                <div class="col-6">
                    <label for="example-search-input" class="form-control-label">Image</label>
                    <input type="file" value=" <?php echo $image;?> " class="form-control-file" name="images" id="images">
                </div>

                <div class="col-12">
                    <label for="example-search-input" class="form-control-label">Address</label>
                    <textarea name="address" id="address"><?php echo $address;?></textarea>

                    <label for="example-search-input" class="form-control-label">About Me</label>
                    <textarea name="about_me" id="about_me"><?php echo $about_me;?></textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-outline-primary" name="edit" id="edit">Edit</button>
                </div>

            </div>
        </form>
    </div>
    <?php

}
?>
