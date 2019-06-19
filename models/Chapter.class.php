<?php
/**
 * Created by PhpStorm.
 * User:
 * Date:
 * Time:
 */

class Chapter{
    public $chapter_id,$chapter_name;

    function createChapter(){}
    function updateChapter(){}
    function deleteChapter(){}
    function addChapter(){}
	
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

