
<?php 
$days =["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
$date=new DateTime();
$month=$date->format('m');
$year=$date ->format('Y');
$f_day=mktime(0,0,0,$month,1,$year);
$thismonth =date('F',$f_day);
$thisyear =$date->format('Y');
$monthstartday =date('D',$f_day);
$todayDate= $date->format('d');
?>

<div class="columns">

    <div class="column is-one-third">
                    <div class="card calender  " >
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

        <div class="column" > 
        <form>    
         <div class="card" style="padding:4px;">
            <section class="hero is-dark monthyear " style="text-align:center;">
            <p class="title is-3 is-centered">Add Event</p>  
            </section>
            <div class="card-content">
                <div class="field">
                  <label>Date:</label>       
                  <div class="field-body is-horizontal">

                           <div class="select">
                               <select name="">
                                   <?php 
                                   $days_in_month =cal_days_in_month(0,$month,$year);
                                   for($i=$date->format('d');$i<=$days_in_month;$i++){
                                       ?>
                                    <option value=""><?= $i ?></option>
                                    <?php
                                    }
                                    ?>

                               </select>
                           </div>

                           <div class="select">
                               <select name="">
                                   <option value=""><?= $thismonth?></option>
                                </select>
                           </div>
                           <div class="select">
                               <select name="" >
                                   <option value=""><?= $thisyear?></option>
                                </select>
                           </div>
                          
                  </div>    

                 </div>
            
            
                </div>
                <div class="field">
                    <label>Title:</label>
                     <input class="input" type="text" placeholder="Title" required>
                </div>
                <div class="field">
                    <label>Event:</label>
                    <div class="control">
                        <textarea class="textarea" placeholder="Add Details......"></textarea>
                    </div>
                </div>
                <button class="button is-dark" >Add</button>
              </div>
              </form>
         </div>



</div>


<!-- Accordion -->
<div class="evee">
    <div>

        <button class="accordion">Event 1  </button>
        <div class="panel">
        <p>Lorem ipsum...</p>

            <div class="field is-grouped is-grouped-right"style="margin-bottom:2px;">
                <button class="button is-success" style="margin-right:10px;">Edit</button>
                <button class="button is-danger">Delete</button>
            </div>

        </div>

        <button class="accordion">Event 2</button>
        <div class="panel">
        <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque ad quae eius non quidem iure. Quia optio dolorum sequi architecto omnis nihil corrupti, minima dolores debitis a maxime, labore magni.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam optio pariatur beatae, autem distinctio veritatis ratione sequi cumque eum totam reiciendis eveniet numquam placeat sapiente quidem. Vitae facilis laudantium alias.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas blanditiis, optio expedita voluptatibus quibusdam possimus sapiente cupiditate officiis, esse nihil eius porro atque reiciendis. Tempora laudantium blanditiis quaerat ea voluptas.
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat saepe possimus omnis? Molestiae unde voluptas atque sunt sapiente accusamus hic, dolorem, aliquam neque nihil quisquam ex facere accusantium beatae doloremque.
        
        </p>
        <div class="field is-grouped is-grouped-right">
                <button class="button is-success" style="margin-right:10px;">Edit</button>
                <button class="button is-danger">Delete</button>
            </div>
        </div>


    </div>
</div>



<style>


.calender{
    margin:5%;
width:270px;
}
.monthyear{
    padding:10px;
}
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

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .accordion:hover {
    transition: background-color 0.2s linear;
  background-color:#0A0A0A;
}

/* Style the accordion panel. Note: hidden by default */
.panel {
    background-color:rgba(192,197,206,0.6);
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


<script>

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




</script>

