<?php
/**
 * Created by PhpStorm.
 * User: Harsh
 * Date: 24-08-2019
 * Time: 23:18
 */

if(isset($_POST["submit_test_details"])){

    //FOR TESTING
//    echo " TEST NAME: ".$_POST["test_name"];
//    echo "  PASSING MARKS:  ".$_POST["passing_marks"]."\n";
//    echo "  NEGATIVE mARKS: ".$_POST["negative_marks"]."\n";
  // echo "  TEST TIME ".$_POST["test_duration"]."\n";
//    echo "  START : ".$_POST["test_start_time"];
//    echo "   END : ".$_POST["test_end_time"];
//    print_r($_POST["questionId"]);
//    print_r($_POST["chapterCheckbox"]);
//    print_r($_POST["subjectId"]."\n");
//    print_r("Marks".$_POST["marks"]);
//    echo " USERID : ".$_SESSION["user_id"];



     include_once ($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
     $helper= new Helper();
     include_once ($helper->getBasePath()."/models/Test.class.php");
     include_once ($helper->getBasePath()."/includes/Crud.class.php");
     $crudObject= new Crud();
     $testObj = new Test();
    $_POST["test_start_time"]=str_replace("T"," ",$_POST["test_start_time"]);
    $_POST["test_end_time"]= str_replace("T"," ",$_POST["test_end_time"]);
    $rowForTeacherId = $crudObject->executeQuery("SELECT teacher.teacher_id FROM teacher WHERE user_id = ".$_SESSION["user_id"]);
    //echo( $rowForTeacherId[0]["teacher_id"]);
    //echo ($_POST["chapterCheckbox"]);

     $testObj->createTest($test_name            = $_POST["test_name"],
                          $teacher_id           =  $rowForTeacherId[0]["teacher_id"],
                          $duration             =  $_POST["test_duration"],
                          $passing_marks        =  $_POST["passing_marks"],
                          $total_marks          =  $_POST["marks"],
                          $start_time           =  $_POST["test_start_time"],
                          $end_time             =  $_POST["test_end_time"],
                          $type                 =  $_POST["type"],
                          $negative_marks       =  $_POST["negative_marks"],
                          $subject              =   $_POST["subjectId"],
                          $created_by           =  $rowForTeacherId[0]["teacher_id"]
     );

     $rowForTestId = $crudObject->executeQuery("SELECT test.test_id FROM test ORDER BY test.test_id DESC LIMIT 1 ");
     for( $i=0;$i<sizeof($_POST["chapterCheckbox"]);$i++){
         $testObj->createTestChapter($rowForTestId[0]["test_id"],$_POST["chapterCheckbox"][$i]);
     }
     if(isset($_POST['questionId'])){
         for($i=0;$i<sizeof($_POST["questionId"]);$i++){
             $testObj->createTestQuestion($rowForTestId[0]["test_id"],
                 $_POST["subjectId"],
                 $_POST["questionId"][$i],
                 $rowForTeacherId[0]["teacher_id"]
             );
         }
     } else if(isset($_POST['questionCheckbox'])){
         for($i=0;$i<sizeof($_POST["questionCheckbox"]);$i++){
             $testObj->createTestQuestion($rowForTestId[0]["test_id"],
                 $_POST["subjectId"],
                 $_POST["questionCheckbox"][$i],
                 $rowForTeacherId[0]["teacher_id"]
             );
         }
     }
}
?>

<div class="container">
    <form method="post">
       <?php

       if(isset($_POST['questionId'])) {
           foreach ($_POST["questionId"] as $value) {
               echo <<<QUESTION
                         <input type="hidden" value="{$value}" name="questionId[]" >

QUESTION;
           }
       }
       if(isset($_POST['questionCheckbox'])){
           foreach ($_POST["questionCheckbox"] as $value) {
               echo <<<QUESTION
                         <input type="hidden" value="{$value}" name="questionCheckbox[]" >

QUESTION;
           }
       }

       if(isset($_POST['chapterCheckbox'])) {
           for ($i = 0; $i < sizeof($_POST["chapterCheckbox"]); $i++) {
               echo <<<CHAPTER
                         <input type="hidden" value="{$_POST['chapterCheckbox'][$i]}" name="chapterCheckbox[]">
CHAPTER;
           }
       }
       ?>
        <input type="hidden" value="<?php print_r( $_POST["subjectId"])?>" name="subjectId">
        <input type="hidden" value="<?php print_r( $_POST["marks"])?>" name="marks">

<!--            CHANGE THE TYPE IF YOU WANT I HAVE SET IT MANUALLY-->

        <input type="hidden" value="<?php echo $_POST['type']?>" name="type">
        <div class="form-row">
            <div class="form-group col-6">
                <label for="test_name">Test Name</label>
                <input type="text" class="form-control" id="test_name" placeholder="Enter test Name" name="test_name">
            </div>
            <div class="form-group col-6">
                <label for="passing_marks">Passing Marks</label>
                <input type="tel" class="form-control" id="passing_marks" placeholder="Enter passing marks" value="<?php print_r( $_POST["marks"])?>" name="passing_marks">
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="negative_marks">Negative Marks</label>
                <input type="text" class="form-control" id="negative_marks" placeholder="Enter Negative marks" value="0" name="negative_marks">
            </div>
            <div class="form-group col-6">
                <label for="test_duration">Enter test Time in hr:min</label>
                <input type="time" class="form-control" id="test_duration"  name="test_duration" value="00:00:00" step="1" >
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-6">
                <label for="test_start_time">Enter Start time and date</label>
                <input type="datetime-local" class="form-control" id="test_start_time"  name="test_start_time" step="1" >
            </div>
            <div class="form-group col-6">
                <label for="test_end_time">Enter End time and date</label>
                <input type="datetime-local" class="form-control" id="test_end_time"  name="test_end_time" step="1" >
            </div>
        </div>

        <input type="submit" name="submit_test_details" value="Submit Test" class="btn btn-primary form-control offset-3 col-6">
    </form>
</div>
