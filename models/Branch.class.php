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
     * convertToString():
     * Method that converts a item variable into  a string
     * @param $item : The statement which is to converted into string
     * @return string: The statement that has been converted into string
     */


    function convertToString($item){
        $string_item  = "'" .$item. "'";
        return $string_item;

    }

    /**
     * includes():
     * Method that includes helper class and crud class
     * @return Crud class object
     * @param No parameters
     *
     */
    function includes(){
        include_once($_SERVER["DOCUMENT_ROOT"] . "/mcq/helpers/Helper.class.php");
        $helper = new Helper();
        include_once($helper->getBasePath() . "/includes/Crud.class.php");
        include_once($helper->getBasePath() . "/includes/functions.php");
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
        $values = array($this->convertToSTring($branch_name),$this->convertToString($branch_code),$this->convertToString($created_by),$this->convertToString($updated_by),$additional_description);
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
        $field= array("branch_name = ".$this->convertToString($branch_name),"branch_code = ".$this->convertToString($branch_code),"created_by = ".$this->convertToString($created_by),"updated_by = ".$this->convertToString($updated_by));

        $this->pdo->updateDb("branch",$field,$condition);
    }

    function getAllBranch(){
        $query = "SELECT * FROM branch ORDER BY branch_name";
        $pdoObject = new PdoConnection();
        $connection  = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        $branch ='';
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $branch .= '<option value="'.$row["branch_id"].'">'.$row["branch_name"].'</option>';
        }
        return($branch);
    }




}
//$branch = new Branch();
//$branch->updateBranch("Civil Engineering","CE",1,1,'branch_id = 8');