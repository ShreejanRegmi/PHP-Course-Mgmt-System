<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/password.php';
header('Content-Type: application/json');

$output=[];

$staff = new Table('staff');
$st = $staff->groupProjectFind('staff_id',$_POST['staff_id']);

if($st->rowCount()>0){
    $output['Tadded']=false;   

}

else{

    $staffs= new Table('staff');
    $_POST['s_password']=createPassword($_POST['staff_id'],$_POST['s_firstname']);
    try {
        $staffs->groupProjectSave($_POST);
            $output['Tadded']=true;   
    }
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

    echo json_encode($output);



?>