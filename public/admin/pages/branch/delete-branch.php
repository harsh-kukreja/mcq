<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 02-11-2019
 * Time: 08:54 PM
 */
include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/includes/PdoConnection.class.php");
include_once ($helper->getBasePath()."/includes/Crud.class.php");

include_once($helper->getBasePath() . "/includes/functions.php");

$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();
$delete = new Crud();

$batch_id = $_GET['batch_id'];
//$delete_branch = array("deleted=".convertToString(1));
//$delete->updateDb("division",$delete_branch,"division_id = $batch_id");

$delete_batch = array("deleted=".convertToString(1));
$delete->updateDb("batch",$delete_batch,"division_id = $batch_id");
//
//$delete_branch = array("deleted=".convertToString(1));
//$delete->updateDb("branch",$delete_branch,"");