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

if ($_POST["type"] === "auto-generate") {

    $question = $questionObject->getAllQuestionDetailsAndOptionsFromChapter("{$chapter_id}", "{$_POST["difficulty_level"]}");
    print_r($question);

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
                         <input type="hidden" value="{$value}" name="questionId[]" >

QUESTION;
            }
            print_r($_POST["chapterCheckbox"]);
            for ($i = 0; $i < sizeof($_POST["chapterCheckbox"]); $i++) {
                echo <<<CHAPTER
                         <input type="text" value="{$_POST['chapterCheckbox'][$i]}" name="chapterCheckbox[]">
CHAPTER;

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
                </thead>

                <tbody>

                <?php
                for ($i = 0; $i < sizeof($chapter_id); $i++) {
                    $question = $questionObject->getAllQuestionsFromChapter("$chapter_id[$i]");
//                    print_r($question);
                    $array_keys = array_keys($question);


                    for ($j = 0; $j < sizeof($array_keys); $j++) {
                        $count++;

                        echo <<<CHAPTER
<tr>
<td>$count </td>
<td>{$question[$array_keys[$j]]['question']}</td>
<td>{$question[$array_keys[$j]]['marks']}</td>
<td>{$question[$array_keys[$j]]['difficulty_level']}</td>
<td> <input type="checkbox" name="chapterCheckbox[]" value="{$array_keys[$j]}" ></td>
</tr>
CHAPTER;

                    }
                }
            }
      }
 }

                ?>
                </tbody>
            </table>
        </div>

        <div class="mb-5 text-center"> marks : <?php echo $_POST['marks']?></div>
    </form>
</div>
<script src="../../assets/js/jquery.min.js"></script>
<script>
    $(':checkbox').change(function () {
        alert("ji");
        if ($(this).is(':checked')) {
            console.log($(this).val() + ' is now checked');
        } else {
            console.log($(this).val() + ' is now unchecked');
        }
    });
</script>