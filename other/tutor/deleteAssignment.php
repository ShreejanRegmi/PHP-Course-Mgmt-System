<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


$assignmentsT= new DatabaseTable('assignments');
$assignmentsT->delete('asn_id',$_POST['asn_id']);

echo 'assignDeleted';


?>