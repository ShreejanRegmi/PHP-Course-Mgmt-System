<?php 

require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');

    $output=[];
    $read= new Table('readingresources');
    try {
        $read->groupProjectSave($_POST);
            $output['sourceAdded']=true;   
    }
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
    echo json_encode($output);
        
?>