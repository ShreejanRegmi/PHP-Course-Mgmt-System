<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');
if(!isset($_SESSION)){session_start();} 

$_POST['s_id']=$_SESSION['id'];
$_POST['date']=date("Y/m/d");

$output=[];
$comment = new Table('discussion_comment');
try {
    $comment->groupProjectSave($_POST);
        $output['commentAdded']=true;   
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}
    echo json_encode($output);

?>