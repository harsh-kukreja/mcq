<?php
/**
 * Created by PhpStorm.
 * User:
 * Date:
 * Time:
 */

include_once ("Users.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/mcq/helpers/Helper.class.php");
$helper = new Helper();

class Teacher extends Users {
    public $teacher_id;
	public $helper;
 
	/**
	 * Teacher constructor.
	 * @param $teacher_id
	 */
	public function __construct($teacher_id)
	{
		$this->teacher_id = $teacher_id;
		$this->helper = new Helper();
	}
	
	
	function getBatch($teacher_id){
        $query = "Select batch_id from teaches where teacher_id = $teacher_id";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $batch_id = $row['batch_id'];
            return $batch_id;

        }
    }
    function getDivision($teacher_id){
        $query = "Select division_id from teaches where teacher_id = $teacher_id";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $division_id = $row['division_id'];
            return $division_id;

        }
    }
    
    function getSubjectsAndBatches() {
		/********************************************
		 * CODE TO RETRIEVE SIDENAV STRUCTURE DATA WITH
		 * SUBJECTS AND THE DIFFERENT BATCHES THAT
		 * THE LOGGED IN TEACHER.
		 *********************************************/
	
		/**
		 * COMMENTS:
		 *
		 * In the below code I have retrieved all the subjects that the logged in teacher teaches along with the different batches of that subject that the teacher teaches.
		 *
		 */
	
		$query = "SELECT teaches.subject_id, subject.subject_name, teaches.division_id, division.division_name, teaches.batch_id, batch.batch_name
FROM subject, teaches, division, batch
WHERE teaches.subject_id = subject.subject_id
AND teaches.division_id = division.division_id
AND teaches.batch_id = batch.batch_id
AND teaches.teacher_id = (SELECT teacher.teacher_id FROM teacher WHERE teacher.user_id =  {$this->teacher_id})";
	
		include_once ($this->helper->getBasePath()."includes/PdoConnection.class.php");
		$pdoconn = new PdoConnection();
		$pdo = $pdoconn->connectPdo();
		$rs = $pdo->query($query);
	
		$subjects = array();
		$prev_id = 0;
		include_once ($this->helper->getBasePath()."/models/Group.class.php");
		while($row = $rs->fetch(PDO::FETCH_ASSOC)) {
			if($row['subject_id'] === $prev_id) {
			
				//CODE TO APPEND DIVISION AND BATCH IN THE EXISTING SUBJECT_ID AND SUBJECT_NAME IN THE ARRAY.
			
				/*$subjects[$prev_id]["divisions"][$row['division_id']] = $row['division_name'];
				$subjects[$prev_id]["batches"][$row['batch_id']] = $row['batch_name'];*/
				array_push($subjects[$row['subject_id']]["classes"], new Group($row['division_id'], $row['division_name'], $row['batch_id'], $row['batch_name']));
			} else {
			
				//CODE TO CREATE NEW ROW OF SUBJECT_ID AND SUBJECT_NAME IN THE ARRAY AND ADD THE DIVISION AND BATCH OF THAT ROW IN THE ARRAY.
			
				$subjects[$row['subject_id']] = array("subject" => $row['subject_name'], "classes" => array());
				array_push($subjects[$row['subject_id']]["classes"], new Group($row['division_id'], $row['division_name'], $row['batch_id'], $row['batch_name']));
			
				$prev_id = $row["subject_id"];
			}
		}
	
		/**
		 * SYNTAX:
		 *
		 * ARRAY (
		 *      [subject_id] =>
		 *      ARRAY (
		"subject" => {subject_name}
		 *          "classes" => Array(
		[0] => Group Object()
		 *              [1] => Group Object()
		 *          )
		 *      )
		 * )
		 * */
		
		return $subjects;
	
	}
    
    function createTeacher(){}
    function deleteTeacher(){}
    function updateTeacher(){}
    function getTest(){}

}