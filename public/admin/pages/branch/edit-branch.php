<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/includes/PdoConnection.class.php");
include_once ($helper->getBasePath()."/includes/Crud.class.php");

if(isset($_GET['branch_id'])) {

        $edit = new Crud();


        $branch_id = $_GET['branch_id'];

        $pdoObject = new PdoConnection();
        $pdo = $pdoObject->connectPdo();
        $statement = $pdo->prepare($query="SELECT division.division_id,batch.batch_id,branch.branch_id,branch.branch_name,branch.branch_code,division.division_name,batch.batch_name from branch INNER JOIN division ON branch.branch_id = division.division_id INNER JOIN batch ON division.division_id = batch.batch_id WHERE branch.branch_id = $branch_id");
        $statement->execute();

        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $branch_name = $row['branch_name'];
            $branch_code = $row['branch_code'];
            $division_name = $row['division_name'];
            $batch_name = $row['batch_name'];
        }

    ?>

    <div class="container">
        <form action="" method="post" role="form" enctype="multipart/form-data">
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




            </div>
        </form>


    </div>
    <?php
}
    ?>