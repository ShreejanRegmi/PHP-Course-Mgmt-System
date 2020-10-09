<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';
header('Content-Type: application/json');



$output=[];
$pat = $pdo->prepare("UPDATE pat_session SET summary = :summ , attended=:att   WHERE sess_id = :sesid");

if($pat->execute([
    'summ'=>"Pat session rejected",
    'att'=>"false",
    'sesid'=>$_POST['sess_id']
    
    ])){
    $output['pat']='The respective pat request has been rejected';
}

    echo json_encode($output);

?>