<?php 

require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');

    $output=[];
    $assignment= new Table('assignments');
    try {
        $assignment->groupProjectSave($_POST);
            $output['newAssignAdded']=true;   
    }
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
    echo json_encode($output);
        
?>