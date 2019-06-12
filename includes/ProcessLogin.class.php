<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 10-06-2019
 * Time: 19:49
 */
include_once("../helpers/Helper.class.php");

include_once ("../includes/PdoConnection.class.php");

class ProcessLogin{
    /**
     *This function is used for concatenating string with single quotes and returns the concatenated strings
     * Parameter :- String to be concatenated
     * Returns a new concatenated string
     */
    function convertToString($item){
        $string_item  = "'" .$item. "'";
        return $string_item;

    }
  /**
   *Checking the login credentials and redirecting it to the particular page depending upon the roles assigned and checking the entered username and password.
   *
   */
    function processLogin(){
        $helper = new Helper();
        if(isset($_POST['login'])){

            $username = $_POST['username'];
            $password = $_POST['password'];
            $pdoObject = new PdoConnection();
            $connection = $pdoObject->connectPdo();

            $username = $this->convertToString($username);
            echo "$username";
            $statement = $connection->prepare("select * from user where username=$username");

            $statement->execute();

            $db_password = "";

            while($row = $statement->fetch(PDO::FETCH_ASSOC)){

                $user_id = $row['user_id'];
                $db_password = $row['password'];

                $role_id = $row['role_id'];
            }

            if($password == $db_password){
                if(!isset($_SESSION['username'])){
                    session_start();
                }
                $_SESSION['user_id'] = $user_id;
                 $_SESSION['role_id'] = $role_id;
                if($role_id == 1) {
                    $statement = $connection->prepare("select * from teacher where user_id = $user_id");
                    $statement->execute();
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                        $teacher_id = $row['teacher_id'];
                        $_SESSION['teacher_id'] = $teacher_id;

                        header("Location: ".$helper->getPublic("teacher/index.php"));
                    }
                }


                elseif ($role_id == 2){
                    $statement = $connection->prepare("select * from student where user_id = $user_id");
                    $statement->execute();
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                        $student_id = $row['student_id'];
                        $_SESSION['student_id'] = $student_id;


                        header("Location: ".$helper->getPublic("student/index.php"));
                    }
                }

                elseif ($role_id == 3){
                    $statement = $connection->prepare("select * from parent where user_id = $user_id");
                    $statement->execute();
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        $parent_id = $row['parent_id'];
                        $_SESSION['parent_id'] = $parent_id;


                        header("Location: ".$helper->getPublic("parent/index.php"));
                    }
                }

                elseif($role_id == 4){

                    header("Location: ".$helper->getPublic("admin/index.php"));
                }


            }else{
                echo "LOGIN UNSUCCESFUL";
            }

        }
    }

}


?>