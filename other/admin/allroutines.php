<?php
require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');

$file=[];

if(isset($_POST['level'])){
    $timetables = new Table('level_timetable');
    $timetable = $timetables->groupProjectFind('level',$_POST['level']);
    $timeT = $timetable->fetch();

    $file['file']=$timeT['routine'];
    echo json_encode($file);
}



?>