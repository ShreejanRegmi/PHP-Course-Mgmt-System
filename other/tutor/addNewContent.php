<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');

    $output=[];
    $content = new Table('module_content');
    try {
        $content->groupProjectSave($_POST);
            $output['newContentAdded']=true;   
    }
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
    echo json_encode($output);
        

?>