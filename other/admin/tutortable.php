<?php 
require '../../db/dbconnect.php';
require '../../classes/generateTable.php';
require '../../other/admin/statusIcons.php';
require '../../other/admin/tutorscript.php';


if(isset($_POST['level'])){        
$staffs  = $pdo->prepare('SELECT * FROM staff s JOIN teacher_modules tm ON s.staff_id = tm.staff_id 
                            JOIN modules m ON tm.m_code= m.m_code WHERE m.level=:levels');
$staffs->execute(['levels'=>$_POST['level']]); 
$staffTable = new createTable();
$staffTable->setHeaders(["Id","Name","Type","Module","Status","Action"]);        
foreach($staffs as $st){
$staffTable->addValues([
    '<button class="button showTut" id="'. $st['staff_id'].'">'.$st['staff_id'].'</button>'
,$st['s_firstname']."  ".$st['s_lastname'],$st['s_type'],$st['m_code'], liveorDormant($st['s_status']),
' <button class="button editTut is-success" id="'. $st['staff_id'].'"><i class="fas fa-edit" style="margin-right:10px;"></i>Edit</button>
<button class="button deleteTut is-danger" id="'.$st['staff_id'].'"><i class="fas fa-trash" style="margin-right:10px;"></i>Delete</button>
']);
}

echo $staffTable->getValues();
}

?>

