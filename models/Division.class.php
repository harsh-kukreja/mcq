<?php
/**
 * Created by PhpStorm.
 * User:
 * Date:
 * Time:
 */




class Division{
    public $division_id,$division_name;
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
        include_once($_SERVER["DOCUMENT_ROOT"] . "/mcq/helpers/Helper.class.php");
        $helper = new Helper();
        include_once($helper->getBasePath() . "/includes/Crud.class.php");
        include_once($helper->getBasePath() . "/includes/functions.php");
        $pdo = new Crud();
        return $pdo;
    }

    /**
     * @param $branch_id: Id of the branch which is to be created
     * @param $division_name: Name of the division want to create
     * @param $created_by: Id of the user who created the division
     * @param $updated_by: Id of the user who updated the division
     */
    function createDivision($branch_id,$division_name,$created_by,$updated_by,$deleted=0,$additional_description="null"){
        $rows = array("branch_id","division_name","created_by","updated_by","deleted","additional_description");
        $values = array(convertToSTring($branch_id),convertToSTring($division_name),convertToSTring($created_by),convertToSTring($updated_by),$deleted,$additional_description);
        if(exists("branch","branch_id","branch_id={$branch_id}"))
            $this->pdo->insertDb("division",$rows,$values);
        else
            echo "Foreign key violated";
    }

    /**
     *@param $branch_id: Id of the branch which is to be created
     * @param $division_name: Name of the division want to create
     * @param $created_by: Id of the user who created the division
     * @param $updated_by: Id of the user who updated the division
     * @param $condition:Condition that is to be checked for the updation
     */
    function updateDivision($branch_id,$division_name,$created_by,$updated_by,$condition,$deleted=0,$additional_description="null"){
        $field= array("branch_id = ".convertToString($branch_id),"division_name = ".convertToString($division_name),"created_by = ".convertToSTring($created_by),"updated_by = ".convertToSTring($updated_by),"deleted = ".convertToSTring($deleted),"additional_description = ".$additional_description);
        if(exists("branch","branch_id","branch_id={$branch_id}"))
            $this->pdo->updateDb("division",$field,$condition);
        else
            echo "Foreign key violated";
    }

    /**
     * @param $division_id: Method that deletes the division
     */
    function deleteDivision($division_id){
        $this->pdo->updateDb("division","deleted=1","division_id=$division_id");

    }

    /**
     * @param $division_id:
     * @return branch_id|null
     */
    function getBranch($division_id){
        $query = "SELECT branch_id FROM division WHERE division_id= $division_id";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $branch_id = $row['branch_id'];
            return $branch_id;
        }
        return null;
    }
    function getAllDivision(){
        $query = "SELECT * FROM division WHERE branch_id = '".$_POST['branch_id']."' ORDER BY division_name";
        $pdoObject = new PdoConnection();
        $connection  = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        $division = '';
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $division .= '<option value="'.$row["division_id"].'">'.$row["division_name"].'</option>';
        }
        return $division;
    }


}