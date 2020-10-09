<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


if(isset($_POST['staff_id'])){

$tutors= new DatabaseTable('staff');
$tutor=$tutors->find('staff_id',$_POST['staff_id']);


foreach($tutor as $tut){
    echo "Id : ".$tut['staff_id'].'<br>';
    echo "Name: ".$tut['s_firstname']." ".$tut['s_lastname'].'<br>';
    echo "Address : ".$tut['s_address'].'<br>';
    echo "Contact : ".$tut['s_contact'].'<br>';
    echo "Email : ".$tut['s_email'].'<br>';
    echo "Type : " .$tut['s_type'];
}

}









?>