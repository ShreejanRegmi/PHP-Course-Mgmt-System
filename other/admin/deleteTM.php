<?php
require '../../db/dbconnect.php';

if(isset($_POST['m_code']) && isset($_POST['staff_id'])){
  
$smt =$pdo->prepare('DELETE FROM teacher_modules WHERE staff_id=:staff_id AND m_code=:m_code');
    if($smt->execute(['staff_id'=>$_POST['staff_id'] ,'m_code'=>$_POST['m_code']])){
        echo 'tmDeleted';
    }

}

?>