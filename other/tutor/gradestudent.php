<?php 

require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');
$asn_id =$_POST['asn_id'];
unset($_POST['asn_id']);


$out=[];


$gTable = new Table('submission_grade');
$gT= $gTable->groupProjectFind('asn_id',$asn_id);

if($gT->rowCount()>0){
    foreach($_POST as $key => $value) {
        $updateGrade = $pdo -> prepare("UPDATE submission_grade SET s_grade=:s_grade WHERE s_id=:s_id");
         $upass=["s_id"=> $key,"s_grade"=>$value];
        if($updateGrade->execute($upass)){
            $out['grade']="Grades updated ";
        }
     }	

}

else{

    foreach($_POST as $key => $value) {
        $insertGrade = $pdo -> prepare("INSERT INTO submission_grade (s_grade, asn_id, s_id) VALUES (:s_grade, :asn_id, :s_id)");
         $ipass=["s_id"=> $key,"s_grade"=>$value,'asn_id'=>$asn_id];
        if($insertGrade->execute($ipass)){
            $out['grade']="Grades inserted";
        }
     }	




}



echo json_encode($out);


?>