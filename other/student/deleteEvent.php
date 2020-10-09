<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


if(isset($_POST['ev_id'])){
    $event = new DatabaseTable('eventsplans');
    $event->delete('ev_id',$_POST['ev_id']);

    echo 'eveDeleted';
}


?>