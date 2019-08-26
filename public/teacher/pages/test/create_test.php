<?php
/**
 * Created by PhpStorm.
 * User: Harsh
 * Date: 27-07-2019
 * Time: 18:18
 */


include_once ($helper->getBasePath()."includes/Crud.class.php");

$crud= new Crud();

$queryForBranchName="SELECT branch.branch_id ,branch.branch_name from branch WHERE branch_id=(SELECT branch_id FROM division WHERE division_id=(SELECT division_id FROM batch WHERE batch_id={$_GET["subject_id"]}))";

$rowForBranch = $crud->executeQuery($queryForBranchName);

$queryForSemesterName="SELECT semester.semester_id, semester.semester_number FROM semester WHERE semester.semester_id=(SELECT subject.semester_id FROM subject WHERE subject.subject_id={$_GET["subject_id"]})";

$rowForSemester=$crud->executeQuery($queryForSemesterName);

$queryForBatch="SELECT batch.batch_id,batch.batch_name from batch WHERE batch.batch_id={$_GET["batch_id"]}";

$rowForBatch=$crud->executeQuery($queryForBatch);

$queryForChapterName="SELECT chapter.chapter_id,chapter.chapter_name FROM chapter WHERE chapter.subject_id={$_GET["subject_id"]}";

$rowForChapter=$crud->executeQuery($queryForChapterName);




?>


<div class="container mt-1">

    <form action="<?php echo $helper->getPublic("teacher/test.php?source=display_test")?>" method="post">
        <input type="hidden" value="<?php echo $_GET["subject_id"]?>" name="subjectId">
<!--        Things to be passed is subject chapterName Chapter Id, SemesterId,SemesterName,BranchId BranchName ,BatchId,BatchName-->
        <div class=" form-row">
            <div class="form-group col-6">
                <label for="semester" class="form-control-label">Semester</label>
                <input type="hidden" value="<?php echo $rowForSemester[0]["semester_id"] ;?>">
                <input type="text" disabled value="<?php echo $rowForSemester[0]["semester_number"] ;
?>" class="form-control" name="semester" >
            </div>

            <div class="form-group col-6">
                <label for="branch" class="form-control-label">Branch</label>
                <input type="hidden" value="<?php echo $rowForBranch[0]["branch_id"] ;?>">
                <input type="text" disabled value="<?php echo $rowForBranch[0]["branch_name"] ;?>" class="form-control" name="branch">
            </div>
        </div>
        <div class=" form-row">
            <div class="form-group col-6">
                <label for="batch" class="form-control-label">Batch</label>
                <input type="hidden" value="<?php echo $rowForBatch[0]["batch_id"] ;?>">
                <input type="text" disabled value="<?php echo $rowForBatch[0]["batch_name"] ;?>" class="form-control" name="batch" >
            </div>

            <div class="form-group col-6">
                <label for="marks" class="form-control-label">Enter Test Marks</label>
                <input type="tel" class="form-control" name="marks" placeholder="Enter test marks" >

            </div>

        </div>


        <div class=" form-row">
            <div class="form-group col-6">
                <label for="type" class="form-control-label">Type</label>

                <select class="form-control " name="type">
                    <option disabled selected="true">Default select</option>
                    <option value="generate"> Generate Test</option>
                    <option value="auto-generate">Auto Generate</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="difficulty_level" class="form-control-label">Type</label>

                <select class="form-control " name="difficulty_level">
                    <option disabled selected="true">Default select</option>
                    <option value="1">Easy</option>
                    <option value="2">Medium</option>
                    <option value="3">Hard</option>
                </select>
            </div>


        </div>

        <?php
            //For Testing : print_r($rowForChapter);
            for($i=0;$i<sizeof($rowForChapter);$i++){
                $count=$i+1;
                echo <<<CHAPTER
                
                <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Chapter {$count}</span>
            </div>
            <input type="text"  class="form-control " name="chapter" value="{$rowForChapter[$i]["chapter_name"]}" disabled >
            <div class="input-group-append">
                <div class="input-group-text">
                    <input type="checkbox" name="chapterCheckbox[]" value="{$rowForChapter[$i]["chapter_id"]}">

                </div>
            </div>
        </div>
CHAPTER;


            }
        ?>


        <button class="btn btn-primary mb-6" type="submit" name="submit-test">Done</button>


    </form>

</div>
