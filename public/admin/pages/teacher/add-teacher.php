<?php
if (isset($_POST['add'])) {

    include_once($_SERVER["DOCUMENT_ROOT"] . "/mcq/helpers/Helper.class.php");
    $helper = new Helper();
    include_once($helper->getBasePath() . "/includes/functions.php");
    include_once($helper->getBasePath() . "/includes/PdoConnection.class.php");
    include_once($helper->getBasePath() . "/includes/Crud.class.php");
    include_once ($helper->getBasePath()."/models/Teacher.class.php");


    $add = new Crud();


    $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
    $password = password_hash(substr(str_shuffle($str), 0, 8),PASSWORD_DEFAULT);

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


    //insert values in person table
    $insert_person = array("first_name", "last_name", "address", "email", "contact", "image", "about_me", "created_by");
    $output_person = array(convertToString($first_name), convertToString($last_name), convertToString($address), convertToString($email), convertToString($contact), convertToString($image), convertToString($about_me), convertToString($user_id));
    $add->insertDb("person", $insert_person, $output_person);


    //fetch person_id from person table
    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT person_id FROM person ORDER BY person_id  DESC LIMIT 1");
    $statement->execute();
    $person_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $person_id = $row["person_id"];
    }

    $role_id = 1;
    //insert values in user table
    $insert_user = array("person_id", "role_id", "username", "password", "created_by", "updated_by");
    $output_user = array(convertToString($person_id), convertToString($role_id), convertToString($first_name . $last_name . $person_id), convertToString($password), convertToString($user_id), convertToString($user_id));
    $add->insertDb("user", $insert_user, $output_user);


    //fetch user_id

    $statement = $pdo->prepare($query = "SELECT user_id FROM user ORDER BY user_id  DESC LIMIT 1");
    $statement->execute();
    $teacher_user_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $teacher_user_id = $row["user_id"];
    }



    $insert_teacher = array("user_id", "created_by", "updated_by");
    $output_teacher = array(convertToString($teacher_user_id), convertToString($user_id), convertToString($user_id));
    $add->insertDb("teacher", $insert_teacher, $output_teacher);



    //***************************Inserting values into teaches table **********************//
    $statement = $pdo->prepare($query = "SELECT teacher_id FROM teacher ORDER BY teacher_id DESC LIMIT 1");
    $statement->execute();
    $teacher_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $teacher_id = $row["teacher_id"];
    }

    $division = $_POST['division'];
    $subject = $_POST['subject'];
    $batch = $_POST['batch'];


    $insert_teaches = array("teacher_id","division_id","subject_id","batch_id","created_by");
    $output_teaches = array(convertToString($teacher_id), convertToString($division), convertToString($subject),convertToString($batch),convertToString($role_id));
    $add->insertDb("teaches", $insert_teaches, $output_teaches);

}
?>
<div class="container ">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">


            <input class="form-control" type="hidden" value="--><!--" placeholder="" name="person_id"
                   id="person_id">
            <div class="col-6">
                <label class="form-control-label" for="first_name">First Name</label>
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
                <label for="subject" class="form-control-label">Subject</label>

                <select name="subject" id="subject" class="form-control">

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
                <button type="submit" class="btn btn-outline-primary" name="add" id="add">Add</button>
            </div>
        </div>
    </form>
</div>