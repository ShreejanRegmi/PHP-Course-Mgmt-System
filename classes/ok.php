<?php 
header('Content-type: application/json');
$which=[];
if(isset($_POST['id'])){
$which['ok']=$_POST['id'];

echo json_encode($which);

}

?>