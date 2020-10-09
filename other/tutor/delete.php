<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


$table = new DatabaseTable($_POST['table']);
$table->delete($_POST['field'],$_POST['value']);

echo 'Deleted';


?>