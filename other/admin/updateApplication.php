<?php 
require '../../db/dbconnect.php';


$applications = $pdo->prepare("UPDATE applications SET status = :status  WHERE a_id = :a_id");

if($applications->execute(['a_id'=>$_POST['a_id'],'status'=>$_POST['status']])){
    echo 'applicationUpdated';
    unset($_POST);
}


?>