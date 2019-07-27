<?php
/*
 * Below functions are used to get the path of all the directory and files
 * */


class Helper{
    /*
     * Please give the Absolute path in the basePath variable till the folder structure
     * */
    public $basePath = "/mcq/";
    public function getBasePath(){

        return  $_SERVER["DOCUMENT_ROOT"].$this->basePath ;

    }
    public function getAssets($file=""){

        return $this->basePath.'assets/'.$file;
    }

//    public function getConfig($file=""){
//
//        return $this->basePath.'config/'.$file;
//    }

    public function getIncludes($file=""){

        return $this->basePath.'includes/'.$file;
    }
    public function getPublic($file=""){

        return $this->basePath.'public/'.$file;

    }
    public function getPages($file = ""){

        return $this->basePath.'pages/'.$file;
    }

    public function getModels($file=""){

        return $this->basePath.'/models/'.$file;

    }

}




/*
 * For testing
 *
 * */
//$helper = new Helper();
//$helper->getIncludes();





?>