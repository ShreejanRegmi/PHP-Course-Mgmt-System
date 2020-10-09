<?php
require '../../templates/links.php';
require '../../db/dbconnect.php';

$announcements =$pdo->prepare("SELECT * FROM announcement WHERE level='0' OR level=:levs ORDER BY ann_date DESC");
$announcements->execute(['levs'=>$_POST['level']]);
if($announcements->rowCount()>0){
foreach($announcements as $ann){?>
    <button class="accordion ">
      <?=' <p class="subtitle is-6" style="color:white;">'.$ann['ann_title'].'</p>'?>
    </button>

    <div class="accpanel has-background-light">
                <div style="margin:2px;padding:10px;">
                    <p style="float:right;">@ <?=$ann['ann_date']?></p>
                    <br>
                </div>
                <div style="margin:5px;padding:10px;">
                    <p><?=$ann['ann_description']?></p>
                </div>
    </div>
    
    <?php
}
}
else{
      echo "No announcements posted.";
}

?>

<style>

.accordion {
background:  #363636; 
color: #fff;
  cursor: pointer;
  padding: 8px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
 
  border-bottom:1px solid #fff;

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

<script>
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