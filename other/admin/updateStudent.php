<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';

$students=new Table('students');
$students->groupProjectUpdate($_POST,'s_id');
echo 'studentUpdated';
    
?>