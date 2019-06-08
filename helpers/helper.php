<?php
/*
 * Below functions are used to get the path of all the directory and files
 * */


function getBasePath(){
    return __DIR__.'/../';

}
function getAssets($file=""){
    return '../assets/'.$file;
}

function getConfig($file=""){
    return '../config/'.$file;
}

function getIncludes($file=""){
    return '../includes/'.$file;
}
function getPublic($file=""){
    return '../public/'.$file;

}


function getModels($file=""){
    return __DIR__.'/../models/'.$file;

}

/*
 * For testing
 *
 * */
//echo getPublic();




?>