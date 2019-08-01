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
	print_r($questionAndOptions);


?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Options</th>
                        <th>Correct option</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>