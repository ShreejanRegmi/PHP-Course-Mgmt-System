<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/generateTable.php';
require 'applicationScript.php';

if(isset($_POST['status'])){

$pendingApps =$pdo->prepare('SELECT * FROM applications WHERE status=:status');
 $pendingApps->execute(['status'=>$_POST['status']]);
$appTable = new createTable();
$appTable->setHeaders(["Name","Contact","Email","Qualifications"]);    
foreach($pendingApps as $pA){
    $appTable->addValues([
        '<button class="button showApplicant" id="'. $pA['a_id'].'">'.$pA['s_firstname']." ".$pA['s_lastname'].'</button>',
    $pA['s_contact'],
    $pA['s_email'],
    '<a  download ="'.$pA["s_qualifications"].'"   href="../applications/'.$pA["s_qualifications"].'">
        <span class="tag is-success is-medium"><i class="fas fa-file"> View </i></span>
    </a>',

    ]);
}


echo $appTable->getValues();

}

?>

