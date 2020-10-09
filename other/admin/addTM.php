<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/password.php';
header('Content-Type: application/json');

$output=[];
$tm = new Table('teacher_modules');
try {
    $tm->groupProjectInsert($_POST);
        $output['TMAdded']=true;   
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}
    echo json_encode($output);




?>