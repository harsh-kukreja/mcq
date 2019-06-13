<?php
/**
 * Created by PhpStorm.
 * User: Harsh
 * Date: 13-06-2019
 * Time: 15:48
 */

include_once ("../helpers/Helper.class.php");

class ProcessLogout{
    function logout(){
        $helper = new Helper();

        session_destroy();
        header("Location: ".$helper->getPublic("index.php"));
    }
}

$logout = new ProcessLogout();
$logout->logout();