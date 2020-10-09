<?php 
header('Content-type: application/json');
require '../../db/dbconnect.php';

$results=[];


if(isset($_GET['table'])){

    $modules =$pdo->prepare('SELECT count(*) FROM modules');
    $modules->execute();
    $count =$modules->fetchColumn();
    $results['totalModule']=$count;

    $countModule = $pdo->prepare('SELECT count(*) FROM modules WHERE level=:lev ');
    $countModule->execute(['lev'=>'1']);
    $results['levelOnenum']=$countModule->fetchColumn();
    $countModule->execute(['lev'=>'2']);
    $results['levelTwonum']=$countModule->fetchColumn();
    $countModule->execute(['lev'=>'3']);
    $results['levelThreenum']=$countModule->fetchColumn();

    $totalPoints= $pdo->prepare('SELECT SUM(m_points) FROM modules');
    $totalPoints -> execute();
    $results['totalPoints']=$totalPoints->fetchColumn();
    $point = $pdo->prepare('SELECT SUM(m_points) FROM modules WHERE level=:lev ');
    $point ->execute(['lev'=>'1']);
    $results['levelOnepoints']=$point->fetchColumn();
    $point->execute(['lev'=>'2']);
    $results['levelTwopoints']=$point->fetchColumn();
    $point->execute(['lev'=>'3']);
    $results['levelThreepoints']=$point->fetchColumn();
    echo json_encode($results);
    
    


}




?>