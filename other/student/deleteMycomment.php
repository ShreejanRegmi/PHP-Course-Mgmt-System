<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


if(isset($_POST['dc_id'])){
    $delTable = new DatabaseTable('discussion_comment');
    $delTable->delete('dc_id',$_POST['dc_id']);

    echo 'Comment Deleted';
}


?>