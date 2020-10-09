<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/generateTable.php';
require 'applicationScript.php';

$pendingApps =$pdo->prepare('SELECT * FROM applications WHERE status IS NULL');
 $pendingApps->execute();
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
    
    ' <button class="button approveApp is-success" id="'.$pA['a_id'].'"><i class="fas fa-edit" style="margin-right:10px;"></i>Approve</button>
    <button class="button rejectApp is-danger" id="'.$pA['a_id'].'"><i class="fas fa-trash" style="margin-right:10px;"></i>Reject</button>
    '
    ]);
}


echo $appTable->getValues();
?>

<script>


$('.rejectApp').click(function(){
    updateApplicants($(this).attr('id'),'rejected');
});


$('.approveApp').click(function(){
    $('#appApprovalModal').toggleClass('is-active');
    $('#confirmappApproval').val($(this).attr('id'));
});

$('.delete').click(function(){
    $('.modal').removeClass('is-active');
});

$('#confirmappApproval').click(function(){

        if($('#appApprovestatus').val()=="accepted"){
            appToStudent($(this).val());
            
        }
        else if($('#appApprovestatus').val()=="conditional"){
            showConditionalApplicants();
        }
        
        updateApplicants($(this).val(),$('#appApprovestatus').val());
        
});

</script>