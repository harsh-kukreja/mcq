<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 26-04-2019
 * Time: 19:46
 */
include_once ("PdoConnection.class.php");
function startSession()
{
    if (session_status() == PHP_SESSION_NONE) {
        //ob_start();
        session_start();
    }
}

/**
 * convertToString():
 * Method that converts a item variable into  a string
 * @param $item : The statement which is to converted into string
 * @return string: The statement that has been converted into string
 */

function convertToString($item)
{
    $string_item = "'" . $item . "'";
    return $string_item;

}

/**
 * exists()
 * Method use dto check whether the particular row exists in the table inorder to check foreign key violation
 * @param $table_name: Table to be checked
 * @param $field_name: Field to be checked
 * @param int $condition: To check whether particular entry is there or not
 * @return bool : return true if the particular entry is preent in the specified table or return false
 * Eg: exists('semester','branch_id','branch_id =6') As branch_id is acting as a foreign key to semester table and branch_id = 6 is not present in Branch table
 */
function exists($table_name,$field_name,$condition=0){
    $field_name = convertToString($field_name);
    $query = "Select $field_name from $table_name where $condition";
    //die($query);
    $pdoObject = new PdoConnection();
    $connection = $pdoObject->connectPdo();
    $statement = $connection->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        return true;
    }
    return false;
}
