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
        $values = array(convertToSTring($semester_number),convertToSTring($last_passed_semester),convertToSTring($branch_id),convertToSTring($created_by),convertToSTring($updated_by));
        if(exists('branch','branch_id','branch_id ='.$branch_id))
            $this->pdo->insertDb("semester",$rows,$values);
        else
            echo "Foreign key violated";
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
    function updateSemester($semester_number,$last_passed_semester,$branch_id,$created_by,$updated_by,$condition){

        $field= array("semester_number = ".convertToString($semester_number),"last_passed_semester = ".convertToString($last_passed_semester),"branch_id = ".convertToSTring($branch_id),"created_by = ".convertToString($created_by),"updated_by = ".convertToSTring($updated_by));
        if(exists('branch','branch_id','branch_id ='.$branch_id))
            // $this->pdo->insertDb("semester",$rows,$values);
            $this->pdo->updateDb("semester",$field,$condition);
        else
            echo "Foreign key violated";


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

        $query = "Select branch_name from branch where branch_id = (Select branch_id from semester where semester_id = $semester_id)";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $branch_name = $row['branch_name'];
            return $branch_name;

        }

    }

    function getAllSemester(){
        $query = "SELECT * FROM semester WHERE branch_id = '".$_POST['branch_id']."' Order BY semester_number";
        $pdoObject = new PdoConnection();
        $connection  = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        $semester = '';
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){

            $semester .= '<option value="'.$row["semester_id"].'">'.$row["semester_number"].'</option>';
        }
        return $semester;
    }

}
//$sem = new Semester();
//$sem->createSemester(1,0,5,1,1);
