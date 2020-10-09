<?php 
if(!isset($_SESSION)){session_start();}  
require '../../classes/Table.php';
require '../../classes/headerInfo.php';

function getAttTitle($level){
  global $pdo;
  $title=[];
  $cH  = $pdo->prepare('SELECT * FROM modules WHERE level=:lev ORDER BY m_code');
  $cH->execute(['lev'=>$level]);
      foreach($cH as $tops){
      $title[]= $tops['m_code'];
      }
  echo json_encode($title);
}




function countSpecM($id,$mcode,$status){
  global $pdo;
  $value;
  $pH  = $pdo->prepare('SELECT COUNT(*) FROM attendances WHERE s_id=:s_id AND m_code=:mcode AND status=:status');
  $pH->execute(['s_id'=>$id,'mcode'=>$mcode,'status'=>$status]);
  $value=$pH->fetchColumn();
      
  return $value;
}




function getAttValue($id,$level,$status){
  global $pdo;
  $val=[];
  $attendVal  = $pdo->prepare('SELECT * FROM modules WHERE level=:lev ORDER BY m_code');
  $attendVal ->execute(['lev'=>$level]);
      foreach($attendVal  as $aps){
      $val[]= countSpecM($id,$aps['m_code'],$status);
      }

  echo json_encode($val);
  }
  

  function countDistinctDays($mcode){
    global $pdo;
    $dist;
    $countDist  = $pdo->prepare('SELECT COUNT(DISTINCT(date)) FROM attendances WHERE  m_code=:mcode');
    $countDist->execute(['mcode'=>$mcode]);
    $dist=$countDist->fetchColumn();    
    return $dist;
  }


  function getAtTotalDays($level){
    global $pdo;
    $tt=[];
    $tDays  = $pdo->prepare('SELECT * FROM modules WHERE level=:lev ORDER BY m_code');
    $tDays ->execute(['lev'=>$level]);
        foreach($tDays  as $t){
        $tt[]= countDistinctDays($t['m_code']);
        }
    echo json_encode($tt);

  }

 


$att = new setHeader();
$att->setInfo('<i class="far fa-chart-bar"></i> Attendance');
$att->addactionButtons([]);
echo $att->placeHeader();


?>
<script src="../../js/chart.js"></script>






<div style="margin:10px;padding:20px;">



        <div class="columns">
            <div class="column card is-6 ">
              <canvas id="bar-chart" width="800" height="450"></canvas>
            </div>
            <div class="column card" style="margin-left:10px;">
                <p class="subtitle"><i class="fas fa-history"></i> History:</p>

                <div class="bars">
                </div>
                

            </div>
        
        </div>
</div>


<script>

var atModuleTitle= <?php getAttTitle($_SESSION['level']); ?>;
var atModuleValue=<?php getAttValue($_SESSION['id'],$_SESSION['level'],'O') ?>;
var atModuleTDays =<?php getAtTotalDays($_SESSION['level']);?>;





new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: atModuleTitle,
      datasets: [
        {
          label: "Days",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: atModuleValue
            
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Present Days'
      },
      scales: {
        yAxes: [{
            display: true,
            ticks: {
              suggestedMax: (atModuleValue[0]*3),
                beginAtZero: true 
            }
        }]
    }
    }

});



function typeColor(totalDays,attendedDays){
  var percent = (attendedDays/totalDays)*100;

  if(percent<50){
      return 'is-danger';
  }
  else if (percent<70){
    return 'is-warning';
  }
  else{
    return 'is-success';
  }

}

function pBars(){
var htm='';
  for(i=0; i < atModuleTitle.length; i++){
    htm+='<div class="Field">';
      htm+='<p class="subtitle is-6">';
      htm+=atModuleTitle[i];
      htm+=':  (';
      htm+=atModuleValue[i];
      htm+= ' of ';
      htm+=atModuleTDays[i];
     htm+= ' Days )</p>';
      htm+='<progress class="is-medium progress ';
      htm+=typeColor(atModuleTDays[i] , atModuleValue[i] );
      htm+='" value="';
      htm+=atModuleValue[i];
      htm+='" max=';
      htm+=atModuleTDays[i];
      htm+='>';
      htm+='</progress>';
      htm+='</div>';
     

  }

return htm;
}


$('.bars').html(pBars());


</script>