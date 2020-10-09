<?php 
require '../../db/dbconnect.php';
header('Content-Type: application/json');

$output=[];
$pat = $pdo->prepare("UPDATE pat_session SET summary = :summ , attended=:att   WHERE sess_id = :sesid");

if($pat->execute([
    'summ'=>$_POST["summary"],
    'att'=>$_POST["attended"],
    'sesid'=>$_POST['sess_id']
    
    ])){
    $output['patUpdated']=true;
}

    echo json_encode($output);

?>