<?php
header('Content-type: application/json');
require '../db/dbconnect.php';
require '../classes/Table.php';
    
   $output=[];
if(isset($_POST['table'])){
    $tables = new Table($_POST['table']);
    $tableSpecific=$tables->groupProjectFind($_POST['field'],$_POST['value']);
    $t=$tableSpecific->fetch(PDO::FETCH_OBJ);
        echo json_encode($t);
   }

?>