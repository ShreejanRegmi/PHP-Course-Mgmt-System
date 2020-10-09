<?php 
require '../db/dbconnect.php';
require '../classes/Table.php';
header('Content-Type: application/json');

if(!isset($_SESSION)){session_start();}  

function updateFun($table){
    global $pdo;
    $thing;
    if($table=="staff"){
        $thing=$pdo->prepare('UPDATE staff SET s_password=:pass WHERE staff_id=:id');
    }
    else{
        $thing=$pdo->prepare('UPDATE students SET s_password=:pass WHERE s_id=:id');
    }
    return $thing;
}

$data=[];

$tables = new Table($_SESSION['table']);
$table = $tables->groupProjectFind($_POST['field'],$_SESSION['id']);
$values=$table->fetchAll();

if(password_verify($_POST['oldP'],$values[0]['s_password'])){

  
   
        
    if($_SESSION['table']=="staff"){
        $updateP =$pdo->prepare('UPDATE staff SET s_password=:pass WHERE staff_id=:id');
    }

    else{
        $updateP =$pdo->prepare('UPDATE students SET s_password=:pass WHERE s_id=:id');   
    }

    $pcrit=['pass'=>password_hash($_POST['newP'], PASSWORD_DEFAULT),'id'=>$_SESSION['id']];

        if($updateP->execute($pcrit)){
            $data['result']="Password Changed";
        }
    
    
}
else{
    $data['result']="Old Password didn't match";
}


echo json_encode($data);



?>