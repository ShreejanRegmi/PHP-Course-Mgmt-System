<?php 
require '../../classes/headerInfo.php';
require '../../classes/levels.php';

$tutors = new setHeader();
$tutors->setInfo(' <i class="fas fa-chalkboard-teacher"></i> Tutors');
$tutors->addactionButtons([
        ' <a class="button is-success" id="addNewTutor"><i class="fas fa-plus" style="margin-right:10px;"></i>  New Tutor</a>'
        ,
         '<a  href="../other/admin/downloadCSV.php?table=staff" class="button   is-primary"><i class="fas fa-file-export" style="margin-right:10px;"></i>Export as CSV</a>'
        
    ]);
echo $tutors->placeHeader();



$tLevels = new setLevels();
$tLevels->addLevels([
  '<a class="is-primary button" id="levelallTut" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_none</i>All
</a>',
'<a class="is-success button" id="leveloneTut" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_1</i>Level 1
</a>',
'<a class="button is-info" id="leveltwoTut" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_2</i>Level 2
</a>',
' <a  class="button is-danger" id="levelthreeTut" style="padding:20px;width:200px;">
<i class="material-icons" style="margin-right:10px;">filter_3</i>Level 3
</a>'
]);

echo $tLevels->showLevels();

?>

        <div class="card  is-multiline" style="margin:6px;padding:20px;">
          
            <div class="level">
             
                        <div class="level-item">
                            <div class="field has-addons" style="width:100%;">
                                <p class="control">
                                <input class="input" id="tutorQuery" type="text" placeholder="Find tutor by name">
                                </p>
                                <p class="control">
                                <button class="button tsearchButton">
                                    Search
                                </button>
                                </p>
                            </div>
                        </div>
                  
            </div>

            <div style="margin:20px;">
              <p class="subtitle is-5" id="currLevelT"></p> 
            </div>
              
            <div class="card tutorTable" style="overflow-x:scroll;">
        
            </div>
        
        
        </div>


<!-- ---Details modal-- -->
<div class="modal" id="showTutDetails">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
            <p class="modal-card-title"><i class="fas fa-chalkboard-teacher"></i> Tutor</p>
            <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body" id="specificTutcontent">
            </section>
            <footer class="modal-card-foot">
            </footer>
        </div>
</div>

<!-- 
-----Delete Modal----- -->

<div class="modal" id="deleteTutorModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title" id="title_staff_id"></p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this tutor?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmTutorDelete">Delete</button>
      </footer>
  </div>
</div>


<!-- --New tutor modal--- -->

<div class="modal" id="newTutModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Tutor</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">

      <div class="field">
          <label class="label">Id:</label>
          <div class="control">
            <input class="input" id="t_id" type="text" placeholder="ID">
          </div>
      </div>

      <div class="field">
          <label class="label">Name:</label>
          <div class="field-body is-horizontal">
            <input class="input" id="t_firstname" type="text" placeholder="Firstname"> 
            <input class="input" id="t_lastname" type="text" placeholder="Lastname">
          </div>
      </div>

      <div class="field">
          <label class="label">Address:</label>
          <div class="control">
            <input class="input" id="t_address" type="text" placeholder="Address">
          </div>
      </div>

      <div class="field">
          <label class="label">Contact:</label>
          <div class="control">
            <input class="input" id="t_contact" type="text" placeholder="Contact">
          </div>
      </div>

      <div class="field">
          <label class="label">Email:</label>
          <div class="control">
            <input class="input" id="t_email" type="email" placeholder="Contact">
          </div>
      </div>


      <div class="field">
        <label class="label">Type:</label>
        <div class="control">
          <div class="select">
            <select  id="t_type">
              <option value="Admin">Admin</option>
              <option value="Tutor">Tutor</option>
            </select>
          </div>
        </div>
    </div>


    <div class="field">
        <label class="label">Status:</label>
        <div class="control">
          <div class="select">
            <select id="t_status">
              <option value="live">Live</option>
              <option value="dormant">Dormant</option>
            </select>
          </div>
        </div>
    </div>


    <div class="field">
        <label class="label">Status_Reason:</label>
        <div class="control">
          <div class="select" >
            <select id="t_st_reason">
              <option value=""></option>
              <option value="retired">Retired</option>
              <option value="resigned">Resigned</option>
              <option value="misconduct">Misconduct</option>
            </select>
          </div>
        </div>
    </div>



    
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" id="confirmNewTut">Save</button>
    </footer>
  </div>
