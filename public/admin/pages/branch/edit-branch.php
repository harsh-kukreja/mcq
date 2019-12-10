<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/includes/PdoConnection.class.php");
include_once ($helper->getBasePath()."/includes/Crud.class.php");

if(isset($_GET['branch_id'])) {

        $edit = new Crud();
        if(isset($_POST['edit'])){



            include_once($helper->getBasePath() . "/includes/functions.php");
            include_once($helper->getBasePath() . "/includes/PdoConnection.class.php");
            include_once($helper->getBasePath() . "/includes/Crud.class.php");


            $edit = new Crud();

            $user_id = $_SESSION['user_id'];
            $branch_id = $_GET['branch_id'];
            $branch_name = $_POST['branch_name'];
            $branch_code = $_POST['branch_code'];
            $division_name = $_POST['division_name'];
            $batch_name= $_POST['batch_name'];

            $edit_branch = array("branch_name=".convertToString($branch_name),"branch_code=".convertToString($branch_code));
            $edit->updateDb("branch",$edit_branch,"branch_id=$branch_id");

            $pdoObject = new PdoConnection();
            $pdo = $pdoObject->connectPdo();
            $statement = $pdo->prepare($query = "SELECT division_id from division INNER JOIN branch ON division.branch_id = branch.branch_id WHERE branch.branch_id = $branch_id");
            $statement->execute();
            $division_id = null;
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $division_id = $row["division_id"];
            }

            $edit_division = array("division_name=".convertToString($division_name));
            $edit->updateDb("division",$edit_division,"division_id = $division_id");

            $pdoObject = new PdoConnection();
            $pdo = $pdoObject->connectPdo();
            $statement = $pdo->prepare($query = "SELECT batch_id from batch INNER JOIN division ON batch.division_id = division.division_id WHERE division.division_id = $division_id");
            $statement->execute();
            $batch_id = null;
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $batch_id = $row["batch_id"];
            }

            $edit_batch = array("batch_name=".convertToString($batch_name));
            $edit->updateDb("batch",$edit_batch,"batch_id = $batch_id");


        }
        $branch_id = $_GET['branch_id'];

        $pdoObject = new PdoConnection();
        $pdo = $pdoObject->connectPdo();
        $statement = $pdo->prepare($query="SELECT branch.branch_name,branch.branch_code,division.division_name,batch.batch_name from batch INNER JOIN division ON batch.division_id = division.division_id INNER JOIN branch ON division.branch_id = branch.branch_id WHERE branch.branch_id = $branch_id");
        $statement->execute();

        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $branch_name = $row['branch_name'];
            $branch_code = $row['branch_code'];
            $division_name = $row['division_name'];
            $batch_name = $row['batch_name'];
        }

    ?>

    <div class="container">
        <form action="view-all-branch.php" method="post" role="form" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-12">
                    <label for="" class="form-control-label">Edit Branch</label>
                </div>

                <div class="col-12">
                    <label class="form-control-label" for="branch_name">Branch Name</label>
                    <input class="form-control" value="<?php echo $branch_name;?>" type="text" placeholder="" name="branch_name"
                           id="branch_name">
                </div>

                <div class="col-12">
                    <label class="form-control-label" for="branch_code">Branch Code</label>
                    <input class="form-control" value="<?php echo $branch_code;?>" type="search" placeholder="" name="branch_code"
                           id="branch_code">
                </div>

                <div class="col-12">
                    <label class="form-control-label" for="division_name">Division Name</label>
                    <input class="form-control" value="<?php echo $division_name;?>" type="search" placeholder="" name="division_name"
                           id="division_name">
                </div>


                <div class="col-12">
                    <label class="form-control-label" for="batch_name">Batch Name</label>
                    <input class="form-control" value="<?php echo $batch_name;?>" type="search" placeholder="" name="batch_name"
                           id="batch_name">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-outline-primary" name="edit" id="edit">Edit</button>
                </div>



            </div>
        </form>


    </div>
    <?php
    }
    ?>