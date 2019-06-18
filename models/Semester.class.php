<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 17-06-2019
 * Time: 19:23
 */

class Semester{
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
        include_once ("../helpers/helper.class.php");
        $helper = new Helper();
        include "../includes/Crud.class.php";
//        $helper->getIncludes("Crud.class.php");
        $pdo = new Crud();
        return $pdo;
    }

    /**
     * createSemester():
     * Method that executes query to create a new semester i.e insert all the values into semester table for a new semester
     * @param $semester_number: The new semester number Eg:- 1,2,3,4,5,6,7,8
     * @param $branch_id : The branch id of which the semester is to be created
     * @param $created_by: The id of the user which has created the new semester
     * @param $updated_by: The id of the user which has updated the new semester
     * Eg:createSemester("1","0","5","1","1");
     */
    function createSemester($semester_number,$last_passed_semester,$branch_id,$created_by,$updated_by){

        $rows = array("semester_number","last_passed_semester","branch_id","created_by","updated_by");
        $values = array($this->convertToSTring($semester_number),$this->convertToSTring($last_passed_semester),$this->convertToSTring($branch_id),$this->convertToSTring($created_by),$this->convertToSTring($updated_by));

        $this->pdo->insertDb("semester",$rows,$values);
    }

    /**
     * updateSemester():
     * Method that updates the specific values into Semester table according to the condition
     * @param $semester_number: The semester Number to be updated
     * @param $last_passed_semester: The last passed semester to be updated
     * @param $branch_id: The branch id to be updated
     * @param $updated_by: The user id to be enterd by whom the Semester table is updated
     * @param $condition: The condition according to which the updation should take place
     * EG:updateSemester(1,1,1,1,'semester_id =1');
     *
     *
     */
    function updateSemester($semester_number,$last_passed_semester,$branch_id,$updated_by,$condition){

        $field= array("semester_number = ".$this->convertToString($semester_number),"last_passed_semester = ".$this->convertToString($last_passed_semester),"branch_id = ".$this->convertToSTring($branch_id),"updated_by = ".$this->convertToSTring($updated_by));

        $this->pdo->updateDb("semester",$field,$condition);

    }

    /**
     * deleteSemester():
     * Method that deletes a particular semester by changing tht deleted field in table from 0 to 1
     * @param $semester_id: The semester id of the semester that is to be deleted
     * Eg:- deleteSemester("45");
     */

    function deleteSemester($semester_id){

        $this->pdo->updateDb("semester","deleted=1","semester_id=$semester_id");
    }

    /**
     * getBranch():
     * Method that returns the branch id of the particular semester using semester id
     * @param $semester_id: The semester id of the semester of which branch is required
     * @return $branch_id: The branch id of the particular semester
     * Eg:- getBranch(9)
     */

    function getBranch($semester_id)
    {

        $query = "Select branch_id from semester where semester_id = $semester_id";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $branch_id = $row['branch_id'];
            return $branch_id;

        }

    }


}