</div>








<script>

function loadAllTuts(){
  $.ajax({
			url:"../other/admin/alltutor.php",
			method:"POST",
            success:function(data){
              
                $(".tutorTable").html(data);     
            }
	});
    $("#tutorQuery").val('');

}

loadAllTuts();
$('#currLevelT').html('All Tutors:');

function loadLevelTuts($level){
    $.ajax({
			url:"../other/admin/tutortable.php",
			method:"POST",
			data:{level:$level},
            success:function(data){
                $(".tutorTable").html(data);     
            }
	});
    $("#tutorQuery").val('');
}


$("#levelallTut").click(function(){
    loadAllTuts();  
    $('#currLevelT').html('All Tutors:');
});

$("#leveloneTut").click(function(){
    loadLevelTuts('1');  
    $('#currLevelT').html('Level 1:');
});

$("#leveltwoTut").click(function(){
    loadLevelTuts('2');  
    $('#currLevelT').html('Level 2:');
});

$("#levelthreeTut").click(function(){
    loadLevelTuts('3'); 
    $('#currLevelT').html('Level 3:');  
});

$('.delete').click(function(){
    $('.modal').removeClass('is-active');
});


$("#addNewTutor").click(function(){
      $("#newTutModal").toggleClass('is-active');
      $("#t_id").prop('disabled', false);
      $("#t_id").val('');
      $("#t_firstname").val('');
      $("#t_lastname").val('');
      $("#t_address").val('');
      $("#t_contact").val('');
      $("#t_email").val('');
});

$("#tutorQuery").keyup(function(){
            $.ajax({
                url:"../other/admin/searchTutor.php",
                method:"POST",
                data:{ query:String($(this).val())},
                success:function(data){
                    console.log(data);
                    $(".tutorTable").html(data);
                }
            });
        
});


$("#confirmNewTut").click(function(){
  if($("#t_id").val()!='' 
      && $("#t_firstname").val()!='' &&
      $("#t_lastname").val()!=''  && 
      $("#t_address").val()!='' && $("#t_contact").val()!='' &&
      $("#t_email").val()!='' 
    ){ 
      if($("#confirmNewTut").val()==""){ 
                $.ajax({
                    url:"../other/admin/addTutor.php",
                    method:"POST",
                    data:{
                       staff_id:$("#t_id").val(),
                      s_firstname:$("#t_firstname").val(),
                      s_lastname:$("#t_lastname").val(),
                      s_address:$("#t_address").val(),
                      s_contact:$("#t_contact").val(),
                      s_email:$("#t_email").val(),
                      s_type:$("#t_type").val(),
                      s_status:$("#t_status").val(),
                      s_status_reason:$("#t_st_reason").val()
                    },
                    dataType:"json",
                    success:function(data){
                          
                          if(data.Tadded == true){
                            loadTM();
                          }

                          if(data.Tadded ==false){
                              alert("This id is already taken");
                          }
                    }
                });  
      }
      else{
        $.ajax({
                    url:"../other/admin/updateTutor.php",
                    method:"POST",
                    data:{
                      staff_id:$("#confirmNewTut").val(),
                      s_firstname:$("#t_firstname").val(),
                      s_lastname:$("#t_lastname").val(),
                      s_address:$("#t_address").val(),
                      s_contact:$("#t_contact").val(),
                      s_email:$("#t_email").val(),
                      s_type:$("#t_type").val(),
                      s_status:$("#t_status").val(),
                      s_status_reason:$("#t_st_reason").val()
                      },
                    success:function(data){
                          if(data == 'tutorUpdated'){
                              loadTutors();
                          }
                    }
                }); 
      }

  }
  else{
    alert("Please try filling form again");
  }

});



</script>

 