<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');

$output=[];
$req = new Table('requests');
try {
    $req->groupProjectSave($_POST);
        $output['sentRequest']=true;   
}
catch(Exception $e) {
    echo 'Exception -> ';
    $output['sentRequest']= var_dump($e->getMessage());
}
    echo json_encode($output);
    


?>