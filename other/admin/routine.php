

<?php
if(!isset($_SESSION)){session_start();}  

require '../../classes/headerInfo.php';
require '../../classes/levels.php';

$routines= new setHeader();
$routines->setInfo('<i class="fas fa-clock"></i> Routines');
$routines->addactionButtons(['']);

echo $routines->placeHeader();


$rLevels = new setLevels();
$rLevels->addLevels([
'<a class="is-success button" id="leveloneRout" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_1</i>Level 1
</a>',
'<a class="button is-info" id="leveltwoRout" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_2</i>Level 2
</a>',
' <a  class="button is-danger" id="levelthreeRout" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_3</i>Level 3
</a>'
]);

echo $rLevels->showLevels();

?>


<div class="card" style="padding:10px;">


    <div class="level">
            <div class="level-left">
                <div class="level-item">
                <p class="subtitle is-6" id="currentRoutine"></p>
                </div>
            </div>

<?php if($_SESSION['type']=='Admin'){?>
                <div class="level-right">
                    <div class="level-item">
                    <button class="button is-success" id="updateRoutine"><i class="fas fa-plus" style="margin-right:10px;"></i>Update</button>                     
                    </div>
                </div>
<?php }?>

    </div>


    <div id="routineTable" style="overflow-x:scroll;">

    </div>
</div>


<div class="modal" id="iRModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Import Routine</p>
      <button class="delete" aria-label="close" id="closeiRModal"></button>
    </header>
    <section class="modal-card-body">
            <form method="POST" action="../other/admin/uploadRoutine.php"  enctype="multipart/form-data">
                <div>
                    <span>Upload a File:</span>
                    <input type="file" name="newRoutine" accept=".csv" onchange="appFile(this)" required/>
                </div>
                <button id="curLevel" class="button is-success" name="rLevel" >Upload</button>
            </form>
    </section>
  </div>
</div>

<script>

function loadR($level){
    $.ajax({
                url:"../other/admin/allroutines.php",
                method:"POST",
                data:{ level:$level},
                success:function(data){
                    
                    loadRoutine("#routineTable",data.file);
                    
                }
            });
}

$("#leveloneRout").click(function(){
    loadR('1');
    $("#currentRoutine").html("Level 1 :");
    $("#updateRoutine").val('1');
});

$("#leveltwoRout").click(function(){
    loadR('2');
    $("#currentRoutine").html("Level 2 :");
    $("#updateRoutine").val('2');
});

$("#levelthreeRout").click(function(){
    loadR('3');
    $("#currentRoutine").html("Level 3 :");
    $("#updateRoutine").val('3');
});

loadR('1');
$("#currentRoutine").html("Level 1 :");
$("#updateRoutine").val('1');


$("#updateRoutine").click(function(){
    $("#iRModal").toggleClass('is-active');
    $("#curLevel").val($(this).val());
});

$("#closeiRModal").click(function(){
    $("#iRModal").removeClass('is-active');
});


$("#upRForm").on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url:"../other/admin/uploadRoutine.php",
        method:"POST",
        data : new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
            loadRoutineS();
            
        }
    });

});


function appFile(file){
    var fileName=file.value;
    document.getElementById('curLevel').disabled=false;
    if(fileName){
        var csv_ext = "csv";
        var file_ext = fileName.split('.').pop().toLowerCase(); 
        if(csv_ext!=file_ext){
        document.getElementById('curLevel').disabled=true;    
        }
       
    }  



}

</script>


<style>
table{
    border : 2px solid #ccc;
}


</style>

