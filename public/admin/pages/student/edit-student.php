<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 24-06-2019
 * Time: 00:41
 */

include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/includes/PdoConnection.class.php");
include_once ($helper->getBasePath()."/includes/Crud.class.php");



if(isset($_GET['stud_id'])){

    if(isset($_POST['edit'])){
        include_once($helper->getBasePath() . "/includes/functions.php");
        include_once($helper->getBasePath() . "/includes/PdoConnection.class.php");
        include_once($helper->getBasePath() . "/includes/Crud.class.php");


        $edit = new Crud();

        $user_id = $_SESSION['user_id'];
        $student_id = $_GET['stud_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $division = $_POST['division'];
        $branch = $_POST['branch'];
        $semester = $_POST['semester'];
        $batch = $_POST['batch'];


        $images = $_FILES["images"]["name"];
        $image = $_FILES['images']['name'];
        $post_image_temp = $_FILES['images']['tmp_name'];
        $about_me = $_POST["about_me"];
        move_uploaded_file($post_image_temp, "../images/$image");


        $pdoObject = new PdoConnection();
        $pdo = $pdoObject->connectPdo();
        $statement = $pdo->prepare($query = "SELECT user.person_id FROM student INNER JOIN user ON student.user_id = user.user_id INNER JOIN person ON user.person_id = person.person_id WHERE student_id = $student_id");
        $statement->execute();
        $person_id = null;
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $person_id = $row["person_id"];
        }

        $edit_person = array("first_name=".convertToString($first_name),"last_name=".convertToString($last_name),"address=".convertToString($address),"email=".convertToString($email),"contact=".convertToString($contact),"image=".convertToString($image),"about_me=".convertToString($about_me),"updated_by=".convertToString($user_id));
        $edit->updateDb("person",$edit_person,"person_id=$person_id");


        $edit_student = array("semester_id=".convertToString($semester),"batch_id=".convertToString($batch));
        $edit->updateDb("student",$edit_student,"student_id = $student_id");

    }




    $edit_student_id = $_GET['stud_id'];
    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query="SELECT person.first_name, person.last_name, person.email, person.address, person.image, person.about_me , person.contact, batch.batch_name, batch.batch_id ,division.division_name, division.division_id, branch.branch_name, branch.branch_id, branch.branch_code, semester.semester_number ,student.student_id FROM student INNER JOIN user ON student.user_id = user.user_id INNER JOIN person ON user.person_id = person.person_id INNER JOIN batch ON student.batch_id = batch.batch_id INNER JOIN division ON batch.division_id = division.division_id INNER JOIN branch ON division.branch_id = branch.branch_id INNER JOIN semester ON student.semester_id = semester.semester_id WHERE student_id = $edit_student_id");
    $parent_statement = $pdo->prepare($query="SELECT person.first_name, person.last_name , person.email, person.address, person.contact, person.image, person.about_me FROM parent_student INNER JOIN parent ON parent.parent_id = parent_student.parent_id INNER JOIN user ON user.user_id = parent.user_id INNER JOIN person ON person.person_id = user.person_id WHERE parent_student.student_id = $edit_student_id");
    $parent_statement->execute();
    while($row = $parent_statement->fetch(PDO::FETCH_ASSOC)){
        $parent_first_name = $row['first_name'];
        $parent_last_name = $row['last_name'];
        $parent_email = $row['email'];
        $parent_address = $row['address'];
        $parent_contact = $row['contact'];
        $parent_image = $row['image'];
        $parent_about_me = $row['about_me'];
    }
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $first_name = $row['first_name'];
        $branch_id = $row['branch_id'];
        $division_id = $row['division_id'];
        $batch_id = $row['batch_id'];
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
    }

    ?>
        <div class="container">
            <form action="view-all-students.php" method="post" role="form" enctype="multipart/form-data">
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
                        <input class="form-control" value="<?php echo $last_name;?>"type="search" placeholder="" name="last_name" id="last_name">
                    </div>
                    <div class="col-6">
                        <label for="example-search-input" class="form-control-label">Email</label>
                        <input class="form-control" value="<?php echo $email ;?>"type="search" placeholder="" id="email" name="email">
                    </div>


                    <div class="col-6">
                        <label for="example-search-input" class="form-control-label">Contact</label>
                        <input class="form-control" value="<?php echo $contact;?>"type="search" placeholder="" id="contact" name="contact">
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
                                    echo "<option value='$branch_id'selected>$branch</option>"
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
                        <label for="example-search-input" class="form-control-label">Image</label>
                        <input type="file" value=" <?php echo $address;?> " class="form-control-file" name="images" id="images">
                    </div>

                    <div class="col-12">
                        <label for="example-search-input" class="form-control-label">Address</label>
                        <textarea name="address" id="address"><?php echo $address;?></textarea>

                        <label for="example-search-input" class="form-control-label">About Me</label>
                        <textarea name="about_me" id="about_me"><?php echo $about_me;?></textarea>
                    </div>


                    <div class="col-12">
                        <hr>
                        <label for="" class="form-control-label">Parent Details</label>

                    </div>


                    <div class="col-6">
                        <label class="form-control-label" for="parent_first_name">First Name</label>
                        <input class="form-control" type="text" placeholder="" value="<?php echo $parent_first_name;?>" name="parent_first_name"
                               id="parent_first_name">

                    </div>
                    <div class="col-6">
                        <label class="form-control-label" for="parent_last_name">Last Name</label>
                        <input class="form-control" type="search" value="<?php echo $parent_last_name;?>" placeholder="" name="parent_last_name"
                               id="parent_last_name">
                    </div>
                    <div class="col-6">
                        <label for="example-search-input" class="form-control-label">Email</label>
                        <input class="form-control" type="search" value = "<?php echo $parent_email;?>" placeholder="" id="parent_email" name="parent_email">
                    </div>


                    <div class="col-6">
                        <label for="parent_contact" class="form-control-label">Contact</label>
                        <input class="form-control" type="search" placeholder="" id="parent_contact" value="<?php echo $parent_contact;?>"
                               name="parent_contact">
                    </div>

                    <div class="col-6">
                        <label for="example-search-input" class="form-control-label">Image</label>
                        <input type="file" class="form-control-file" name="parent_images" value="<?php echo $parent_image;?>" id="parent_images">
                    </div>

                    <div class="col-12">
                        <label for="example-search-input" class="form-control-label">Address</label>
                        <textarea name="parent_address" id="parent_address"><?php echo $parent_address;?></textarea>

                        <label for="example-search-input" class="form-control-label">About Me</label>
                        <textarea name="parent_about_me" id="parent_about_me"><?php echo $parent_about_me;?></textarea>
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
