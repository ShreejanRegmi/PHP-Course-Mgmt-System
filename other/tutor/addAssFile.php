<?php 

header('Content-Type: application/json');
require '../../db/dbconnect.php';
require '../../classes/Table.php';
$output=[];
$fName= $_POST["onThisAssign"] . '_' .$_FILES['fileAssign']['name'];
move_uploaded_file($_FILES['fileAssign']['tmp_name'],"../../assignmentFile/{$fName}");

$Files= $pdo -> prepare("INSERT INTO assignment_files (asn_id, assignment_file) VALUES (:asn_id,:assignment_file)");
           
$pass=["asn_id"=>$_POST["onThisAssign"], "assignment_file"=> $fName];

if($Files->execute($pass)){ 
    $output['fileadded']=true;
}




echo json_encode($output);
?>