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

    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();


?>
<div class="row py-4">
    <div class="col-md-12">
        <a href=user.php?source=add_student class="btn btn-primary">Add Student</a>
    </div>
</div>
<div class="row" >
    <div class="col-md-12" >
        <div class="table-responsive" >
            <table class="table table-hover" >
                <thead >
                <tr >
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent Name</th>
                    <th >Address</th >
                    <th >Email</th >
                    <th >Contact-No</th >
                    <th>Branch</th>
                    <th>Semester</th>
                    <th>Division</th>
                    <th>Batch</th>
                    <th></th>
                    <th></th>
                </tr >
                </thead >
                <tbody >
                <?php
                    $pdoObject = new PdoConnection();
                    $pdo = $pdoObject->connectPdo();
                    $statement = $pdo->prepare($query="SELECT CONCAT(person.first_name, CONCAT(\" \", person.last_name)) as name, person.email, person.address, person.contact,student.deleted, batch.batch_name, division.division_name, branch.branch_name, branch.branch_code, semester.semester_number ,student.student_id FROM student INNER JOIN user ON student.user_id = user.user_id INNER JOIN person ON user.person_id = person.person_id INNER JOIN batch ON student.batch_id = batch.batch_id INNER JOIN division ON batch.division_id = division.division_id INNER JOIN branch ON division.branch_id = branch.branch_id INNER JOIN semester ON student.semester_id = semester.semester_id where student.deleted=0");

                    $statement->execute();
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        $student_id = $row['student_id'];
                        $last_name = $row['name'];
                        $address = $row['address'];
                        $email = $row['email'];
                        $contact = $row['contact'];
                        $batch = $row['batch_name'];
                        $division = $row['division_name'];
                        $branch = $row['branch_name'];
                        $semester = $row['semester_number'];

                        echo <<<STUDENT
                        
<tr>
<td>$student_id</td>
<td>$last_name</td>
<td></td>
<td>$address</td>
<td>$email</td>
<td>$contact</td>
<td>$branch</td>
<td>$semester</td>
<td>$division</td>
<td>$batch</td>
<td><a href="user.php?source=edit_student&stud_id=$student_id" class="btn btn-info"><span class="fa fa-edit"></i></span></a></td>
<td><a href="user.php?source=delete_student&stud_id=$student_id" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
</tr>
STUDENT;
                    }
                ?>
                </tbody >
            </table >
        </div >
    </div >
</div

