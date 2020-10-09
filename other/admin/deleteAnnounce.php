<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


if(isset($_POST['ann_id'])){
    $announcement = new DatabaseTable('announcement');
    $announcement->delete('ann_id',$_POST['ann_id']);

    echo 'announceDeleted';
}


?>