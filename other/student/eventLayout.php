<?php 
 if(!isset($_SESSION)){session_start();}  
require '../../classes/Table.php';
require '../../classes/headerInfo.php';
$days =["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
$date=new DateTime();
$month=$date->format('m');
$year=$date ->format('Y');
$f_day=mktime(0,0,0,$month,1,$year);
$thismonth =date('F',$f_day);
$thisyear =$date->format('Y');
$monthstartday =date('D',$f_day);
$todayDate= $date->format('d');

$event = new setHeader();
$event->setInfo('<i class="fas fa-calendar-week"></i> Events');
$event->addactionButtons([]);
echo $event->placeHeader();

?>

<div class="eventStudent" style="padding:20px;"> 
    <div class="columns is-multiline is-1" style="padding:10px;">

         <div class=" column is-one-third calenderDisplay">
            <div class="card">
            <section class="hero is-dark monthyear " style="text-align:center;">
                    <p class="title is-3 is-centered " id="whatis"></p>  
            </section>
            <table class="table is-bordered is-striped is-narrow  is-fullwidth">
                        <thead>
                            <tr>
                            <?php 
                                foreach($days as $day){
                                    echo "<th style='text-align:center;'>".$day[0]."</th>";
                                }
                                ?> 
                            </tr>
                        </thead>
                                
                        <tbody id="dates">
                        <script> 
                        cali(thisMonth,thisYear);
                        </script>
                        </tbody>
             </table>
             <footer class="card-footer"> 
                <button class="button is-dark card-footer-item" id="timebackward"><i class="fas fa-backward"></i></button>
                <button class="button is-dark card-footer-item" id="timeforward"><i class="fas fa-forward"></i></button>
            </footer>
            </div>
        </div>

        <div class=" column dialogCalender"> 
       
       <div class="card" style="padding:4px;">
           <section class="hero is-dark monthyear " style="text-align:center;">
           <p class="title is-3 is-centered">Add Event</p>  
           </section>
            <form  id="studentPlansForm">
           <div class="card-content">
               <div class="field">
               <label>Date:</label>       
               <div class="field-body is-horizontal">

                       <div class="select">
                           <select id="newEveDay">
                               <?php 
                               $days_in_month =cal_days_in_month(0,$month,$year);
                               for($i=$date->format('d');$i<=$days_in_month;$i++){
                                   ?>
                                   <option value="<?= $i ?>"><?= $i ?></option>
                                   <?php
                                   }
                                   ?>

                           </select>
                       </div>

                       <div class="select">
                           <select id="newEveMonth">
                               <option value="<?=date('m')?>"><?= $thismonth?></option>
                               </select>
                       </div>
                       <div class="select">
                           <select id="newEveYear" >
                               <option value="<?=date('Y')?>"><?= $thisyear?></option>
                               </select>
                       </div>
                       
               </div>    
               </div>
           
               </div>
               <div class="field">
                   <label>Title:</label>
                   <input class="input" id="newEvetitle" type="text" placeholder="Title" required>
               </div>
               <div class="field">
                   <label>Event:</label>
                   <div class="control">
                       <textarea class="textarea" id="newEvedesc" placeholder="Add Details......"></textarea>
                   </div>
               </div>
               <button class="button is-dark"  id="addNewEve">Add</button>
           </div>
           </form>
        </div>
</div>


<div class="evee">
    <div class="eventAccor">
    </div>
</div>



<div class="modal" id="deleteEventModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title" ><i class="fas fa-calendar-alt"></i> Events</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this event?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmEveDelete">Delete</button>
      </footer>
  </div>
</div>

<style>

.todays{
    background-color:teal;
    color:white;
}
</style>

<script>



    var tF =document.getElementById('timeforward');
    tF.addEventListener('click',function(){
    timeF();
    });

    var tB =document.getElementById('timebackward');
    tB.addEventListener('click',function(){
    timeB();
    });

    function myEvents(){
    $sid=<?=$_SESSION['id']?>;
    $.ajax({
    type: "POST",
    url: "myPlans.php",
    data: {student_id:$sid},
    cache: false,
    success: function(data) {
        $('.eventAccor').html(data);
    }
 });   
}

myEvents();




$('form#studentPlansForm').submit(function(event) {
  event.preventDefault();
  $ev_date = $("#newEveYear").val()+"-"+$("#newEveMonth").val()+"-"+$("#newEveDay").val();
var ev_title = $('#newEvetitle').val();
var ev_description = $('#newEvedesc').val();
var student_id= <?=$_SESSION['id']?>

var dataString = 'ev_title=' + ev_title + '&ev_description=' 
                    + ev_description +
                '&student_id=' + student_id 
                  + '&ev_date=' + $ev_date ;

$.ajax({
    type: "POST",
    url: "addPlans.php",
    data: dataString,
    cache: false,
    success: function(data) {
      if(data.eventAdded==true){
        location.reload();
        $('#newEvetitle').val('');
        $('#newEvedesc').val('');
      }
    }
});


});




</script>