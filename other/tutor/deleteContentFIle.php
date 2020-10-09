<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


$contentFiles = new DatabaseTable('module_files');
$contentFiles->delete('mf_id',$_POST['mf_id']);

echo 'contentFileDeleted';


?>