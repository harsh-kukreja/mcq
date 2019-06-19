<?php
/**
 * Created by PhpStorm.
 * User:
 * Date:
 * Time:
 */

class Branch{

    public $pdo;
    public function __construct(){
        $this->pdo = $this->includes();
    }

    /**
     * includes():
     * Method that includes helper class and crud class
     * @return Crud class object
     * @param No parameters
     *
     */

    function includes(){
        include_once ("../helpers/helper.class.php");
        $helper = new Helper();
        include "../includes/Crud.class.php";
        include_once "../includes/functions.php";
//        $helper->getIncludes("Crud.class.php");
        $pdo = new Crud();
        return $pdo;
    }

    /**
     * createBranch():
     * Method that creates a new branch
     * @param $branch_name: Name of a branch
     *        Eg: "Computer Engineering"
     * @param $branch_code: Code of a branch
     *        Eg: "CO"
     * @param $created_by
     * @param $updated_by
     * @param $additional_description
     * Eg: createBranch("Civil Engineering","CE",1,1);
     */
    function createBranch($branch_name,$branch_code,$created_by,$updated_by,$additional_description = "null"){

        $rows = array("branch_name","branch_code","created_by","updated_by","additional_description");
        $values = array(convertToSTring($branch_name),convertToString($branch_code),convertToString($created_by),convertToString($updated_by),$additional_description);
        $this->pdo->insertDb("branch",$rows,$values);
    }


    /**
     * deleteBranch():
     * Method that deletes branch
     * @param $branch_id: branch_id that is to be deleted
     */
    function deleteBranch($branch_id){
        $this->pdo->updateDb("branch","deleted=1","branch_id=$branch_id");

    }

    /**
     * updateBranch()
     * Method to update a particular branch
     * @param $branch_name: Name of a branch that is to be updated
     * @param $branch_code: Code of a branch that is to be updated
     * @param $created_by
     * @param $updated_by
     * @param $condition: condition that is to be checked
     * @param $additional_description
     * Eg: updateBranch("Civil Engineering","CE",1,1,'branch_id = 8')
     */
    function updateBranch($branch_name,$branch_code,$created_by,$updated_by,$condition,$additional_description = "null"){
        $field= array("branch_name = ".convertToString($branch_name),"branch_code = ".convertToString($branch_code),"created_by = ".convertToString($created_by),"updated_by = ".convertToString($updated_by));
        $this->pdo->updateDb("branch",$field,$condition);
    }


}
//$branch = new Branch();
//$branch->createBranch('Civil Engineering','CE',1,1);
