<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/generateTable.php';
require 'applicationScript.php';

$pendingApps =$pdo->prepare('SELECT * FROM applications WHERE status=:status');
 $pendingApps->execute(['status'=>'conditional']);
$appTable = new createTable();
$appTable->setHeaders(["Name","Contact","Email","Qualifications","Action"]);    
foreach($pendingApps as $pA){
    $appTable->addValues([
        '<button class="button showApplicant" id="'. $pA['a_id'].'">'.$pA['s_firstname']." ".$pA['s_lastname'].'</button>',
    $pA['s_contact'],
    $pA['s_email'],
    '<a  download ="'.$pA["s_qualifications"].'"   href="../applications/'.$pA["s_qualifications"].'">
        <span class="tag is-success is-medium"><i class="fas fa-file"> View </i></span>
    </a>',
    
    ' <button class="button conapproveApp is-success" id="'.$pA['a_id'].'"><i class="fas fa-edit" style="margin-right:10px;"></i>Approve</button>
    <button class="button rejectApp is-danger" id="'.$pA['a_id'].'"><i class="fas fa-trash" style="margin-right:10px;"></i>Reject</button>
    '
    ]);
}


echo $appTable->getValues();
?>

<script>
$('.conapproveApp').click(function(){
    updateApplicants($(this).attr('id'),'accepted');
    appToStudent($(this).attr('id'));
});

$('.rejectApp').click(function(){
    updateApplicants($(this).attr('id'),'rejected');
});


</script>