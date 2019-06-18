<?php
/**
 * Created by PhpStorm.
 * User:
 * Date:
 * Time:
 */


require("../helpers/Helper.class.php");
//include_once ("getModels('Roles.class.php')");
//include_once("getModels('Person.php')");
class Users extends Person implements Roles{
    public  $user_id,$username,$password;

    function createUsername(){}
    function checkFields(){}
    function  createUser(){}
    function deleteUser(){}
    function updateUser(){}




}