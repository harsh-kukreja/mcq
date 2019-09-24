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

    /**
     *
     * @param $user_id :- Logged in User_id
     * @return array :- Details of tests scheduled for the specific user_id
     * Eg:- (Array ( [0] => Array ( [test_id] => 1 [test_name] => Java overview
     * [teacher_id] => 1 [duration] => 00:15:00 [passing_marks] => 4
     * [total_marks] => 15 [start_time] => 2019-09-24 23:40:00
     * [end_time] => 2019-09-24 23:45:00 [type] => 0
     * [negative_marks] => 0 [subject] => 20
     * [created_by] => 2 [created_at] => 2019-04-21 15:07:49
     *[updated_by] => 2 [updated_at] => 2019-04-21 15:07:49
     * [deleted] => 0 [additional_description] => ) )
     *
     */
    public function showUpcomingTest($user_id){
        $query = "select * from test where (start_time >= SYSDATE() or end_time >= SYSDATE()) and test_id  in (select test_id from test_participants where student_id  = (select student_id from student where user_id  = ".$user_id. "))";

        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();

        $tests = $statement->fetchAll(PDO::FETCH_ASSOC);


        return $tests;
    }

    /**
     * @param $teacher_id:- Id of specific teacher who has scheduled test for that particular user
     * @return array:- Name of teachet
     * Eg:- Array ( [0] => Array ( [first_name] => Kennedy [last_name] => Valencia ) )
     *
     */
    public function getTeacherName($teacher_id){
        $query = "select first_name,last_name from person where person_id  = (select person_id from user where user_id  = (select user_id from teacher where teacher_id = $teacher_id))";
        $pdoObject = new PdoConnection();
        $connection = $pdoObject->connectPdo();
        $statement = $connection->prepare($query);
        $statement->execute();
        $teacher_name = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $teacher_name;
    }

}

?>
