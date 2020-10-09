<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


if(isset($_POST['request_id'])){
    $requestT = new DatabaseTable('requests');
    $requestT->delete('request_id',$_POST['request_id']);

    echo 'requestDeleted';
}


?>