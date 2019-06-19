<?php
/**
 * Created by PhpStorm.
 * User: Harsh
 * Date: 26-04-2019
 * Time: 19:46
 */

function startSession(){
    if(session_status() == PHP_SESSION_NONE){
        //ob_start();
        session_start();
    }

}
