<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';


if(isset($_POST['a_id'])){

$applications= new Table('applications');
$application=$applications->groupProjectFind('a_id',$_POST['a_id']);

    foreach($application as $ap){
        
        echo "Name: ".$ap['s_firstname']." ".$ap['s_lastname'].'<br>';
        echo "Address : ".$ap['s_address'].'<br>';
        echo "Contact : ".$ap['s_contact'].'<br>';
        echo "DOB : ".$ap['s_dob'].'<br>';
        echo "Email : ".$ap['s_email'].'<br>';
        
    }


}




?>