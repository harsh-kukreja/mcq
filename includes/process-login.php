<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 10-06-2019
 * Time: 19:49
 */
include_once("../helpers/helper.php");
$helper= new Helper();

include_once ("../includes/PdoConnection.class.php");
function convertToString($item){
    $string_item  = "'" .$item. "'";
    return $string_item;

}
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $pdoObject = new PdoConnection();
    $connection = $pdoObject->connectPdo();

    $username = convertToString($username);
    echo "$username";
    $statement = $connection->prepare("select * from user where username=$username");
   // die("select * from user where username= '{$username}'");
    $statement->execute();
   // $statement->execute([$username]);
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
        $_SESSION['username'] = $user_id;
       // $_SESSION['role'] = $role;

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
            print_r($statement);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                $parent_id = $row['parent_id'];
                $_SESSION['parent_id'] = $parent_id;
                die("".header("Location: ".$helper->getPublic("parent/index.php")));

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

?>