<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


if(isset($_POST['staff_id'])){
    $module = new DatabaseTable('staff');
    $module->delete('staff_id',(string)$_POST['staff_id']);

    echo 'tutorDeleted';
}


?>