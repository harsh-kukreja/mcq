<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 24-06-2019
 * Time: 00:37
 */
?>

<div class="row" style="margin: 10px;">
    <div class="col-md-12">
        <form action="" method="post" role="form" enctype="multipart/form-data">
<!--            <legend>Add New Student</legend>-->
            <hr>
            <h2>Student Details</h2>
            <div class="form-group">
                <label for="student_name">Name</label>
                <input type="text" class="form-control" name="student_name" id="student_name">
            </div>


            <div class="form-group">
                <label for="student_address">Address</label>
                <textarea name="student_address" id="student_address" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="student_email">Email</label>
                <input type="email" class="form-control" name="student_email" id="student_email">
            </div>

            <div class="form-group">
                <label for="student_contact">Contact No</label>
                <input type="text" class="form-control" name="student_contact" id="student_contact">
            </div>

            <div class="form-group">
                <label for="student_branch">Branch</label>
                <select name="student_branch" id="student_branch" class="form-control">
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>

            <div class="form-group">
                <label for="student_semester">Semester No</label>
                <select name="student_semester" id="student_semester" class="form-control">
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>

            <div class="form-group">
                <label for="student_batch">Batch No</label>
                <select name="student_batch" id="student_batch" class="form-control">
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>


            <div class="form-group">
                <label for="student_image">Image</label>
                <input type="file" class="form-control-file" name="student_image" id="student_image">
            </div>
            <hr>
            <h2>Parent Details</h2>

            <div class="form-group">
                <label for="parent_name">Name</label>
                <input type="text" class="form-control" name="parent_name" id="parent_name">
            </div>

            <div class="form-group">
                <label for="parent_email">Email</label>
                <input type="email" class="form-control" name="parent_email" id="parent_email">
            </div>
            <div class="form-group">
                <label for="parent_contact">Contact</label>
                <input type="text" class="form-control" name="parent_contact" id="parent_contact">
            </div>

            <div class="form-group">
                <label for="parent_image">Image</label>
                <input type="file" class="form-control-file" name="parent_image" id="parent_image">
            </div>



            <button type="submit" name="student_add" id="student_add" class="btn btn-primary">Submit</button>


        </form>
    </div>
</div>
