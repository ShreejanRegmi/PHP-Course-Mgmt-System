<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';

$staff=new Table('staff');
$staff->groupProjectUpdate($_POST,'staff_id');
echo 'tutorUpdated';
    
?>