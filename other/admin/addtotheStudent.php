<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/password.php';

if(isset($_POST['a_id'])){
$psy=[];
$applications =new Table('applications');
$application=$applications->groupProjectFind('a_id',$_POST['a_id']);

foreach($application as $ap){
    $psy['s_firstname']=$ap['s_firstname'];
    $psy['s_lastname']=$ap['s_lastname'];
    $psy['s_address']=$ap['s_address'];
    $psy['s_contact']=$ap['s_contact'];
    $psy['s_dob']=$ap['s_dob'];
    $psy['s_email_address']=$ap['s_email'];
    $psy['level']=$ap['level'];
    $psy['s_qualifications']=$ap['s_qualifications'];
    $psy['intake']=$ap['intake'];
}

function createId(){
    $id=($psy['intake']+rand(50,100))*10000+rand(100,1000);

    $check = new Table('students');
    $chk = $check->groupProjectFind('s_id',$id);

    if($chk->rowCount()>0){
        createId();
    }
    else{
        return $id;
    }

}

$psy['s_id']= createId();
$psy['s_password']=createPassword($psy['s_id'],$psy['s_firstname']);




$students = $pdo->prepare( "INSERT INTO students (s_id, s_firstname, s_lastname,s_address,s_email_address,s_dob,s_contact,s_password,level,
                            intake, s_qualifications) 
                        VALUES(:s_id, :s_firstname, :s_lastname,:s_address,:s_email_address,:s_dob,:s_contact,:s_password,:level,:intake,
    
                            :s_qualifications)");

     if(                       
$students->execute([
    "s_id"=> $psy['s_id'], "s_firstname"=>$psy['s_firstname'], 
    "s_lastname"=>$psy['s_lastname'],
    "s_address"=>$psy['s_address'],
    "s_email_address"=>$psy['s_email_address'],
    "s_dob"=>$psy['s_dob'],
    "s_contact"=>$psy['s_contact'],
    "s_password"=>$psy['s_password'],
    "level"=>$psy['level'],
    "intake"=>$psy['intake'],"s_qualifications"=>$psy['s_qualifications']




]) ){

unset($psy);
unset($_POST);
}


}

?>