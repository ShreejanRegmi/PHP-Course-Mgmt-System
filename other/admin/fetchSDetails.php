<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';


if(isset($_POST['s_id'])){

$students= new Table('students');
$student=$students->groupProjectFind('s_id',$_POST['s_id']);
$teachs= new Table('staff');
    foreach($student as $st){
        echo "Id : ".$st['s_id'].'<br>';
        echo "Name: ".$st['s_firstname']." ".$st['s_lastname'].'<br>';
        echo "Address : ".$st['s_address'].'<br>';
        echo "Contact : ".$st['s_contact'].'<br>';
        echo "Email : ".$st['s_email_address'].'<br>';
        $teach =$teachs->groupProjectFind('staff_id',$st['staff_id']);
        foreach($teach as $t){
            echo "Pat Teacher : " .$t['s_firstname']. " ".$t['s_lastname'] ;
        }
       

    }

}




?>