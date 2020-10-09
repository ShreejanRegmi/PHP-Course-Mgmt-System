<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');

$output=[];
$event = new Table('eventsplans');
try {
    $event->groupProjectSave($_POST);
        $output['eventAdded']=true;   
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}
    echo json_encode($output);
    
    

?>


