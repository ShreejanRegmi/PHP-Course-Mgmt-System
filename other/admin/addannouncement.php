<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');

$output=[];
$announcement = new Table('announcement');
try {
    $announcement->groupProjectSave($_POST);
        $output['added']=true;   
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}
    echo json_encode($output);
    
    

?>


