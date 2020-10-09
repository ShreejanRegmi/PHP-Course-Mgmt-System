<?php
header('Content-type: application/json');
require '../../db/dbconnect.php';
require '../../classes/Table.php';
    
   $output=[];
if(isset($_GET['m_code'])){
    $tables = new Table('modules');
    $tableSpecific=$tables->groupProjectFind('m_code',$_GET['m_code']);
    $t=$tableSpecific->fetch();
    
    $output['m_code']=$t['m_code'];
    $output['m_name']=$t['m_name'];
    $output['m_points']=$t['m_points'];
    $output['level']= $t['level'];


        echo json_encode($output);
   }

?>