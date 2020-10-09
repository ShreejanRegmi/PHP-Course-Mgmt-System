<?php 
require '../classes/Table.php';?>
<div class="tutorContent columns" >
    <div class="column is-3"> 
        <nav class="panel "> <!--is-hidden-mobile-->
            <p class="panel-heading is-pirmary">
            <i class="fas fa-user-cog" style="margin-right:10px;"></i>Tutor 
            </p>
                <button class="button is-hidden" id="currentModuleTut"></button>
            <p class="tutFunctions"> 

                    <a class="panel-block currentBar " id="studyMaterials">
                        <span class="panel-icon">
                        <i class="fas fa-book" aria-hidden="true"></i>
                        </span>
                        Topic & Materials
                    </a>
                    
                    <a class="panel-block " id="readingResources">
                        <span class="panel-icon">
                        <i class="fas fa-paperclip"></i>
                        </span>
                        Reading Resources
                    </a>

                    
                    <a class="panel-block " id="tpatsession">
                        <span class="panel-icon">
                        <i class="fas fa-hands-helping"></i>
                        </span>
                        PAT Requests
                    </a>

                    <a class="panel-block " id="tAssignment">
                        <span class="panel-icon">
                        <i class="fas fa-tasks"></i>
                        </span>
                        Assignments
                    </a>

                    <a class="panel-block " id="tAnnouncement">
                        <span class="panel-icon">
                        <i class="fas fa-bullhorn"></i>
                        </span>
                        Announcement
                    </a>

                    <a class="panel-block " id="tAttendance">
                        <span class="panel-icon">
                        <i class="fas fa-clipboard-list"></i>
                        </span>
                        Attendance
                    </a>

                    <a class="panel-block " id="tRoutine">
                        <span class="panel-icon">
                        <i class="fas fa-clock"></i>
                        </span>
                        Routines
                    </a>

                    <a class="panel-block " id="tSubmission">
                        <span class="panel-icon">
                        <i class="fas fa-graduation-cap"></i>
                        </span>
                        Submissions
                    </a>
        
            </p>
        </nav>
    </div>


    <div class="tutScreen column card " style="margin:18px;">

    </div>

</div>

<script>

function clearstatus(){
    var a = $(".tutFunctions a");
    a.each(function(idx, a) {
         $(a).removeClass("currentBar");
     });
}

 $('.tutFunctions a').click(function(){
    clearstatus();
    $(this ).toggleClass('currentBar');
 });


$("#tRoutine").click(function(){
    $.ajax({
                url:"../other/admin/routine.php",
                method:"POST",
                success:function(data){
                    $(".tutScreen").html(data);   
                }
            });
});

function loadMaterials(){
    $.ajax({
                url:"../other/tutor/study&materials.php",
                method:"POST",
                success:function(data){
                    $(".tutScreen").html(data);   
                }
            });
}

function loadTAssignments(){
    $.ajax({
                url:"../other/tutor/tutorAssignment.php",
                method:"POST",
                success:function(data){
                    $(".tutScreen").html(data);   
                }
            });
}

function loadResources(){
    $.ajax({
                url:"../other/tutor/readingresources.php",
                method:"POST",
                success:function(data){
                    $(".tutScreen").html(data);   
                }
            });

}
function loadAttendances(){
    $.ajax({
                url:"../other/tutor/attendance.php",
                method:"POST",
                success:function(data){
                    $(".tutScreen").html(data);   
                }
            });

}

function loadPAT(){
    $.ajax({
                url:"../other/tutor/tpatsession.php",
                method:"POST",
                success:function(data){
                    $(".tutScreen").html(data);   
                }
            });

}

$('#tpatsession').click(function(){
    loadPAT();
});




$("#readingResources").click(function(){
    loadResources();
});

$("#tAttendance").click(function(){
    loadAttendances();
});

loadMaterials();

$("#studyMaterials").click(function(){
        loadMaterials();
});

function loadSubAndGrades(){
    $.ajax({
                url:"../other/tutor/submission.php",
                method:"POST",
                success:function(data){
                    $(".tutScreen").html(data);   
                }
            });
}

$('#tSubmission').click(function(){
    loadSubAndGrades(); 
});


function loadAnnouncement(){
    $.ajax({
                url:"../other/admin/announcement.php",
                method:"POST",
                success:function(data){
                    $(".tutScreen").html(data);   
                }
            });
}

$("#tAnnouncement").click(function(){
    loadAnnouncement();
});


$("#tAssignment").click(function(){
    loadTAssignments();
});




</script>

<style>
.panel-block{
padding:13px;
}



.currentBar{
    background: #00F260;  
    background: -webkit-linear-gradient(to right, #0575E6, #00F260); 
    background: linear-gradient(to right, #0575E6, #00F260);
    color:white;
    
}
.currentBar i{
    color:white;
}

.tutFunctions a:hover{
    background: #00F260;  
    background: -webkit-linear-gradient(to right, #0575E6, #00F260); 
    background: linear-gradient(to right, #0575E6, #00F260);
    color:white;
} 

.tutFunctions a:hover i{
    color:white;
} 
</style>