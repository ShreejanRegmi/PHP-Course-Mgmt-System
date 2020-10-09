<?php
if(!isset($_SESSION)){session_start();}  
require '../../db/dbconnect.php';
require '../../classes/headerInfo.php';
require '../../classes/levels.php';
require '../../classes/generateTable.php';
require '../../classes/Table.php';

$requestsH= new setHeader();
$requestsH->setInfo(' <i class="fas fa-tasks"></i> Requests');
$requestsH->addactionButtons(['']);

echo $requestsH->placeHeader();

?>

<div class="card" style="margin:10px;padding:10px;">
<p class="subtitle is-size-5">All requests: </p>

<div class="reqTable" style="overflow-x:scroll;">
<?php 
$requestTT=  new Table('requests');
$request= $requestTT->groupProjectFindAll();
$requestsTable=  new createTable();
$requestsTable->setHeaders(["Id","Name","Address","Date of Birth","Contact","Email address","Action"]);  


foreach ($request as $req) {
    $requestsTable->addValues([
        '<button class="button showStut" id="'. $req['s_id'].'">'.$req['s_id'].'</button>',
            $req['s_firstname']." ".$req['s_lastname'],$req['s_address'],$req['s_dob'],
            $req['s_contact'],$req['s_email_address'],
            '<button class="button conReq is-success" id='.$req['request_id'].'><i class="fas fa-check"></i> Approve</button>
            <button class="button delReq is-danger" id='.$req['request_id'].'><i class="fas fa-trash-alt"></i>  Remove</button>'
    ]);
}
echo $requestsTable->getValues();
?>


</div>

</div>

<div class="modal" id="deleteReqModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Delete Requests</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this student?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmReqDelete">Delete</button>
      </footer>
  </div>
</div>

<div class="modal" id="showStutDetails">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
            <p class="modal-card-title"><i class="fas fa-graduation-cap"></i> Student</p>
            <button class="delete closeStuts" aria-label="close"></button>
            </header>
            <section class="modal-card-body" id="specificStutcontent">
            </section>
            <footer class="modal-card-foot">
            </footer>
        </div>
</div>


<script>

        $('.delete').click(function(){
            $('.modal').removeClass('is-active');
        });


        $('.delReq').click(function(){
            $('#deleteReqModal').toggleClass('is-active');
            $('#confirmReqDelete').val($(this).attr('id'));
        });



        $('#confirmReqDelete').click(function(){
                $.ajax({
                    url:'../other/admin/deleteRequest.php',
                    method:'POST',
                    data:{request_id:$(this).val()},
                    success:function(res){
                            loadRequests();
                    }
                });
        });

        $('.conReq').click(function(){
            $.ajax({
                    url:'../other/admin/confirmRequest.php',
                    method:'POST',
                    data:{request_id:$(this).attr('id')},
                    success:function(ress){
                        loadRequests();
                    }
            });
        });



        $(".showStut").click(function(){
    $("#showStutDetails").toggleClass('is-active');
    $.ajax({
			url:"../other/admin/fetchSDetails.php",
			method:"POST",
			data:{s_id:$(this).attr('id')},
            success:function(data){
                console.log(data);
                $("#specificStutcontent").html(data);
            }

	});
});

</script>