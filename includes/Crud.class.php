<?php
/**
 * Created by PhpStorm.
 * User: Yukta
 * Date: 6/9/2019
 * Time: 5:04 PM
 */

include_once ($_SERVER["DOCUMENT_ROOT"]."/mcq/includes/PdoConnection.class.php");

class Crud{

    public function insertDb($table_name,$rows,$values){
        $pdoObject = new PdoConnection();
        $pdo = $pdoObject->connectPdo();
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
        $pdo = $pdoObject->connectPdo();
        if(is_array($field)){
            $fields= implode(',',$field);
            $statement = $pdo->prepare("UPDATE $table_name SET $fields WHERE $condition");
        }
        else{
            $statement = $pdo->prepare("UPDATE $table_name SET $field WHERE $condition");
        }



         //die("UPDATE $table_name SET $fields WHERE $condition");
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


    /**
     * @param $query
     * @return array
     *
     * This function will take a query string and will return an array of the result Fetched made this just to execute the query so that we dont have to create an pdoObject again and again.This uses FetchAll
     */
    public function executeQuery($query){
        $pdoObject = new PdoConnection();
        $pdo = $pdoObject->connectPdo();
        $statement = $pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}