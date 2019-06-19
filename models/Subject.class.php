<?php
/**
 * Created by PhpStorm.
 * User:
 * Date:
 * Time:
 */

class Subject{
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
        include_once "../includes/Crud.class.php";
        include_once "../includes/functions.php";
//        $helper->getIncludes("Crud.class.php");
        $pdo = new Crud();
        return $pdo;
    }

    /**
     * createSubject():
     * Method that creates a new subject
     * @param $semester_id: Semester id of the semester to which subject belongs
     * @param $subject_name: Name of the new subject
     * @param $created_by
     * @param $updated_by
     */

    function createSubject($semester_id,$subject_name,$created_by,$updated_by){

        $rows = array("semester_id","subject_name","created_by","updated_by");
        $values = array(convertToSTring($semester_id),convertToSTring($subject_name),convertToSTring($created_by),convertToSTring($updated_by));
        if(exists('semester','semester_id','semester_id ='.$semester_id))
            $this->pdo->insertDb("subject",$rows,$values);
        else
            echo "Foreign key violated";
    }

    /**
     * deleteSubject():
     * Method that is to be deleted
     * @param $subject_id : Subject that is to be deleted
     */

    function deleteSubject($subject_id){
        $this->pdo->updateDb("subject","deleted=1","subject_id=$subject_id");

    }

    /**
     * updateSubject()
     * Method that updates particular rows according to the condition
     * @param $semester_id
     * @param $subject_name
     * @param $created_by
     * @param $updated_by
     * @param $condition
     */

    function updateSubject($semester_id,$subject_name,$created_by,$updated_by,$condition){

        $field= array("semester_id = ".convertToString($semester_id),"subject_name = ".convertToString($subject_name),"created_by = ".convertToSTring($created_by),"updated_by = ".convertToSTring($updated_by));
        if(exists('semester','semester_id','semester_id ='.$semester_id))

            $this->pdo->updateDb("subject",$field,$condition);
        else
            echo "Foreign key violated";


    }

    /**
     * getSemester()
     * Method that returns the semester_number from semester table according to semester_id in subject table
     * @param $subject_id
     * @return mixed
     */
    function getSemester($subject_id){
        $query = "Select semester_number from semester where semester_id = (Select semester_id from subject where subject_id = $subject_id)";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $semester_number = $row['semester_number'];
            return $semester_number;

        }
    }


}