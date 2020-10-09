<?php 
header('Content-type: application/json');
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/databasetable.php';
$output=[];
$rId=$_POST['request_id'];
$requestT = new Table('requests');
$request=$requestT->groupProjectFind('request_id',$_POST['request_id']);

$newData =$request->fetch(PDO::FETCH_ASSOC);

$updateReq = $pdo->prepare("UPDATE students SET s_firstname=:s_firstname,s_lastname=:s_lastname,
s_address=:s_address,
s_email_address=:s_email_address,s_dob=:s_dob,s_contact=:s_contact
 WHERE s_id=:s_id");


if($updateReq->execute([
    's_firstname'=>$newData['s_firstname'],
    's_lastname'=>$newData['s_lastname'],
    's_address'=>$newData['s_address'],
    's_email_address'=>$newData['s_email_address'],
    's_dob'=>$newData['s_dob'],
    's_contact'=>$newData['s_contact'],
    's_id'=>$newData['s_id']

])){

    $output['reqUpdated']=true;
    $requestT = new DatabaseTable('requests');
    $requestT->delete('request_id',$_POST['request_id']);
}
echo json_encode($output);

?>