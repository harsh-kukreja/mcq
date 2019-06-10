<?php
/**
 * Created by PhpStorm.
 * User: Yukta
 * Date: 6/9/2019
 * Time: 4:38 PM
 */
include_once("../config/config.php");


class PdoConnection
{
    public function connectPdo(){
        $hostname = DB_HOST;
        $db = DB_NAME;
        $dsn = "mysql:host=$hostname;dbname=$db";

        try{
            $pdo = new PDO($dsn,DB_USER,DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        } catch(PDOException $e){
            echo $e;
        }
        return $pdo;
    }

}