<?php 

require '../../db/dbconnect.php';
require '../../classes/Table.php';

$err=[];
$out=[];

$subAssign = $pdo->prepare('SELECT s_count AS countSa FROM submitted_assignments WHERE asn_id=:asn_id  AND s_id =:s_id');
$subAssign->execute(['asn_id'=>$_POST['asn_id'] , 's_id'=>$_POST['s_id'] ]);
$count=$subAssign->fetch();

$currCount=((int) $count['countSa']);


if( $currCount>=3){
$err[]="Limit crossed";
}

if(empty($err)){ 
    move_uploaded_file($_FILES['submission_file']['tmp_name'],"../../assignmentSubmission/{$_FILES['submission_file']['name']}");

    if($currCount>0){
        $countUp=((int) $count['countSa'])+1;
        
        $secondSub= $pdo -> prepare('UPDATE submitted_assignments SET submission_file=:submission_file , s_count=:s_count  WHERE s_id=:s_id');   
        $ecr=[ "submission_file"=> $_FILES['submission_file']['name'],
                "s_id"=>$_POST['s_id'],"s_count"=>$countUp ];

        if($secondSub->execute($ecr)){ 
            $out['fileSubission']="File submitted"; 
        }
    }   
  
    else{

$firstSub= $pdo -> prepare('INSERT INTO submitted_assignments (asn_id,s_id,submission_date,submission_file) VALUES (:asn_id,:s_id,:submission_date,:submission_file)');   
        $scrit=[
            "submission_file"=> $_FILES['submission_file']['name'],
            "s_id"=>$_POST['s_id'],
            "asn_id"=>$_POST['asn_id'] ,
            "submission_date"=>$_POST['submission_date']
        ];

        if($firstSub->execute($scrit)){ 
            $out['fileSubission']="File submitted"; 
        }
      
    } 

} 
else{
    $out['fileSubission']="Failed submitting the file.Submission count exceeded";
}

echo json_encode($out);






?>