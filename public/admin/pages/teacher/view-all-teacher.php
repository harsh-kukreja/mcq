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
                $statement = $pdo->prepare($query="SELECT teacher.teacher_id,person.first_name,person.last_name,person.address,person.email,person.contact,batch.batch_name,division.division_name,branch.branch_name ,semester.semester_number ,subject.subject_name from person INNER JOIN user ON person.person_id = user.person_id INNER JOIN teacher ON user.user_id = teacher.user_id INNER JOIN teaches ON teacher.teacher_id = teaches.teacher_id INNER JOIN division ON teaches.division_id = division.division_id INNER JOIN branch ON division.branch_id = branch.branch_id INNER JOIN subject ON teaches.subject_id = subject.subject_id INNER JOIN semester ON subject.semester_id = semester.semester_id INNER JOIN batch ON teaches.batch_id = batch.batch_id WHERE teacher.deleted = 0");
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
                    echo <<<TEACHER
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
<td><a href="user.php?source=delete_teacher&teacher_id=$teacher_id" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
</tr>
TEACHER;
                }
                ?>
                </tbody >
            </table >
        </div >
    </div >
</div

