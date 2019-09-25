<?php
if(isset($_POST['add'])) {
    include_once($_SERVER["DOCUMENT_ROOT"] . "/mcq/helpers/Helper.class.php");
    $helper = new Helper();
    include_once($helper->getBasePath() . "/includes/functions.php");
    include_once($helper->getBasePath() . "/includes/PdoConnection.class.php");
    include_once($helper->getBasePath() . "/includes/Crud.class.php");

    $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
    $password = password_hash(substr(str_shuffle($str), 0, 8),PASSWORD_DEFAULT);


    $insert = new Crud();

    $role = $_SESSION['role_id'];
    $user_id = $_SESSION['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $images = $_FILES["images"]["name"];
    $image = $_FILES['images']['name'];
    $post_image_temp = $_FILES['images']['tmp_name'];
    $about_me = $_POST["about_me"];
    move_uploaded_file($post_image_temp, "../images/$image");

    $branch = $_POST['branch'];
    $division = $_POST['division'];
    $semester = $_POST['semester'];
    $batch = $_POST['batch'];


    $insert_values = array("first_name", "last_name", "address", "email", "contact", "image", "about_me", "created_by");
    $output_values = array(convertToString($first_name), convertToString($last_name), convertToString($address), convertToString($email), convertToString($contact), convertToString($image), convertToString($about_me), convertToString($user_id));
    $insert->insertDb("person", $insert_values, $output_values);

    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT person_id FROM person ORDER BY person_id  DESC LIMIT 1");
    $statement->execute();
    $person_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $person_id = $row["person_id"];
    }

    $role_id = 2;
    $insert_user = array("person_id", "role_id", "username", "password", "created_by", "updated_by");
    $output_user = array(convertToString($person_id), convertToString($role_id), convertToString($first_name . $last_name . $person_id), convertToString($password), convertToString($user_id), convertToString($user_id));
    $insert->insertDb("user", $insert_user, $output_user);


    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT student_id FROM student ORDER BY student_id  DESC LIMIT 1");
    $statement->execute();
    $student_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $student_id = $row["student_id"];
    }

    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT parent_id FROM parent ORDER BY parent_id DESC LIMIT 1");
    $statement->execute();
    $parent_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $parent_id = $row["parent_id"];
    }

    $insert_parent_student = array("parent_id", "student_id", "created_by");
    $output_parent_student = array(convertToString($parent_id), convertToString($student_id), convertToString($role_id));
    $insert->insertDb("parent_student", $insert_parent_student, $output_parent_student);


    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT user_id FROM user WHERE role_id = $role_id  ORDER BY user_id DESC LIMIT 1");
    $statement->execute();
    $student_user_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $student_user_id= $row["user_id"];
    }

    $insert_student = array("user_id","semester_id","batch_id","created_by");
    $output_student = array(convertToString($student_user_id), convertToString($semester), convertToString($batch),convertToString($role_id));
    $insert->insertDb("student",$insert_student,$output_student);


    //*************************inserting parent details********************************************//

    $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
    $parent_password = substr(str_shuffle($str), 0, 9);
    $parent_user_id = $_SESSION['user_id'];
    $parent_first_name = $_POST['parent_first_name'];
    $parent_last_name = $_POST['parent_last_name'];
    $parent_address = $_POST['parent_address'];
    $parent_email = $_POST['parent_email'];
    $parent_contact = $_POST['parent_contact'];
    $parent_images = $_FILES["parent_images"]["name"];
    $parent_image = $_FILES['parent_images']['name'];
    $parent_post_image_temp = $_FILES['parent_images']['tmp_name'];
    $parent_about_me = $_POST["parent_about_me"];

    move_uploaded_file($parent_post_image_temp, "../images/$image");





    $parent_insert_values = array("first_name", "last_name", "address", "email", "contact", "image", "about_me", "created_by");
    $parent_output_values = array(convertToString($parent_first_name), convertToString($parent_last_name), convertToString($parent_address), convertToString($parent_email), convertToString($parent_contact), convertToString($parent_image), convertToString($parent_about_me), convertToString($parent_user_id));
    $insert->insertDb("person", $parent_insert_values, $parent_output_values);


    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT person_id FROM person ORDER BY person_id  DESC LIMIT 1");
    $statement->execute();
    $parent_person_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $parent_person_id = $row["person_id"];
    }
    $parent_role_id = 3;
    $parent_insert_user = array("person_id", "role_id", "username", "password", "created_by", "updated_by");
    $parent_output_user = array(convertToString($parent_person_id), convertToString($parent_role_id), convertToString($parent_first_name . $parent_last_name . $parent_person_id), convertToString($parent_password), convertToString($parent_user_id), convertToString($parent_user_id));
    $insert->insertDb("user", $parent_insert_user, $parent_output_user);

    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT user_id from user where person_id = $parent_person_id");
    $statement->execute();
    $user_id_parent = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $user_id_parent = $row["user_id"];
    }

    $parent_insert = array("user_id", "created_by");
    $parent_values = array(convertToString($user_id_parent), convertToString($role));
    $insert->insertDb("parent", $parent_insert, $parent_values);

}
?>
<div class="container ">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col-12">

                <label for="" class="form-control-label">Student Details</label>
            </div>

            <div class="col-6">
                <label  class="form-control-label" for="first_name">First Name</label>
                <input class="form-control" type="text" placeholder="" name="first_name" id="first_name">

            </div>
            <div class="col-6">
                <label class="form-control-label" for="last_name">Last Name</label>
                <input class="form-control" type="search" placeholder="" name="last_name" id="last_name">
            </div>
            <div class="col-6">
                <label for="example-search-input" class="form-control-label">Email</label>
                <input class="form-control" type="search" placeholder="" id="email" name="email">
            </div>


            <div class="col-6">
                <label for="example-search-input" class="form-control-label">Contact</label>
                <input class="form-control" type="search" placeholder="" id="contact" name="contact">
            </div>

            <div class="col-6">
                <label for="" class="form-control-label">Branch</label>
                <select name="branch" id="branch" class="form-control">
                    <option value=""class="form-control">Select Branch</option>
                    <?php
                        include_once ($helper->getBasePath()."/models/Branch.class.php");
                        $branch_object = new Branch();
                        $branch_details = $branch_object->getAllBranch();
                        print_r($branch_details);
                    ?>
                </select>
            </div>



            <div class="col-6">
                <label for="division" class="form-control-label">
                    Division
                </label>
                <select name="division" id="division" class="form-control" >
                    <option value="" class="form-control">Select Division</option>


                </select>
            </div>



            <div class="col-6">
                <label for="semester" class="form-control-label">
                    Semester
                </label>
                <select name="semester" id="semester" class="form-control" >
                    <option value="" class="form-control">Select Semester</option>

                </select>
            </div>


            <div class="col-6">
                <label for="batch" class="form-control-label">
                    Batch
                </label>
                <select name="batch" id="batch" class="form-control" >
                    <option value="" class="form-control">Select Batch</option>

                </select>
            </div>



            <div class="col-6">
                <label for="example-search-input" class="form-control-label">Image</label>
                <input type="file" class="form-control-file" name="images" id="images">
            </div>

            <div class="col-12">
                <label for="example-search-input" class="form-control-label">Address</label>
                <textarea name="address" id="address"></textarea>

                <label for="example-search-input" class="form-control-label">About Me</label>
                <textarea name="about_me" id="about_me"></textarea>
            </div>




            <div class="col-12">
                <hr>
                <label for="" class="form-control-label">Parent Details</label>

            </div>




            <div class="col-6">
                <label  class="form-control-label" for="parent_first_name">First Name</label>
                <input class="form-control" type="text" placeholder="" name="parent_first_name" id="parent_first_name">

            </div>
            <div class="col-6">
                <label class="form-control-label" for="parent_last_name">Last Name</label>
                <input class="form-control" type="search" placeholder="" name="parent_last_name" id="parent_last_name">
            </div>
            <div class="col-6">
                <label for="example-search-input" class="form-control-label">Email</label>
                <input class="form-control" type="search" placeholder="" id="parent_email" name="parent_email">
            </div>


            <div class="col-6">
                <label for="parent_contact" class="form-control-label">Contact</label>
                <input class="form-control" type="search" placeholder="" id="parent_contact" name="parent_contact">
            </div>

            <div class="col-6">
                <label for="example-search-input" class="form-control-label">Image</label>
                <input type="file" class="form-control-file" name="parent_images" id="parent_images">
            </div>

            <div class="col-12">
                <label for="example-search-input" class="form-control-label">Address</label>
                <textarea name="parent_address" id="parent_address"></textarea>

                <label for="example-search-input" class="form-control-label">About Me</label>
                <textarea name="parent_about_me" id="parent_about_me"></textarea>
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-outline-primary" name="add" id="add">Add</button>
            </div>
        </div>
    </form>
</div>
