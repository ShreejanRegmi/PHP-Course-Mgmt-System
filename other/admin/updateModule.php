<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';

$modules =new Table('modules');
$modules->groupProjectUpdate($_POST,'m_code');
echo 'moduleUpdated';
    
?>