<?php
if(isset($_POST['add'])){
    include_once($_SERVER["DOCUMENT_ROOT"] . "/mcq/helpers/Helper.class.php");
    $helper = new Helper();
    include_once($helper->getBasePath() . "/includes/functions.php");
    include_once($helper->getBasePath() . "/includes/PdoConnection.class.php");
    include_once($helper->getBasePath() . "/includes/Crud.class.php");

    $insert = new Crud();

    $role = $_SESSION['role_id'];
    $branch_name = $_POST['branch_name'];
    $branch_code = $_POST['branch_code'];
    $division = $_POST['addDivision'];
    $batch = $_POST['addBatch'];


    $insert_values = array("branch_name","branch_code","created_by");
    $output_values = array(convertToString($branch_name),convertToString($branch_code),convertToString($role));
    $insert->insertDb("branch",$insert_values,$output_values);

    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT branch_id FROM branch ORDER BY branch_id DESC LIMIT 1");
    $statement->execute();
    $branch_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $branch_id = $row["branch_id"];
    }

    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT branch_code FROM branch ORDER BY branch_id DESC LIMIT 1");
    $statement->execute();
    $branch_code = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $branch_code = $row["branch_code"];
    }





    $insert_values = array("branch_id","division_name","created_by");
    if($division == 1){
        $output_values = array(convertToString($branch_id),convertToString($branch_code.$division),convertToString($role));
        $insert->insertDb("division",$insert_values,$output_values);
    }elseif ($division == 2){
        for($i=1;$i<=$division;$i++){
            if($i == 1) {
                $output_values = array(convertToString($branch_id),convertToString($branch_code.$i),convertToString($role));
                $insert->insertDb("division", $insert_values, $output_values);
            }elseif ($i == 2){
                $output_values = array(convertToString($branch_id),convertToString($branch_code.$i),convertToString($role));
                $insert->insertDb("division", $insert_values, $output_values);
            }
        }
    }elseif($division == 3){
        for($i=1;$i<=$division;$i++){
            if($i == 1) {
                $output_values = array(convertToString($branch_id),convertToString($branch_code.$i),convertToString($role));
                $insert->insertDb("division", $insert_values, $output_values);
            }elseif ($i == 2){
                $output_values = array(convertToString($branch_id),convertToString($branch_code.$i),convertToString($role));
                $insert->insertDb("division", $insert_values, $output_values);
            }elseif ($i == 3){
                $output_values = array(convertToString($branch_id),convertToString($branch_code.$i),convertToString($role));
                $insert->insertDb("division", $insert_values, $output_values);
            }

        }
    }



    $pdoObject = new PdoConnection();
    $pdo = $pdoObject->connectPdo();
    $statement = $pdo->prepare($query = "SELECT division_id FROM division ORDER BY division_id DESC LIMIT 1");
    $statement->execute();
    $division_id = null;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $division_id = $row["division_id"];
    }






    $insert_values = array("division_id","batch_name","created_by");
    if($batch == 1){
        $output_values = array(convertToString($division_id),convertToString('A'),convertToString($role));
        $insert->insertDb("batch",$insert_values,$output_values);
    }elseif ($batch == 2){
        for($i=1;$i<=$batch;$i++){
            if($i == 1) {
                $output_values = array(convertToString($division_id),convertToString('A'),convertToString($role));
                $insert->insertDb("batch", $insert_values, $output_values);
            }elseif ($i == 2){
                $output_values = array(convertToString($division_id),convertToString('B'),convertToString($role));
                $insert->insertDb("batch", $insert_values, $output_values);
            }
        }
    }elseif($batch == 3){
        for($i=1;$i<=$batch;$i++){
            if($i == 1) {
                $output_values = array(convertToString($division_id),convertToString('A'),convertToString($role));
                $insert->insertDb("batch", $insert_values, $output_values);
            }elseif ($i == 2){
                $output_values = array(convertToString($division_id),convertToString('B'),convertToString($role));
                $insert->insertDb("batch", $insert_values, $output_values);
            }elseif ($i == 3){
                $output_values = array(convertToString($division_id),convertToString('C'),convertToString($role));
                $insert->insertDb("batch", $insert_values, $output_values);
            }

        }
    }





}
?>



<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col-12">

                <label for="" class="form-control-label">Add Branch</label>
            </div>

            <div class="col-12">
                <label  class="form-control-label" for="branch_name">Branch Name</label>
                <input class="form-control" type="text" placeholder="" name="branch_name" id="branch_name">

            </div>

            <div class="col-12">
                <label class="form-control-label" for="branch_code">Branch code</label>
                <input class="form-control" type="text" placeholder="" name="branch_code" id="branch_code">
            </div>


            <div class="col-12">
                <br>
                <label for="" class="form-control-label">Add Division</label>
            </div>

            <div class="col-12">
                <label  class="form-control-label" for="adDivision">Total divisions</label>
                <select name="addDivision" id="addDivision" class="form-control">
                    <option value=""></option>
                    <option value="1" class="form-control">1</option>
                    <option value="2" class="form-control">2</option>
                    <option value="3" class="form-control">3</option>
                </select>

            </div>

            <div class="col-12">
                <br>
                <label for="" class="form-control-label">Add Batch</label>
            </div>
            <div class="col-12">
                <label  class="form-control-label" for="addBatch">Total batches</label>
                <select name="addBatch" id="addBatch" class="form-control">
                    <option value=""></option>
                    <option value="1" class="form-control">1</option>
                    <option value="2" class="form-control">2</option>
                    <option value="3" class="form-control">3</option>
                </select>
            </div>

            <div class="col-12">
                <br>
                <button type="submit" class="btn btn-outline-primary" name="add" id="add">Add</button>
            </div>

        </div>
    </form>
</div>
