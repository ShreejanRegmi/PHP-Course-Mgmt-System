<script src="../js/chart.js"></script>
<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/generateTable.php';



function getDates($mcode){
    global $pdo;
    $dates=[];
    $attendDates = $pdo->prepare('SELECT DISTINCT(date) FROM attendances WHERE m_code=:mcode ORDER BY date');
    $attendDates->execute(['mcode'=>$mcode]);
    foreach($attendDates as $at){
        $dates[]=$at['date'];
    }

    return json_encode($dates);
}

function countPresent($date,$mcode){
    global $pdo;
    $countP;
    $count=$pdo->prepare('SELECT COUNT(*) FROM attendances WHERE date=:date AND status=:status AND m_code=:mcode');
    $count->execute(['date'=>$date,'status'=>'O','mcode'=>$mcode]);
        $countP=$count->fetchColumn();
        return $countP;
}

function getPresentNumber($mcode){
    global $pdo;
    $presentArr=[];
    $attDates = $pdo->prepare('SELECT DISTINCT(date) FROM attendances WHERE m_code=:mcode ORDER BY date');
    $attDates->execute(['mcode'=>$mcode]);
    foreach($attDates as $ath){
        $presentArr[]=countPresent($ath['date'],$mcode);
    }
    return json_encode($presentArr);
}




?>

<div  id="chartDiv" class="card notification is-hidden-touch" style="margin:10px;padding:20px;">
    <canvas id="att-chart" width="800" height="250"></canvas>
</div>

<div style="margin:10px;padding:20px;overflow-x:scroll;" class="card">
<form id="attendanceForm">
    <div class="field">
    <label  class="label">Choose Date:</label>
        <input type="date" name="date" id="date" min="<?=  date("Y-m-d");?>" required>
    </div>
    <input type="hidden" name="module" id="whatMod" value="<?=$_POST['m_code']?>">
<?php
    $students  = $pdo->prepare('SELECT * FROM students s JOIN modules m ON s.level = m.level 
                                WHERE m.m_code=:code');
$students->execute(['code'=>$_POST['m_code']]); 

$studentTable = new createTable();
$studentTable->setHeaders(["Id","Name","Status"]); 
foreach ($students as $s) {
    $stat='
     <div class="select">
        <select  name="'.$s['s_id'].'">
            <option value="O" >Present</option>
            <option value="A">Absent</option>
            <option value="X">Unauthorized Absenteeism</option>
        </select>
    </div>';


$studentTable->addValues([$s['s_id'],$s['s_firstname']." ".$s['s_lastname'],$stat]);
   
}
echo $studentTable->getValues();
?>

<br>
<div class="is-pulled-right">
    <button class="button is-success" id="buttonSubmit" >Save</button> 
</div>
<br>

</form>
</div>


<script>

var untilDates= <?= getDates($_POST['m_code']) ?>;
var untilValues =<?= getPresentNumber($_POST['m_code']) ?>;

if(untilDates.length<2){
   $('#chartDiv').css({display:'none'});
}


$('form#attendanceForm').submit(function(e){
    $("#buttonSubmit").toggleClass('is-loading');
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'../other/tutor/todaysattendance.php',
        method:'POST',
        data:formData,
        success:function(res){
            alert(res.attendance);
            loadAttendances();
            $("#buttonSubmit").removeClass('is-loading');
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

function findSmallest(array){
    small=array[0];

    for(i=0;i<array.length;i++){
        if(array[i]<small & array[i]>0){
            small=array[i];
        }
    }

    if(small-3==0){
        return 0;
    }
    else{
        return (small-2);
    }
}


function showorNot(data){
     var dat;
    dat=(data.length<10)?true:false;
    return dat;
 }

function attendanceGraph(labelA,dataA){

  var atChart=  new Chart(document.getElementById("att-chart"), {
  type: 'line',
  data: {
    labels: labelA,
    datasets: [{ 
        data: dataA,
        label: "Attendance",
        borderColor: "#045D56",
        backgroundColor : "rgba(137,225,156,0.5)",
        fill: true
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Attendance of this module'
    },
    scales: {
        yAxes: [{
            display: true,
            ticks: {
              suggestedMin:findSmallest(dataA),
              suggestedMax:(findSmallest(dataA)+6)
                
            }
        }],
        xAxes:[{
           
            display:showorNot(dataA)
            
        },]
    }
  }
});

}

attendanceGraph(untilDates,untilValues);




</script>