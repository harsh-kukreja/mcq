<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/models/Division.class.php");
include_once ($helper->getBasePath()."/models/Semester.class.php");
include_once ($helper->getBasePath()."/models/Batch.class.php");
include_once ($helper->getBasePath()."/models/Subject.class.php");

    if($_POST['trigger'] == "division") {
        $division_object = new Division();
        $division = array($division_object->getAllDivision());
        print_r($division);
    }elseif($_POST['trigger'] == "semester"){
        $semester_object = new Semester();
        $semester = array($semester_object->getAllSemester());
        print_r($semester);
    }elseif($_POST['trigger'] == "batch"){
        $batch_object = new Batch();
        $batch = array($batch_object->getAllBatch());
        print_r($batch);
    }elseif($_POST['trigger'] == "Subject"){
        $subject_object = new Subject();
        $subject = array($subject_object->getAllSubjects());
        print_r($subject);
    }











