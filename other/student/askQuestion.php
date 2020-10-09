<?php 
 require '../../db/dbconnect.php';
 require '../../classes/Table.php';
 header('Content-Type: application/json');
 if(!isset($_SESSION)){session_start();}  

 $_POST['s_id']=$_SESSION['id'];

 


$output=[];
$dis = new Table('discussion');
try {
    $dis->groupProjectSave($_POST);
        $output['event']="Question added!";   
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}
    echo json_encode($output);

?>