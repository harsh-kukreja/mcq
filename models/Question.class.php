<?php
/**
 * Created by PhpStorm.
 * User:
 * Date:
 * Time:
 */

include "../helpers/Helper.class.php";
include "../includes/PdoConnection.class.php";

class Question{
    public $question_id,$difficulty_level,$marks,$question,$option_correct_answer;
    function createQuestion(){}
    function deleteQuestion(){}
    function updateQuestion(){}
    function addQuestion(){}
    function getChapter(){}
    function getOption(){}
    
    
    /**
     * getAllQuestions():
     * Method that executes query to return all questions of all chapters of the given subject_id.
     *
     * @param $subject_id : Given subject_id for which the questions are needed.
	 * @param bool $random : Boolean default variable to indicate whether questions are required randomly or not.
     * @return array: Associative array that contains question_id as index and question text as value.
     */
    function getAllQuestions($subject_id, $random = false) {
        
        $query = "SELECT question.question_id, question.question FROM question
INNER JOIN chapter
ON chapter.chapter_id = question.chapter_id
WHERE chapter.subject_id = {$subject_id}";
    
        if ($random == true)
            $query .= "
            ORDER BY RAND()";
        
    
        $pdoconn = new PdoConnection();
        $pdo = $pdoconn->connectPdo();
        $rs = $pdo->query($query);
        $questions = array();
        while($row = $rs->fetch(PDO::FETCH_ASSOC)) {
            $questions[$row["question_id"]] = $row["question"];
        }
        
        return $questions;
        
    }
    
    /**
     * getAllQuestionsAndOptions():
     * Method that returns all questions along with their options of all chapters of a given subject_id.
     *
     * @param $subject_id : Given subject_id for which the questions are needed.
	 * @param bool $random : Boolean default variable to indicate whether questions are required randomly or not.
     * @return array : A 3-Dimensional Array that contains question_id, question text and all its option_id and their corresponding options.
     *
     *
     * Syntax:
     * Array (
     *      [question_id] =>
     *      Array (
     *          [question] => {question_text}
     *          [options] =>
     *          Array (
     *              [option_id] => {option}
     *              [option_id] => {option}
     *              [option_id] => {option}
     *          )
     *      )
     *
     * Example:
     * Array (
     *      [1] =>
     *      Array (
     *          [question] => Decrement operator, -- decreases the value of variable by what number?
     *          [options] =>
 *              Array (
 *                  [1] => 5
 *                  [2] => 2
 *                  [3] => 3
 *                  [4] => 4
 *                  [5] => 1
 *              )
     *      )
     * )
     */
    
    
    function getAllQuestionsAndOptions($subject_id, $random = false) {
        $query = "SELECT question.question_id, question.question, option.option_id, option.option FROM option, question
INNER JOIN chapter
ON chapter.chapter_id = question.chapter_id
WHERE option.question_id = question.question_id AND chapter.subject_id = {$subject_id}";
    
        if ($random == true)
            $query .= "
            ORDER BY RAND()";
    
        $pdoconn = new PdoConnection();
        $pdo = $pdoconn->connectPdo();
        $rs = $pdo->query($query);
        
        $questions = array();
        $prev_id = 0;
        
        while($row = $rs->fetch(PDO::FETCH_ASSOC)) {
            if ($row['question_id'] === $prev_id) {
                //If the entry is of the same question but has a different option.
                $questions[$prev_id]["options"][$row["option_id"]] = $row["option"];
            } else {
                //If the entry marks the start of the options of a new question.
                $questions[$row["question_id"]] = array("question" => $row["question"], "options" => array($row["option_id"] => $row["option"]));
                $prev_id = $row["question_id"];
            }
        }
        
        return $questions;
    }
    
    
	
	/**
	 * getAllQuestionsFromChapter():
	 * Method to return all questions in the db of a given chapter.
	 *
	 * @param $chapter_id : Given chapter_id.
	 * @param bool $random : Boolean default variable to indicate whether questions are required randomly or not.
	 * @return array : All questions from the given chapter in the form of an associative array.
	 */
    function getAllQuestionsFromChapter($chapter_id, $random = false) {
    	$query = "SELECT question.question_id, question.question FROM question WHERE question.chapter_id = {$chapter_id}";
	
		if ($random == true)
			$query .= "
            ORDER BY RAND()";
	
		$pdoconn = new PdoConnection();
		$pdo = $pdoconn->connectPdo();
		$rs = $pdo->query($query);
		$questions = array();
	
		while($row = $rs->fetch(PDO::FETCH_ASSOC)) {
			$questions[$row["question_id"]] = $row["question"];
		}
		
		return $questions;
    }
	
	/**
	 * getAllQuestionsAndOptionsFromChapter():
	 * Method that returns all questions along with their options of all chapters of a given chapter_id.
	 *
	 * @param $chapter_id : Given chapter_id.
	 * @param bool $random : Boolean default variable to indicate whether questions are required randomly or not.
	 * @return array : A 3-Dimensional Array that contains question_id, question text and all its option_id and their corresponding options.
	 */
    function getAllQuestionsAndOptionsFromChapter($chapter_id, $random = false) {
    	$query = "SELECT question.question_id, question.question, option.option_id, option.option FROM question, option
WHERE question.question_id = option.question_id AND question.chapter_id = {$chapter_id}";
	
		if ($random == true)
			$query .= "
            ORDER BY RAND()";
	
		$pdoconn = new PdoConnection();
		$pdo = $pdoconn->connectPdo();
		$rs = $pdo->query($query);
	
		$questions = array();
		$prev_id = 0;
	
		while($row = $rs->fetch(PDO::FETCH_ASSOC)) {
			if ($row['question_id'] === $prev_id) {
				//If the entry is of the same question but has a different option.
				$questions[$prev_id]["options"][$row["option_id"]] = $row["option"];
			} else {
				//If the entry marks the start of the options of a new question.
				$questions[$row["question_id"]] = array("question" => $row["question"], "options" => array($row["option_id"] => $row["option"]));
				$prev_id = $row["question_id"];
			}
		}
	
		return $questions;
	}
}

class Options{
    public $option,$option_id;

    function createOption(){}

}

/*

For Testing:
*/
$testobj = new Question();
print_r($testobj->getAllQuestionsAndOptionsFromChapter(39, false));

//*/