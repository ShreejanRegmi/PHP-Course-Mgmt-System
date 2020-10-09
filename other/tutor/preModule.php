<?php
require '../../db/dbconnect.php';

if(isset($_POST['staff_id'])){
$staffQuery = $pdo->prepare("SELECT m_code FROM teacher_modules WHERE staff_id=:id LIMIT 1");
$staffQuery->execute(['id'=>$_POST['staff_id']]);

$module=$staffQuery->fetchColumn();

echo $module;

}
?>