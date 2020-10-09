<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


$contentFiles = new DatabaseTable($_POST['table']);
$contentFiles->delete($_POST['field'],$_POST['value']);

echo 'FileDeleted';


?>