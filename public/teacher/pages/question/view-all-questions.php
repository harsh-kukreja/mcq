<div class="container">
<div class="row py-4">
    <div class="col-md-12">
        <a href="question.php?source=add_question" class="btn btn-primary">Add Question</a>
    </div>
</div>


<?php
	
	/*$query = "SELECT question.question_id, question.question, question.difficulty_level, question.marks, question.chapter_id, chapter.chapter_name, option_correct_answer.option_id as correct_option_id, option.option as correct_option
FROM question
INNER JOIN option_correct_answer
ON question.question_id = option_correct_answer.question_id
INNER JOIN option
ON option_correct_answer.option_id = option.option_id
INNER JOIN chapter
ON question.chapter_id = chapter.chapter_id
WHERE chapter.subject_id = 20
ORDER BY chapter.chapter_id";*/
	
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/mcq/helpers/Helper.class.php");
	$helper = new Helper();
	include_once ($helper->getBasePath() . "models/Question.class.php");
	$questions = new Question();
	$questionAndOptions =  $questions->getAllQuestionsAndOptions($_GET['subject_id']);
	$correct_options = $questions->getAllCorrectOptions($_GET['subject_id']);
//	print_r($questionAndOptions);
//	print_r($correct_options);
	

?>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Question</th>
                        <th>Options</th>
                        <th>Correct option</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $array_size = sizeof($questionAndOptions);
                        $array_keys = array_keys($questionAndOptions);
                        for ($i = 0; $i<$array_size;$i++) {
                            $count = $i + 1;
                            echo <<<TABLE
<tr>
    <td>$count</td>
    <td>{$questionAndOptions[$array_keys[$i]]['question']}</td>
TABLE;
                            
                            //PRINT OPTIONS IN COMMA SEPERATED FORM
                            $optionString = "";
                            foreach ($questionAndOptions[$array_keys[$i]]['options'] as $option) {
	                            $optionString .= $option . ", ";
                            }
                            //Trim the last ,
                            $optionString = substr($optionString, 0, -2);
                            echo "<td>$optionString</td>\n";
                            
                            //PRINT CORRECT OPTION FROM correct_options array
                            
                            $correct_options_count = count($correct_options);
	                        for ($j = 0; $j<$correct_options_count; $j++) {
                                if ($correct_options[$j]->question_id == $array_keys[$i]) {
                                    echo "<td>{$correct_options[$j]->correct_option}</td>\n";
                                }
                            }
                            
                            echo <<<BUTTONS
    <td><a href="question.php?source=edit_question&question_id={$array_keys[$i]}" class="btn btn-primary" role="button"><span class="fa fa-edit"></span></a></td>
</tr>\n
BUTTONS;


                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>