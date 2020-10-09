<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
header('Content-Type: application/json');

$out=[];

$date = $_POST['date'];
$module=$_POST['module'];

unset($_POST['date']);
unset($_POST['module']);

foreach($_POST as $key => $value) { 

    $insertAt= $pdo -> prepare("INSERT INTO attendances (date, s_id,m_code, status) VALUES (:date, :s_id,:m_code, :status)");
    if($insertAt->execute(   ["date"=> $date,"m_code"=>$module,"s_id"=>$key,"status"=>$value])) 
    {  
         unset($_POST);
        $out['attendance']="Attendance filled ";
    }

               
 }		



 echo json_encode($out);

?>

