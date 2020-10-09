<?php 

if(!isset($_SESSION)){session_start();}  
function printLevel($level){
    if((int)$level>0){
            echo "Level: " .$level;
    }
    else{
        echo " Level: All";
    }
}


$days =["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
$date=new DateTime();
$month=$date->format('m');
$year=$date ->format('Y');
$f_day=mktime(0,0,0,$month,1,$year);
$thismonth =date('F',$f_day);
$thisyear =$date->format('Y');
$monthstartday =date('D',$f_day);
$todayDate= $date->format('d');

require '../../classes/headerInfo.php';
require '../../db/dbconnect.php';
require '../../classes/Table.php';

$calender = new setHeader();
$calender->setInfo('<i class="fas fa-calendar-alt"></i> Announcement');
$calender->addactionButtons(['<button id="buttonDate" type="button" class="button is-small"></button>']);
echo $calender->placeHeader();
?>

<div class="eventsAdmin" style="padding:20px;"> 
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
                    <div class="card-content">
                        <div class="field">
                        <label>Date:</label>       
                        <div class="field-body is-horizontal">

                                <div class="select">
                                    <select id="newAnnounceDay">
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
                                    <select id="newAnnounceMonth">
                                        <option value="<?=date('m')?>"><?= $thismonth?></option>
                                        </select>
                                </div>
                                <div class="select">
                                    <select id="newAnnounceYear" >
                                        <option value="<?=date('Y')?>"><?= $thisyear?></option>
                                        </select>
                                </div>
                                
                        </div>    
                        </div>
                    
                        </div>
                        <div class="field">
                            <label>Title:</label>
                            <input class="input" id="newAnnouncetitle" type="text" placeholder="Title" required>
                        </div>
                        <div class="field">
                            <label>Event:</label>
                            <div class="control">
                                <textarea class="textarea" id="newAnnouncedesc" placeholder="Add Details......"></textarea>
                            </div>
                        </div>

                        <div class="field">
                            <label>Level:</label>
                                <div class="select">
                                            <select id="newAnnounceLevel" >
                                                <option value="0">All</option>
                                                <option value="1">Level 1</option>
                                                <option value="2">Level 2</option>
                                                <option value="3">Level 3</option>
                                                </select>
                                </div>      
                         </div>

                        <button class="button is-dark"  id="addNewAnnounce">Add</button>
                    </div>
                   
        </div>


    </div>


</div>



<div class="modal" id="deleteAnnounceModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title" ><i class="fas fa-calendar-alt"></i> Announcement</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this announcement?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmAnnounceDelete">Delete</button>
      </footer>
  </div>
</div>

<div class="evee">
    <div>
<?php 

$announcements = new Table('announcement');
$announcement = $announcements->groupProjectFind('staff_id',$_SESSION['id']);

        foreach($announcement as $ann){?>
        <button class="accordion"><?=$ann['ann_title']?></button>

        <div class="accpanel has-background-light">
                    <div style="margin:2px;padding:10px;">
                        <p style="float:right;">@ <?=$ann['ann_date']?></p>
                        <br>
                         <p style="float:right;"><?=printLevel($ann['level']);?></p>
                    </div>
                    <div style="margin:10px;padding:10px;">
                        <p><?=$ann['ann_description']?></p>
                    </div>
                    <div class="field accfooter is-grouped is-grouped-right"style="margin-bottom:2px;">
                        <button  id="<?=$ann['ann_id']?>" class="button deleteAnnounce is-danger">Delete</button>
                    </div>
        </div>
<?php
}


?>

</div>
</div>






<script>
$(document).ready(function(){

$id =<?= $_SESSION['id']?>;
$("#addNewAnnounce").click(function(){
        if($("#newAnnouncedesc").val()!=" "  && $("#newAnnouncetitle").val()!="" ){
        $date = $("#newAnnounceYear").val()+"-"+$("#newAnnounceMonth").val()+"-"+$("#newAnnounceDay").val();
                $.ajax({
                    url:"../other/admin/addannouncement.php",
                    method:"POST",
                    data:{
                        ann_date:$date,
                        ann_title:$("#newAnnouncetitle").val(),
                        ann_description:$("#newAnnouncedesc").val(),
                        level:$("#newAnnounceLevel").val(),
                        staff_id:$id
                        },
                        dataType: "json",
                    success:function(data){
                        console.log(data);
                        if(data.added == true){
                            loadAnnouncement();
                        }
                    }
            });              
        }
        else{
            alert("Add all the needed credentials");
        }
});



$(".deleteAnnounce").click(function(){
    $("#deleteAnnounceModal").toggleClass('is-active');
    $("#confirmAnnounceDelete").val($(this).attr('id'));

});


$("#confirmAnnounceDelete").click(function(){
  $.ajax({
			url:"../other/admin/deleteAnnounce.php",
			method:"POST",
			data:{ann_id:$(this).val()},
      success:function(data){

            if(data == 'announceDeleted'){
                loadAnnouncement();
            }
      }

	});
});


$(".delete").click(function(){
    $(".modal").removeClass('is-active');
});


function clearFields(){
    $("#newAnnouncetitle").val('');
    $("#newAnnouncedesc").val('');
    $("#newAnnounceLevel").val('');
}

clearFields();



$("#buttonDate").html(new Date());

var tF =document.getElementById('timeforward');
tF.addEventListener('click',function(){
 timeF();
  });

  var tB =document.getElementById('timebackward');
tB.addEventListener('click',function(){
 timeB();
  });


var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight +"px";
    }
  });
}


});

</script>


<style>

td{
    cursor:pointer;
   
}
.nonemp:hover{
    background-color:#bd2135;
    color:#fff;    
}
.todays{
    background-color:teal;
    color:white;
}

.evee{
    margin:5px;
    padding:5px;
}
.accordion {
background:  #363636; 
color: #fff;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
 
  border-bottom:1px solid #fff;

}
.accfooter{
    padding:10px;
}
.active, .accordion:hover {
    transition: background-color 0.2s linear;
  background-color:#0A0A0A;
}

.accpanel {
   
  padding: 0px 18px;
  
  overflow: hidden;
  max-height:0;
  transition: max-height 0.2s ease-out;
  transition-timing-function: cubic-bezier(0, 0, 0.58, 1);
  
}
.accordion:after {
  content: '\02795'; /* Unicode character for "plus" sign (+) */
  font-size:10px;
  color: #777;
  float: right;
  margin-left: 5px;
  

}

.active:after {
  content: "\2796"; /* Unicode character for "minus" sign (-) */
  
}

</style>


