<?php
/*
 * Below functions are used to get the path of all the directory and files
 * */


$basePath = "/mcq/";
function getBasePath(){
    global $basePath;
    return  $basePath;

}
function getAssets($file=""){
    global $basePath;
    return $basePath.'assets/'.$file;
}

function getConfig($file=""){
    global $basePath;
    return $basePath.'config/'.$file;
}

function getIncludes($file=""){
    global $basePath;
    return $basePath.'includes/'.$file;
}
function getPublic($file=""){
    global $basePath;
    return $basePath.'public/'.$file;

}
function getPages($file = ""){
    global $basePath;
    return $basePath.'pages/'/$file;
}


function getModels($file=""){
    global $basePath;
    return $basePath.'/models/'.$file;

}

/*
 * For testing
 *
 * */
//echo getBasePath();




?>