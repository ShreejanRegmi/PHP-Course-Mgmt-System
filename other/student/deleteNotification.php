
<?php 
if(!isset($_SESSION)){session_start();}  
require '../../classes/Table.php';
require '../../db/dbconnect.php';

function deleteAll($id){
    global $pdo;
    $dAll= $pdo->prepare('DELETE FROM notifications WHERE s_id=:s_id' );
    $dAll->execute(['s_id'=>$id]);
}

function deleteSpecific($nid){
    global $pdo;
    $dSpec= $pdo->prepare('DELETE FROM notifications WHERE n_id=:n_id' );
    $dSpec->execute(['n_id'=>$nid]);
}


if($_POST['action']=='all'){
    deleteAll($_SESSION['id']);
}

if($_POST['action']=='specific'){
    deleteSpecific($_POST['nid']);
}








?>