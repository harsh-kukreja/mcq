<?php
/**
 * Created by PhpStorm.
 * User: Yukta
 * Date: 19/6/19
 * Time: 4:30 PM
 */


class Person
{
    protected $person_id, $first_name,$last_name,$contact,$email,$address,$image;
    function includes(){
        include_once ($_SERVER['DOCUMENT_ROOT'] . "/mcq/includes/PdoConnection.class.php");
        $pdoObject = new PdoConnection();
        $pdo = $pdoObject->connectPdo();
        return $pdo;
    }
    function createPerson(){
        
    }
    function  deletePerson(){}
    function  updatePerson(){}
    function  getName(){
        $name = '';
        $pdo = $this->includes();
        //session_start();
        $stmt = "SELECT concat(concat(person.first_name, \" \"), person.last_name) as name FROM person WHERE person.person_id =( SELECT user.user_id FROM user WHERE user.user_id = {$_SESSION['user_id']})";
        $statement = $pdo->query($stmt);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['name'];
       }
        return $name;
    }
    function getDetails(){
        $pdo= $this->includes();
       // session_start();
        $stmt = "SELECT email,contact,first_name,last_name,about_me,address FROM person WHERE person.person_id =( SELECT user.user_id FROM user WHERE user.user_id = {$_SESSION['user_id']})";
        $statement = $pdo->query($stmt);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}