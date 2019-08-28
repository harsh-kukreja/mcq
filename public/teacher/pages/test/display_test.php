<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once($helper->getBasePath() . "models/Question.class.php");
$questionObject = new Question();

if (isset($_POST["submit-test"])) {
if (isset($_POST["chapterCheckbox"])) {
    $marks = (int)$_POST["marks"];
    $initialMarks = 0;
    $questionIdArray = array();
//print_r($_POST["chapterCheckbox"]);
    $chapter_id = implode(",", $_POST["chapterCheckbox"]);

    if ($_POST["type"] === "1") {

        $question = $questionObject->getAllQuestionDetailsAndOptionsFromChapter("{$chapter_id}", "{$_POST["difficulty_level"]}");

        ?>
        <div class="container">
            <form action="test.php?source=test_details" method="post">

                <div class="table-responsive py-4">
                    <table class="table table-flush" id="table_id" class="display">
                        <thead class="thead-light">
                        <tr>
                            <th>Question</th>
                            <th>Option</th>
                            <th>Marks</th>
                            <th>Difficulty Level</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $array_size = sizeof($question);
                        $array_keys = array_keys($question);
                        $count = 0;
                        for ($i = 0; $i < $array_size && $marks >= $initialMarks; $i++) {
                            if (($question[$array_keys[$i]]['marks'] + $initialMarks) <= $marks) {
                                $count++;
                                array_push($questionIdArray, $array_keys[$i]);
                                echo <<<TABLE
                        <tr id="row-{$array_keys[$i]}">
                             <td>$count</td>
                             <td>{$question[$array_keys[$i]]['question']}  </td>
                             <td>{$question[$array_keys[$i]]['marks']}</td>
                             <td>{$question[$array_keys[$i]]['difficulty_level']}</td>
                             
                        </tr>
TABLE;
                                $initialMarks += (int)$question[$array_keys[$i]]['marks'];
                            }
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center"><p class="font-weight-bold">Total marks
                        are: <?php echo $initialMarks . "/" . $_POST["marks"] ?></p></div>
                <input type="hidden" value="<?php echo $_POST["marks"] ?>" name="marks">
                <?php
                foreach ($questionIdArray as $value) {
                    echo <<<QUESTION
                         <input type="text" value="{$value}" name="questionId[]" >

QUESTION;
                }
                print_r($_POST["chapterCheckbox"]);
                for ($i = 0; $i < sizeof($_POST["chapterCheckbox"]); $i++) {
                    echo <<<CHAPTER
                         <input type="text" value="{$_POST['chapterCheckbox'][$i]}" name="chapterCheckbox[]">
CHAPTER;

                }
                if(isset($_POST['type'])){
                    echo <<<MARKS
            <input type="text" value="{$_POST['type']}" name="type">
MARKS;
                }
                ?>

                <input type="hidden" value="<?php echo $_POST["subjectId"] ?>" name="subjectId">
                <div class="form-group col-6 offset-3 ">
                    <input type="submit" name="submit" class="form-control btn btn-primary ">
                </div>

            </form>
        </div>

        <?php
    }//END of chapterCheckbox if

    else {
        $chapter_id = $_POST["chapterCheckbox"];
        $question = "";
        $count = 0;
//         print_r($chapter_id[1]);

        ?>
        <div class="container">
        <form action="test.php?source=test_details" method="post" id="myForm">

        <div class="table-responsive py-4">
        <table class="table table-flush" id="table_id" class="display">
        <thead class="thead-light">

        <th>Sr.</th>
        <th>Question</th>
        <th>Marks</th>
        <th>Difficulty Level</th>
        <th>Select</th>
        <th></th>

        </thead>

        <>

        <?php
        for ($i = 0; $i < sizeof($chapter_id); $i++) {
            $question = $questionObject->getAllQuestionsFromChapter("$chapter_id[$i]");

            $array_keys = array_keys($question);
            $marksCount = 0;

            for ($j = 0; $j < sizeof($array_keys); $j++) {
                $count++;

                echo <<<CHAPTER
<tr>
<td>$count </td>
<td>{$question[$array_keys[$j]]['question']}</td>
<td>{$question[$array_keys[$j]]['marks']}</td>
<td>{$question[$array_keys[$j]]['difficulty_level']}</td>
<td> <input type="checkbox" name="questionCheckbox[]" value="{$array_keys[$j]}" ></td>
<td><input type="text" value="{$question[$array_keys[$j]]['marks']}" id="question{$array_keys[$j]}" disabled hidden ></td>

</tr>
CHAPTER;

            }
        }
    ?>
    </tbody>
    </table>
    </div>
<?php

            if(isset($_POST['chapterCheckbox'])) {
            for ($i = 0; $i < sizeof($_POST["chapterCheckbox"]); $i++) {
            echo <<<CHAPTER
            <input type="text" value="{$_POST['chapterCheckbox'][$i]}" name="chapterCheckbox[]">
CHAPTER;
            }
            }

            if(isset($_POST['marks'])){
                echo <<<MARKS
            <input type="text" value="{$_POST['marks']}" name="marks">
MARKS;
            }
if(isset($_POST['type'])){
    echo <<<MARKS
            <input type="text" value="{$_POST['type']}" name="type">
MARKS;
}
if(isset($_POST['subjectId'])){
    echo <<<MARKS
            <input type="text" value="{$_POST['subjectId']}" name="subjectId">
MARKS;
}
            ?>
    <div class="mb-5 text-center" id="mark">Marks : <span id="marksCount"
                                                          name="marksCount"></span>/<?php echo $_POST['marks'] ?></div>
    <div class="form-group col-6 offset-3 ">
        <input type="submit" name="submit" class="form-control btn btn-primary ">
    </div>

    </form>
    </div>
    <?php


    }

}
 }

                ?>

<script src="../../assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var markCount = 0;
        $(':checkbox').click(function (e) {

            if ($(this).is(':checked')) {

                var selected = "question"+$(this).val();

                var marks = Number($('#'+selected).val());

                var totalMarks = Number(<?php echo $_POST['marks']?>);
                var extraMarks = markCount + marks;

                if(markCount < totalMarks && extraMarks <= totalMarks ){
                    markCount +=marks;
                }else{
                    e.preventDefault();
                    alert("exceded mark count");
                }
                $.ajax({
                    type: 'post',
                    data: {selectedCheckbox:selected} ,
                    contentType: 'application/json; charset=utf-8',
                    success: function(response){
                        $('#marksCount').html(markCount);
                    }
                });


            } else {

                var selected = "question"+$(this).val();

                var marks = Number($('#'+selected).val());

                markCount -= marks;
                $.ajax({
                    type: 'post',
                    data: {selectedCheckbox:selected} ,
                    contentType: 'application/json; charset=utf-8',
                    success: function(response){
                        $('#marksCount').html(markCount);
                    }
                });
            }
        });
    });

</script>