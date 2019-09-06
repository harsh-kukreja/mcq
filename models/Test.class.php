<?php
/**
 * Created by PhpStorm.
 * User:Harsh
 * Date:
 * Time:
 */


class Test{
    public $helper,$pdoObject;
    public function __construct(){

        include_once ($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/helper.class.php");
        $this->helper= new Helper();
        include_once ($this->helper->getBasePath()."/includes/Crud.class.php");
        $this->pdoObject = new Crud();


    }
    function convertToString($item){
        $string_item  = "'" .$item. "'";
        return $string_item;

    }

    public function createTest($test_name,$teacher_id,$duration,$passing_marks,$total_marks,$start_time,$end_time,$type,$negative_marks,$subject,$created_by){
        $rows = array("test_name",
            "teacher_id",
            "duration",
            "passing_marks",
            "total_marks",
            "start_time",
            "end_time",
            "type",
            "negative_marks",
            "subject",
            "created_by"
        );
        $value=array($this->convertToString($test_name),
                     $teacher_id,
                     $this->convertToString($duration),
                     $this->convertToString($passing_marks),
                     $this->convertToString($total_marks),
                     $this->convertToString($start_time),
                     $this->convertToString($end_time),
                     $this->convertToString($type),
                     $this->convertToString($negative_marks),
                     $subject,
                     $created_by,
            );
        $this->pdoObject->insertDb("test",$rows,$value);

    }
    public function createTestChapter($test_id,$chapter_id){
        $rows=array("test_id","chapter_id");
        $values=array($test_id,$chapter_id);
        $this->pdoObject->insertDb("test_chapter",$rows,$values);
    }
    public function createTestQuestion($test_id,$subject_id,$question_id,$created_by){
        $rows=array("test_id","subject_id","question_id","created_by");
        $values=array($test_id,$subject_id,$question_id,$created_by);
        $this->pdoObject->insertDb("test_questions",$rows,$values);
    }

}

?>
