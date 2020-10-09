<?php 
require '../../db/dbconnect.php';
require '../../classes/headerInfo.php';
$student = new setHeader();
$student->setInfo('<i class="fas fa-graduation-cap"></i> Students');
$student->addactionButtons([

'<a  href="../other/admin/downloadCSV.php?table=students" class="button   is-primary"><i class="fas fa-file-export" style="margin-right:10px;"></i>Export as CSV</a>'
 ]);

echo $student->placeHeader();
?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<?php 
require '../../classes/levels.php';

$sLevels = new setLevels();
$sLevels->addLevels([
'<a class="is-success button" id="leveloneStud" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_1</i>Level 1
</a>',
'<a class="button is-info" id="leveltwoStud" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_2</i>Level 2
</a>',
' <a  class="button is-danger" id="levelthreeStud" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_3</i>Level 3
</a>'
]);

echo $sLevels->showLevels();

?>




<div class="card" style="padding:20px;">
<button class="button is-hidden " id="runningLevel">Level </button>
        <div style="margin:10px;">
          <p class="subtitle is-4" id="curstudent"></p>
        </div>
        <div class="studentTable" style="overflow-x:scroll;">

        </div>
</div>

<div class="modal" id="showStutDetails">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
            <p class="modal-card-title"><i class="fas fa-graduation-cap"></i> Student</p>
            <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body" id="specificStutcontent">
            </section>
            <footer class="modal-card-foot">
            </footer>
        </div>
</div>



<div class="modal" id="deleteStudentModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title" id="title_student_id"></p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this student?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmStudentDelete">Delete</button>
      </footer>
  </div>
</div>


<div class="modal" id="editStudentModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Edit</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">

    <div class="field">
        <label class="label">Id:</label>
          <div class="control has-icons-left">
            <input class="input" id="eStud_s_id" type="text" placeholder="Id" disabled>
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
          </div>
    </div>

    <div class="field">
          <label class="label">Name:</label>
          <div class="field-body is-horizontal">
            <input class="input" id="eStud_firstname" type="text" placeholder="Firstname"> 
            <input class="input" id="eStud_lastname" type="text" placeholder="Lastname">
          </div>
      </div>

      <div class="field">
        <label class="label">Address:</label>
          <div class="control has-icons-left">
            <input class="input" id="eStud_address" type="text" placeholder="Address">
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
          </div>
    </div>


    <div class="field">
        <label class="label">Email Address:</label>
          <div class="control has-icons-left">
            <input class="input" id="eStud_email_address" type="text" placeholder="Email Address">
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
          </div>
    </div>


    <div class="field">
        <label class="label">Contact:</label>
          <div class="control has-icons-left">
            <input class="input" id="eStud_contact" type="text" placeholder="Contact">
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
          </div>
    </div>

    <div class="field">
      <label class="label">Level:</label>
        <div class="select">
          <select id="eStud_level">
            <option value="1">Level 1</option>
            <option value="2">Level 2</option>
            <option value="3">Level 3</option>
          </select>
        </div>
    </div>

    <div class="field">
    <label class="label">PAT Teacher</label>
        <div class="select">
          <select id="eStud_pat">
          <?php 
            $pats  = $pdo->prepare("SELECT * FROM staff WHERE NOT s_type='Admin' ");
            $pats->execute();
            foreach($pats as $pat){ ?>
              <option value="<?=$pat['staff_id']?>"><?=$pat['s_firstname']." ". $pat['s_lastname']?></option>
          <?php }?>
          </select>
        </div>
    
    
    </div>



    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmStudentEdit">Save</button>
      </footer>
  </div>
</div>






<script>

function currentLevel($level){
    $("#runningLevel").val($level);
}

$("#leveloneStud").click(function(){
    currentLevel('1');
    $('#curstudent').html("Level 1: ");
    load_data(1,$("#runningLevel").val());  
});

$("#leveltwoStud").click(function(){
    currentLevel('2');
    $('#curstudent').html("Level 2: ");
    load_data(1,$("#runningLevel").val());  
});

$("#levelthreeStud").click(function(){
    currentLevel('3');
    $('#curstudent').html("Level 3: ");
    load_data(1,$("#runningLevel").val());  
});
 
 currentLevel('1');
 $('#curstudent').html("Level 1: ");

      load_data(1,$("#runningLevel").val());  

      function load_data(page, level)  
      {  
           $.ajax({  
                url:"../other/admin/studentTable.php",
                method:"POST",
                data:{page:page,level:level},  
                success:function(data){  
                     $(".studentTable").html(data);  
                }  
           }) 
      }  
      $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page,$("#runningLevel").val());  
      });  


$("#confirmStudentEdit").click(function(){

  if(  $("#eStud_firstname").val()!="" &&  $("#eStud_lastname").val()!="" && $("#eStud_address").val() &&
       $("#eStud_contact").val()!="" && $("#eStud_email_address").val()!="" )
    {

      $.ajax({
                    url:"../other/admin/updateStudent.php",
                    method:"POST",
                    data:{
                      s_id:$("#confirmStudentEdit").val(),
                      s_firstname:$("#eStud_firstname").val(),
                      s_lastname:$("#eStud_lastname").val(),
                      s_address:$("#eStud_address").val(),
                      s_contact:$("#eStud_contact").val(),
                      s_email_address:$("#eStud_email_address").val(),
                      level:$("eStud_level").val(),
                      staff_id:$("#eStud_pat").val(),
                     
                      },
                    success:function(data){
                          if(data == 'studentUpdated'){
                              loadStudents();
                          }
                    }
                }); 


  }
  else{
    alert("Try filling form again");
  }



});

</script>