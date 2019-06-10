<?php
/**
 * Created by PhpStorm.
 * User: Yukta
 * Date: 6/9/2019
 * Time: 5:04 PM
 */

include_once ("PdoConnection.php");

class Crud{
    public function insertDb($table_name,$rows,$values){
        $pdoObject = new PdoConnection();
        $pdo = $pdoObject->connectoPdo();
        $row_values= implode(',',$rows);
        $values = implode(',',$values);
        $statement = $pdo->prepare("INSERT INTO $table_name($row_values) VALUES ($values)");
        // die("INSERT INTO $table_name($row_values) VALUES ($values)");
        //  echo "INSERT INTO $table_name($row_values) VALUES ($values)";
        $stmt = $statement->execute();
        if($stmt) {
            echo "inserted sucessfullyy";
            //return true;
        }
        else {
            echo "not inseterd";
            //return false;
        }
    }
    public function updateDb($table_name,$field,$condition=0){
        $pdoObject = new PdoConnection();
        $pdo = $pdoObject->connectoPdo();
        $fields= implode(',',$field);
        $statement = $pdo->prepare("UPDATE $table_name SET $fields WHERE $condition");
        // die("UPDATE $table_name SET $fields WHERE $condition");
        $stmt = $statement->execute();
        if($stmt){
            echo "updated sucessfullyy";
            //return true;
        }
        else{
            echo "not updated";
            //return false;
        }
    }
}