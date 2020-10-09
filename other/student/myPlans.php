<?php 
require '../../classes/Table.php';
require '../../db/dbconnect.php';
if(!isset($_SESSION)){session_start();} 

$events = new Table('eventsplans');
$event = $events->groupProjectFind('student_id',$_SESSION['id']);

        foreach($event as $ev){?>
        <button class="accordion " style="padding:20px;">
                <?=$ev['ev_title']?>
        </button>

        <div class="accpanel has-background-light" >
                    <div style="margin:2px;padding:10px;">
                        <p style="float:right;">@ <?=$ev['ev_date']?></p>
                        <br>
                    </div>
                    <div style="margin:10px;padding:10px;">
                        <p><?=$ev['ev_description']?></p>
                    </div>
                    <div class="field accfooter is-grouped is-grouped-right"style="margin-bottom:2px;">
                        <button  id="<?=$ev['ev_id']?>" class="button deleteEvent is-danger">Delete</button>
                    </div>
        </div>
<?php
}


?>

<script>
$('.deleteEvent').click(function(){
    $('#deleteEventModal').toggleClass('is-active');
    $('#confirmEveDelete').val($(this).attr('id'));
});

$("#confirmEveDelete").click(function(){
  $.ajax({
			url:"deleteEvent.php",
			method:"POST",
			data:{ev_id:$(this).val()},
            success:function(data){
                if(data == 'eveDeleted'){
                    location.reload();
                }
             }
            });
});

</script>

