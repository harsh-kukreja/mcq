<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 02-11-2019
 * Time: 07:32 PM
 */
include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/includes/PdoConnection.class.php");
include_once ($helper->getBasePath()."/includes/Crud.class.php");

include_once($helper->getBasePath() . "/includes/functions.php");

$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$delete = new Crud();

$teacher_id = $_GET['teacher_id'];
$delete_teacher = array("deleted=".convertToString("1"));
$delete->updateDb("teacher",$delete_teacher,"teacher_id=$teacher_id");

$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$statement = $pdo->prepare($query = "SELECT user_id from teacher WHERE teacher_id = $teacher_id");
$statement->execute();
$teacher_user_id = null;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $teacher_user_id= $row["user_id"];
}

$delete_teacher = array("deleted=".convertToString("1"));
$delete->updateDb("user",$delete_teacher,"user_id=$teacher_user_id");

$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$statement = $pdo->prepare($query = "SELECT person_id from user WHERE user_id = $teacher_user_id");
$statement->execute();
$person_id = null;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $person_id= $row["person_id"];
}

$delete_person = array("deleted=".convertToString("1"));
$delete->updateDb("person",$delete_person,"person_id=$person_id");
