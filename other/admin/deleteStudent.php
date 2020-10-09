<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


if(isset($_POST['s_id'])){
    $students = new DatabaseTable('students');
    $students->delete('s_id',(string)$_POST['s_id']);

    echo 'studentDeleted';
}


?>