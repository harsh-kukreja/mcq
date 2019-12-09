<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 02-11-2019
 * Time: 08:56 PM
 */
include_once($_SERVER["DOCUMENT_ROOT"]."/mcq/helpers/Helper.class.php");
$helper = new Helper();
include_once ($helper->getBasePath()."/includes/PdoConnection.class.php");
include_once ($helper->getBasePath()."/includes/Crud.class.php");

$pdoObject = new PdoConnection();
$pdo = $pdoObject->connectPdo();



?>
<div class="row py-4">
    <div class="col-md-12">
        <a href=user.php?source=add_branch class="btn btn-primary">Add</a>
    </div>
</div>
<div class="row" >
    <div class="col-md-12" >
        <div class="table-responsive" >
            <table class="table table-hover" >
                <thead >
                <tr >
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Batch</th>
                    <th></th>
                    <th></th>
                </tr >
                </thead >
                <tbody >
                <?php
                $pdoObject = new PdoConnection();
                $pdo = $pdoObject->connectPdo();
                $statement = $pdo->prepare($query="SELECT batch.batch_id,branch.branch_id,branch.branch_name,batch.batch_name,division.division_name from batch LEFT JOIN division ON batch.batch_id = division.division_id INNER JOIN branch ON division.branch_id = branch.branch_id where batch.deleted = 0");

                $statement->execute();
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){

                    $branch = $row['branch_name'];
                    $batch = $row['batch_name'];
                    $division = $row['division_name'];
                    $batch_id = $row['batch_id'];
                    $branch_id = $row['branch_id'];

                    echo <<<STUDENT
                        
<tr>

<td>$branch</td>
<td>$division</td>
<td>$batch</td>
<td><a href="user.php?source=edit_branch&branch_id=$branch_id" class="btn btn-info"><span class="fa fa-edit"></i></span></a></td>
<td><a href="user.php?source=delete_branch&batch_id=$batch_id" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
</tr>
STUDENT;
                }
                ?>
                </tbody >
            </table >
        </div >
    </div >
</div