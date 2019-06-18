<?php
/**
 * Created by PhpStorm.
 * User:
 * Date:
 * Time:
 */

class Chapter
{
    public $pdo;


    public function __construct()
    {
        $this->pdo = $this->includes();
    }

    /**
     * includes():
     * Method that includes helper class and crud class
     * @return Crud class object
     * @param No parameters
     *
     */
    function includes()
    {
        include_once("../helpers/helper.class.php");
        $helper = new Helper();
        include "../includes/Crud.class.php";
        include_once "../includes/functions.php";
//        $helper->getIncludes("Crud.class.php");
        $pdo = new Crud();
        return $pdo;
    }

    /**
     * createChapter()
     * Method that creates a new chapter
     * @param $subject_id : Given subject_id of that chapter
     * @param $chapter_name : name of the chapter
     * @param $created_by
     * @param $updated_by
     * @param string $additional_description
     */
    function createChapter($subject_id, $chapter_name, $created_by, $updated_by, $additional_description = "null")
    {

        $rows = array("subject_id", "chapter_name", "created_by", "updated_by", "additional_description");
        $values = array(convertToSTring($subject_id), convertToString($chapter_name), convertToString($created_by), convertToString($updated_by), $additional_description);

        if(exists('subject','subject_id','subject_id = ' .$subject_id))
            $this->pdo->insertDb("chapter", $rows, $values);
        else
            echo "Foreign key violated";




    }

    /**
     * updateChapter():
     * Method used to update the chapter
     * @param $subject_id
     * @param $chapter_name
     * @param $created_by
     * @param $updated_by
     * @param $condition
     * @param string $additional_description
     */
    function updateChapter($subject_id, $chapter_name, $created_by, $updated_by, $condition, $additional_description = "null")
    {
        $field = array("subject_id = " .convertToString($subject_id), "chapter_name = " .convertToString($chapter_name), "created_by = " .convertToSTring($created_by), "updated_by = " .convertToSTring($updated_by));

        $this->pdo->updateDb("chapter", $field, $condition);

    }

    /**
     * deleteChapter()
     * Method used to delete the chapter
     * @param $chapter_id
     */
    function deleteChapter($chapter_id)
    {
        $this->pdo->updateDb("chapter", "deleted=1", "chapter_id=$chapter_id");


    }

    /**
     * getSubject()
     * Method used to get the subject_id of that particular chapter
     * @param $chapter_id
     * @return mixed
     */
    function getSubject($chapter_id)
    {
        $query = "Select subject_id from chapter where chapter_id = $chapter_id";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $subject_id = $row['subject_id'];
            return $subject_id;

        }
    }




	
	/**
	 * getChapter():
	 * Method to retrieve all chapters of a given subject from the db.
	 *
	 * @param $subject_id : Given subject_id.
	 * @return array : Associative array which contains chapter_id as index and chapter_name as value.
	 */

    function getChapter($subject_id){
    	$query = "SELECT chapter.chapter_id, chapter.chapter_name FROM chapter WHERE chapter.subject_id = {$subject_id}";
	
		$pdoconn = new PdoConnection();
		$pdo = $pdoconn->connectPdo();
		$rs = $pdo->query($query);
		
		$chapters = array();
		while($row = $rs->fetch(PDO::FETCH_ASSOC)) {
			$chapters[$row["chapter_id"]] = $row["chapter_name"];
		}
		return $chapters;
	}
}
/**
 * Example of violating foreign key
 */
$chap = new Chapter();
$chap->createChapter(21,'algebra','1',1);

