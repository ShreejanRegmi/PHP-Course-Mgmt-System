<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';

if(isset($_POST['m_code']) && isset($_POST['m_name']) && isset($_POST['m_points']) && isset($_POST['level'])){

$modules  = new Table('modules');
$modules->groupProjectSave($_POST);
echo 'moduleAdded';

}



?>