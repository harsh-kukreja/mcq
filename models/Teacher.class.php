<?php
/**
 * Created by PhpStorm.
 * User:
 * Date:
 * Time:
 */

class Teacher extends Users {
    public $teacher_id;

    function getBatch($teacher_id){
        $query = "Select batch_id from teaches where teacher_id = $teacher_id";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $batch_id = $row['batch_id'];
            return $batch_id;

        }
    }
    function getDivision($teacher_id){
        $query = "Select division_id from teaches where teacher_id = $teacher_id";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $division_id = $row['division_id'];
            return $division_id;

        }
    }
    function createTeacher(){


    }
    function deleteTeacher(){}
    function updateTeacher(){}
    function getTest(){}

}