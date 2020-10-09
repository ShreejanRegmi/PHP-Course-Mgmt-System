<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


$contentModules= new DatabaseTable('module_content');
$contentModules->delete('mc_id',$_POST['mc_id']);

echo 'contentModuleDeleted';


?>