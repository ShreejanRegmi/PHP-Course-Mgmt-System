
<script src="../js/chart.js"></script>

<?php 
require '../../classes/headerInfo.php';
require '../../other/admin/chartModules.php';
$modules= new setHeader();
$modules->setInfo('<i class="fas fa-book"></i> Modules');
$modules->addactionButtons([
  ' <a class="button is-success" id="addNewModule"><i class="fas fa-plus" style="margin-right:10px;"></i>  New Module</a>'
  ,
     '<a  href="../other/admin/downloadCSV.php?table=modules" class="button   is-primary"><i class="fas fa-file-export" style="margin-right:10px;"></i>Export as CSV</a>'
  ]);

echo $modules->placeHeader();


?>



<div style="padding:20px;">
<div class="columns is-multiline">
          <div class="column">
            <div class="box notification is-primary">
              <div class="heading">Modules</div>
              <div class="title totalModulesnum">?</div>
              <div class="level">
                <div class="level-item">
                  <div class="">
                    <div class="heading">Level 1</div>
                    <div class="title is-5 levelOnenum">?</div>
                  </div>
                </div>
                <div class="level-item">
                  <div class="">
                    <div class="heading">Level 2</div>
                    <div class="title is-5 levelTwonum">?</div>
                  </div>
                </div>
                <div class="level-item">
                  <div class="">
                    <div class="heading">Level 3</div>
                    <div class="title is-5 levelThreenum">?</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="column">
            <div class="box notification is-info">
              <div class="heading">Levels</div>
              <div class="title">3</div>
              <br>
              <div class="level">
                <div class="level-item">
                  <div class="">
                    <div class="heading">Level 1</div>
                    <div class="title"></div>
                  </div>
                </div>
                <div class="level-item">
                  <div class="">
                    <div class="heading">Level 2</div>
                    <div class="title"></div>
                  </div>
                </div>
                <div class="level-item">
                  <div class="">
                    <div class="heading">Level 3</div>
                    <div class="title"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="column">
            <div class="box notification is-success">
              <div class="heading">Points</div>
              <div class="title" id="totalPoints">?</div>

              <div class="level">
                <div class="level-item">
                  <div class="">
                    <div class="heading">Level 1</div>
                    <div class="title is-5 pointLevelone">?</div>
                  </div>
                </div>
                <div class="level-item">
                  <div class="">
                    <div class="heading">Level 2</div>
                    <div class="title is-5 pointLeveltwo">?</div>
                  </div>
                </div>
                <div class="level-item">
                  <div class="">
                    <div class="heading">Level 3</div>
                    <div class="title is-5 pointLevelthree">?</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>

      <!-- Graph -->
     <div class="card is-hidden-touch columns moduleChart"  style="padding:20px;">
          <div class="column card levelonePie">
            Level One:
            <br>
          <canvas id="doughnut-chart" width="250" height="250"></canvas>

          </div>

          <div class="column card leveltwoPie">
            Level Two: 
            <br>
            <canvas id="doughnut-chart2" width="250" height="250"></canvas>
          
          </div>

          <div class="column card levelthreePie">
              Level Three:
              <br>
              <canvas id="doughnut-chart3" width="250" height="250"></canvas>
          </div>

      </div> 
 
        <br>
      <div class="moduleTable" style="overflow-x:scroll;"> 

      <?php 
      require '../../db/dbconnect.php';
      require '../../classes/Table.php';
      require '../../classes/generatetable.php';

      $modules = new Table('modules');
      $module =$modules->groupProjectFindAll();
      $modulesTable= new createTable();
      $modulesTable->setHeaders(["Module Code","Module Name","Points","Level","Action"]);
      foreach($module as $mod){
        $modulesTable->addValues([$mod['m_code'],$mod['m_name'],$mod['m_points'],$mod['level'],
        ' <a class="button editModule is-success" id="'. $mod['m_code'].'"><i class="fas fa-edit" style="margin-right:10px;"></i>Edit</a>
        <a class="button deleteModule is-danger" id="'. $mod['m_code'].'"><i class="fas fa-trash" style="margin-right:10px;"></i>Delete</a>
        ']);

      }
      echo $modulesTable->getValues();
      ?>


      </div>


</div>


<!-- ---Module Delete Model -->




<div class="modal" id="deleteModuleModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title" id="title_module_code"></p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this module?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmModuleDelete">Delete</button>
      </footer>
  </div>
 
</div>



<!--add new module-->

<div class="modal" id="addModuleModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <h2  class=" modal-card-title">Module</h2>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
            <div class="field">
            <label class="label">Module Code</label>
              <div class="control">
                <input class="input is-hovered" id="newModuleCode" type="text" placeholder="Module Code">
              </div>
            </div>
          
            <div class="field">
                <label class="label">Module Name</label>
                <div class="control">
                  <input class="input is-hovered" id="newModuleName" type="email" placeholder="Module Name">
                </div>
            </div>

            <div class="field">
                <label class="label">Points</label>
                <div class="control">
                  <input class="input is-hovered" id="newModulePoint" type="number" min=1 placeholder="Points">
                </div>
            </div>

          <div class="control">
          <label  class="label">Level:</label>
              <div class="select" >
                <select id="newModuleLevel">
                  <option value="1" >Level One</option>
                  <option value ="2" >Level Two</option>
                  <option value="3">Level Three</option>
                </select>
              </div>
        </div>




    </section>

      <footer class="modal-card-foot is-right">
        <button  class="button is-info" id="confirmModuleAdd">Save</button>
      </footer>
  </div>
 
</div>



<script>
var L1tags= <?php getChartTitle('1'); ?>;
var L2tags= <?php getChartTitle('2'); ?>;
var L3tags= <?php getChartTitle('3'); ?>;
var L1points = <?php getChartValue('1');  ?>;
var L2points = <?php getChartValue('2');  ?>;
var L3points = <?php getChartValue('3');  ?>;

var randomColors=[
    "#53C872",
    
  "#C25E92",
    "#00B085",
    "#FFD162",
    "#00978D",
    "#FF8876",
    "#007C87",
    "#E96E86","#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
];

var ranColor2=["#F28A19", "#E84633", "#119DA4", "#BBC93E" , "#00A1BF" ,"#40979b" , "#acb0ad" , "#f06134" , "#ffd2aa" , "#faf6a7"];
var ranColor3=["#f78046","#017f69","#f7c15a","#fe8000","#003179","#1b5760","#b4743c"];
function shuffleColors(arr){
    var i = arr.length,j,tmp;
    while (i > 1) {
      j = Math.floor(Math.random()*--i)+1;
      tmp = arr[i];
      arr[i] = arr[j];
      arr[j] = tmp;
    }
    return arr;
}

var L1colors= shuffleColors(randomColors);
var L2colors =shuffleColors(ranColor2);
var L3colors =shuffleColors(ranColor3);

var cx1 = document.getElementById("doughnut-chart").getContext('2d');
var l1Chart = new Chart(cx1, {
  type: 'doughnut',
  data: {
    labels:L1tags,
    datasets: [{
      backgroundColor:L1colors,
      data: L1points,
      borderColor:"rgba(0,0,0,0.2)"
    }]
  },options:{ responsive: false}
});




var cx2 = document.getElementById("doughnut-chart2").getContext('2d');
var l2Chart = new Chart(cx2, {
  type: 'doughnut',
  data: {
    labels:L2tags,
    datasets: [{
      backgroundColor:L2colors,
      data:L2points,
      borderColor:"rgba(0,0,0,0.2)"
    }]
  },options:{ responsive: false}
});



var cx3 = document.getElementById("doughnut-chart3").getContext('2d');
var l3Chart = new Chart(cx3, {
  type: 'doughnut',
  data: {
    labels: L3tags,
    datasets: [{
      backgroundColor:L3colors,
      data:L3points,
      borderColor:"rgba(0,0,0,0.2)"
    }]
  },options:{ responsive: false}
});






$('#addNewModule').click(function(){
  $('#addModuleModal').toggleClass('is-active');
  $("#newModuleCode").prop('disabled', false);
  $("#confirmModuleAdd").val('');
  $("#newModuleCode").val('');
  $("#newModuleName").val('');
  $("#newModulePoint").val('');
  $("#newModuleLevel").val('');
});




$('.editModule').click(function(){
  $('#addModuleModal').toggleClass('is-active');
  $("#newModuleCode").prop('disabled', true);
  $("#confirmModuleAdd").val($(this).attr('id'));
      $.ajax({
              url:"../other/admin/detailOfSTable.php",
              method:"GET",
              data:{ m_code:$(this).attr('id')},
              success:function(data){
                $("#newModuleCode").val(data.m_code);
                $("#newModuleName").val(data.m_name);
                $("#newModulePoint").val(data.m_points);
                $("#newModuleLevel").val(data.level)  ;
              }
      });  
  
});


$("#confirmModuleAdd").click(function(){
  if($("#newModuleCode").val()!='' && $("#newModuleName").val()!=''  && $("#newModulePoint").val()>0){ 
      if($("#confirmModuleAdd").val()==""){ 
                $.ajax({
                    url:"../other/admin/addModule.php",
                    method:"POST",
                    data:{m_code:$("#newModuleCode").val(),m_name:$("#newModuleName").val(),m_points: $("#newModulePoint").val(),level:$("#newModuleLevel").val()},
                    success:function(data){
                        console.log(data);
                          if(data == 'moduleAdded'){
                              loadModules();
                          }
                          
                    }
                });  
      }
      else{
        $.ajax({
                    url:"../other/admin/updateModule.php",
                    method:"POST",
                    data:{m_code:$("#confirmModuleAdd").val(),m_name:$("#newModuleName").val(),m_points: $("#newModulePoint").val(),level:$("#newModuleLevel").val()},
                    success:function(data){
                          if(data == 'moduleUpdated'){
                              loadModules();
                          }
                    }
                }); 
      }

  }
  else{
    alert("Please try filling form again");
  }

});




$('.delete').click(function(){
  $('.modal').removeClass('is-active');
});

$('.deleteModule').click(function(){
 
    $('#deleteModuleModal').toggleClass('is-active');
    $("#title_module_code").html($(this).attr('id'));
    $("#confirmModuleDelete").val($(this).attr('id')); 
});

$('#confirmModuleDelete').click(function(){
  

  $.ajax({
			url:"../other/admin/deleteModule.php",
			method:"POST",
			data:{m_code:$(this).val()},
      success:function(data){
            if(data == 'moduleDeleted'){
                loadModules();
            }
            else{
              alert("Wrong");
            }
      }

	});

});



function subDetails(){

  $.ajax({
			url:"../other/admin/fetchmDetails.php",
			method:"GET",
			data:{table:'modules'},
      success:function(data){
            $(".totalModulesnum").html(data.totalModule);
            $("#totalPoints").html(data.totalPoints);
            $(".pointLevelone").html(data.levelOnepoints);
            $('.pointLeveltwo').html(data.levelTwopoints);
            $('.pointLevelthree').html(data.levelThreepoints);
            $('.levelOnenum').html(data.levelOnenum);
            $('.levelTwonum').html(data.levelTwonum);
            $('.levelThreenum').html(data.levelThreenum);
      }

	});


}


subDetails();
    
</script>

