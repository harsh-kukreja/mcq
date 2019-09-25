<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 24-06-2019
 * Time: 00:42
 */

include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/includes/PdoConnection.class.php");
include_once ($helper->getBasePath()."/includes/Crud.class.php");
?>
<div class="row py-4">
    <div class="col-md-12">
        <a href=user.php?source=add_teacher class="btn btn-primary">Add Teacher</a>
    </div>
</div>
<div class="row" >
    <div class="col-md-12" >
        <div class="table-responsive" >
            <table class="table table-hover" >
                <thead >
                <tr >
                    <th >ID</th >
                    <th >First Name</th >
                    <th>Last Name</th>
                    <th >Address</th >
                    <th >Email</th >
                    <th >Contact-No</th >
                    <th>Branch</th>
                    <th>Semester</th>
                    <th>Batch</th>
                    <th>Subject</th>
                    <th></th>
                    <th></th>
                </tr >
                </thead >
                <tbody >
                <?php
                $pdoObject = new PdoConnection();
                $pdo = $pdoObject->connectPdo();
                $statement = $pdo->prepare($query="SELECT person.first_name, person.last_name, person.email, person.address, person.image, person.about_me , person.contact, batch.batch_name, batch.batch_id ,division.division_name, division.division_id, branch.branch_name, branch.branch_id, branch.branch_code, semester.semester_number ,teacher.teacher_id ,subject.subject_id, subject.subject_name FROM teacher INNER JOIN user ON teacher.user_id = user.user_id INNER JOIN person ON user.person_id = person.person_id INNER JOIN batch ON teacher.user_id = batch.batch_id INNER JOIN division ON batch.division_id = division.division_id INNER JOIN branch ON division.branch_id = branch.branch_id INNER JOIN semester ON teacher.user_id = semester.semester_id INNER JOIN subject ON semester.semester_id = subject.subject_id");
                $statement->execute();
                while($row =$statement->fetch(PDO::FETCH_ASSOC)){
                    $teacher_id = $row['teacher_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $address = $row['address'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $batch = $row['batch_name'];
                    $division = $row['division_name'];
                    $branch = $row['branch_name'];
                    $semester = $row['semester_number'];
                    $subject = $row['subject_name'];
                    echo <<<STUDENT
<tr>
<td>$teacher_id</td>
<td>$first_name</td>
<td>$last_name</td>
<td>$address</td>
<td>$email</td>
<td>$contact</td>
<td>$branch</td>
<td>$semester</td>
<td>$batch</td>
<td>$subject</td>
<td><a href="user.php?source=edit_teacher&teacher_id=$teacher_id" class="btn btn-info"><span class="fa fa-edit"></i></span></a></td>
</tr>
STUDENT;
                }
                ?>
                </tbody >
            </table >
        </div >
    </div >
</div

