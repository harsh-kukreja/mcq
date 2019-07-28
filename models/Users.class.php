<?php
/**
 * Created by PhpStorm.
 * User: Yukta
 * Date: 19/6/19
 * Time: 4:39 PM
 */


include_once ($_SERVER['DOCUMENT_ROOT']."/mcq/models/Roles.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/mcq/models/Person.class.php");

class Users extends Person implements Roles{
    public $pdo;
    function __construct(){
        include_once ($_SERVER['DOCUMENT_ROOT'] . "/mcq/includes/PdoConnection.class.php");
        $pdoObject = new PdoConnection();
        $this->pdo = $pdoObject->connectPdo();
    }

    public  $user_id,$username,$password;

    function checkFields(){}
    function  createUser(){}
    function deleteUser(){}
    function updateUser(){}
    function getUsername(){
        $username = '';

        //session_start();
        $stmt = "SELECT username from user where user_id = {$_SESSION['user_id']}";
        $statement = $this->pdo->query($stmt);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $username = $row['username'];
        }
        return $username;
    }



}