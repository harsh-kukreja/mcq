<?php
/**
 * Created by PhpStorm.
 * User:Harsh
 * Date:
 * Time:
 */

class Batch{
    public $batch_id,$batch_name;

    public $pdo;
    public function __construct(){
        $this->pdo = $this->includes();
    }

<<<<<<< HEAD
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
=======
>>>>>>> 0720768f8d52d4cf22f523b1c7de3471eba8a863

    /**
     * includes():
     * Method that includes helper class and crud class
     * @return Crud class object
     * @param No parameters
     *
     */
    function includes(){
        include_once ("../helpers/helper.class.php");
        include "../includes/Crud.class.php";
<<<<<<< HEAD
=======
        include_once "../includes/functions.php";
>>>>>>> 0720768f8d52d4cf22f523b1c7de3471eba8a863
        $pdo = new Crud();
        return $pdo;
    }

    /**
     * createBatch():
     * Method that executes query to create a new semester i.e insert all the values into semester table for a new semester
     * @param $division_id: The division id of which the batch is to be created
     * @param $batch_name: The name of the batch
     * @param $created_by: The id of the user which has created the new batch
     * @param $updated_by: The id of the user which has updated the new batch
     *
     * Eg:createBatch("1","A","1","1");
     */

    function createBatch($division_id,$batch_name,$created_by,$updated_by,$deleted=0,$additional_description="null"){
        $rows = array("division_id","batch_name","created_by","updated_by","deleted","additional_description");
<<<<<<< HEAD
        $values = array($this->convertToSTring($division_id),$this->convertToSTring($batch_name),$this->convertToSTring($created_by),$this->convertToSTring($updated_by),$deleted,$additional_description);
=======
        $values = array(convertToSTring($division_id),convertToSTring($batch_name),convertToSTring($created_by),convertToSTring($updated_by),$deleted,$additional_description);
>>>>>>> 0720768f8d52d4cf22f523b1c7de3471eba8a863

        $this->pdo->insertDb("batch",$rows,$values);

    }

    /**
     * @param $division_id: The division id of which the batch is to be created
     * @param $batch_name: The name of the batch
     * @param $created_by: The id of the user which has created the new batch
     * @param $updated_by: The id of the user which has updated the new batch
     * @param $condition: Condition that is to be checked for the updation
     * @param string $additional_description
     * updateBatch("1","A","1","1","batch_id=1")
     */
    function updateBatch($division_id,$batch_name,$created_by,$updated_by,$condition,$additional_description="null"){

<<<<<<< HEAD
        $field= array("division_id = ".$this->convertToString($division_id),"batch_name = ".$this->convertToString($batch_name),"created_by = ".$this->convertToSTring($created_by),"updated_by = ".$this->convertToSTring($updated_by),"additional_description = ".$additional_description);
=======
        $field= array("division_id = ".convertToString($division_id),"batch_name = ".convertToString($batch_name),"created_by = ".convertToSTring($created_by),"updated_by = ".convertToSTring($updated_by),"additional_description = ".$additional_description);
>>>>>>> 0720768f8d52d4cf22f523b1c7de3471eba8a863

        $this->pdo->updateDb("batch",$field,$condition);

    }

    /**
     * @param $batch_id: Method that deletes the batch
     * deleteBatch("21")
     */
    function deleteBatch($batch_id){
        $this->pdo->updateDb("batch","deleted=1","batch_id=$batch_id");

    }


    /**
     * @param $batch_id: return division_id of particular batch
     * @return $division_id|null
     * getDivision("21");
     */
    function getDivision($batch_id){
<<<<<<< HEAD
        $query = "Select division_id from batch where batch_id = $batch_id";
=======
        $query = "SELECT division_id FROM batch WHERE batch_id = $batch_id";
>>>>>>> 0720768f8d52d4cf22f523b1c7de3471eba8a863
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $division_id = $row['division_id'];
            return $division_id;
        }
        return null;
    }
}
