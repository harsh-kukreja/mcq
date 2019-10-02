<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 24-06-2019
 * Time: 00:52
 */
include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/includes/PdoConnection.class.php");
include_once ($helper->getBasePath()."/includes/Crud.class.php");

include_once($helper->getBasePath() . "/includes/functions.php");

//delete student details by updating deleted from student user and person table
$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$delete = new Crud();

$student_id = $_GET['stud_id'];
$delete_student = array("deleted=".convertToString("1"));
$delete->updateDb("student",$delete_student,"student_id=$student_id");

$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$statement = $pdo->prepare($query = "SELECT user_id from student WHERE student_id = $student_id");
$statement->execute();
$student_user_id = null;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $student_user_id= $row["user_id"];
}

$delete_student = array("deleted=".convertToString("1"));
$delete->updateDb("user",$delete_student,"user_id=$student_user_id");

$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$statement = $pdo->prepare($query = "SELECT person_id from user WHERE user_id = $student_user_id");
$statement->execute();
$person_id = null;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $person_id= $row["person_id"];
}


$delete_student = array("deleted=".convertToString("1"));
$delete->updateDb("person",$delete_student,"person_id=$person_id");

$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$statement = $pdo->prepare($query = "SELECT semester_id FROM student WHERE student_id = $student_id");
$statement->execute();
$student_semester_id = null;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $student_semester_id= $row["semester_id"];
}
$delete_student = array("deleted=".convertToString("1"));
$delete->updateDb("semester",$delete_student,"semester_id = $student_semester_id");

$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$statement = $pdo->prepare($query = "SELECT batch_id FROM student WHERE student_id = $student_id");
$statement->execute();
$student_batch_id= null;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $student_batch_id= $row["batch_id"];
}
$delete_student = array("deleted=".convertToString("1"));
$delete->updateDb("batch",$delete_student,"batch_id = $student_batch_id");


//*************************delete parent details of corresponding parent*****************************//
$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$statement = $pdo->prepare($query = "SELECT parent_id from parent_student WHERE student_id = $student_id");
$statement->execute();
$parent_id = null;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $parent_id= $row["parent_id"];
}

$delete_parent = array("deleted=".convertToString("1"));
$delete->updateDb("parent",$delete_parent,"parent_id = $parent_id");


$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$statement = $pdo->prepare($query = "SELECT user_id from parent WHERE parent_id = $parent_id");
$statement->execute();
$parent_user_id = null;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $parent_user_id= $row["user_id"];
}
$delete_parent = array("deleted=".convertToString("1"));
$delete->updateDb("user",$delete_parent,"user_id = $parent_user_id");


$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$statement = $pdo->prepare($query = "SELECT person_id from user WHERE user_id = $parent_user_id");
$statement->execute();
$parent_person_id = null;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $parent_person_id= $row["person_id"];
}
$delete_parent = array("deleted=".convertToString("1"));
$delete->updateDb("person",$delete_parent,"person_id = $parent_person_id");










