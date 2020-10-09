<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');
if(!isset($_SESSION)){session_start();} 

$out=[];

if($_SESSION['patteacher']==''){
    $out['dataSent']='PAT teacher have not been assigned yet. Try again later.';
}
else{
    $patSesh =$pdo->prepare('INSERT INTO pat_session (s_id, staff_id, date,time,query) VALUES (:s_id, :staff_id, :date,:time,:query)');

    if(
    $patSesh->execute(['s_id'=>$_SESSION['id'],'staff_id'=>$_SESSION['patteacher'],'date'=>$_POST['date'],'time'=>$_POST['time'],'query'=>$_POST['query']])
    ){
        $out['dataSent']='PAT Session added';
    }

}



echo json_encode($out);

?>