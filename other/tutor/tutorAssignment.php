<script src="../js/tabs.js"></script>
<script src="../js/date.js"></script>

<?php 
if(!isset($_SESSION)){session_start();} 

require '../../db/dbconnect.php';
require '../../classes/headerinfo.php';

$tassignH = new setHeader();
$tassignH->setInfo('<i class="fas fa-tasks" aria-hidden="true"></i>  Assignment');
$tassignH->addactionButtons(['']);

echo $tassignH->placeHeader();

$staffQuery = $pdo->prepare("SELECT * FROM teacher_modules WHERE staff_id=:id");
$staffQuery->execute(['id'=>$_SESSION['id']]);

if($staffQuery->rowCount()>1){
?>
<br>
<div class="tabs is-boxed is-medium is-right">
<ul class="tabsNav">
  <?php 
    foreach ($staffQuery as $staff) {?>

            <li id="firstTaskTab">
              <a class="taskOfthisMod"  id="<?=$staff['m_code']?>">
                <span class="icon is-small"><i class="fas fa-tasks" aria-hidden="true"></i></span>
                <span><?=$staff['m_code'];?></span>
              </a>
            </li>
    
    <?php }?>
</ul>
</div>  
<?php }?>


<div  style="margin-top:6px; padding:20px;">

<?php 
if($staffQuery->rowCount()>0){

?>

    <nav class="level">
        <div class="level-left">

        </div>
        <div class="level-right" >
            <div class="level-item">
                        <button class="button  addTaskonThisMod
                         is-info"  style="width:200px;" >
                            <i class="fas fa-thumbtack" style="margin-right:10px;"></i>
                            Add
                        </button>
            </div>
        </div>
    </nav>
    
<?php } 


else{
  echo "Not affiliated to any modules";
}?>


    <div class="allassignments">
    
    </div>

</div> 

<div class="modal" id="deletetAssignModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Delete Assignment</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this assignment?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmAssignDelete">Delete</button>
      </footer>
  </div>
</div>

<div class="modal" id="deletetAFModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Delete File</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this file?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmAFDelete">Delete</button>
      </footer>
  </div>
</div>

<div class="modal" id="assigFileModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Add File</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
    <form id="fileForm" enctype="multipart/form-data">
        <input type="file" name="fileAssign"  required/>
        <input type="hidden" id="assId" name="onThisAssign">
        <button type="submit" class="button is-info" id="confirmtFileAdd" name="contentFile">Save</button>
    </form>
    </section>
      <footer class="modal-card-foot">
       
      </footer>
  </div>
 
</div>


<div class="modal" id="assignmentAddModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Add Assignment</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">

      <form id="addAssignmentform">
      <div class="field">
        <label class="label">Title</label>
        <input class="input" type="text" id="asn_title" placeholder="Title" required> 
      </div>

      <div class="field">
          <label class="label">Description</label>
          <div class="control">
            <textarea class="textarea" id="asn_details" placeholder="Textarea"required></textarea>
          </div>
      </div>

        <div class="field i-horizontal">
          <div class="field-body">
            <div class="field">
            <label class="label">Starts: </label>
            <input type="date"  id="asn_start" class="input" min="<?=  date("Y-m-d");?>"required>
            </div>

            <div class="field">
            <label class="label">Ends: </label>
            <input type="date" name="" id="asn_end"  class="input" min="<?=  date("Y-m-d", strtotime('tomorrow'));?>" required>
            </div>
                <input type="hidden"  id="toThisModuleA" value="">
          </div>
        </div>
        <br>
        <input type="submit" name="assignmentAdd" value="Save"  class="button is-success" id="confirmAssignmentAdd">
        </form>
     
    </section>
      <footer class="modal-card-foot"></footer>
  </div>
</div>

<script>





$staff_id=<?=$_SESSION['id']?>;

$('#firstTaskTab').toggleClass('is-active');

function assignmentOf($m_code){
    $.ajax({
                url:"../other/tutor/assignmentof.php",
                method:"POST",
                data:{m_code:$m_code},
                success:function(data){
                    $(".allassignments").html(data);   
                }
            });
}


function firstLoad($staff_id){
    $.ajax({
                url:"../other/tutor/preModule.php",
                method:"POST",
                data:{staff_id:$staff_id},
                success:function(data){
                    assignmentOf(data);
                    $(".addTaskonThisMod").val(data);
                }
            });
}   


firstLoad($staff_id);


$('.taskOfthisMod').click(function(){
    assignmentOf($(this).attr('id'));
    $(".addTaskonThisMod").val($(this).attr('id'));
});





$(".addTaskonThisMod").click(function(){
  $('#assignmentAddModal').toggleClass('is-active');
  $('#toThisModuleA').val($(".addTaskonThisMod").val());
  $('#asn_title').val('');
  $('#asn_details').val('');
  $('#asn_start').val('');
  $('#asn_end').val('');

});


$('.delete').click(function(){
  $('.modal').removeClass('is-active');
});



$('form#addAssignmentForm').submit(function(event) {
  event.preventDefault();
var asn_title = $('#asn_title').val();
var asn_details = $('#asn_details').val();
var asn_start = $('#asn_start').val();
var asn_end = $('#asn_end').val();
var m_code= $('#toThisModuleA').val();

var dataString = 'asn_title=' + asn_title + '&asn_details=' + asn_details + '&asn_start=' + asn_start 
                  + '&asn_end=' + asn_end +'&m_code='+m_code;

$.ajax({
    type: "POST",
    url: "../other/tutor/addAssignment.php",
    data: dataString,
    cache: false,
    success: function(data) {
      if(data.newAssignAdded==true){
        assignmentOf($('#toThisModuleA').val());
        $('.modal').removeClass('is-active');
      }
    }
});


});



$('form#fileForm').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: "../other/tutor/addAssFile.php",
        type: 'POST',
        data: formData,
        success: function (rep) {
          console.log(rep);
           if(rep.fileadded==true){
            assignmentOf($('.addTaskonThisMod').val());
            $('.modal').removeClass('is-active');
           }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


</script>