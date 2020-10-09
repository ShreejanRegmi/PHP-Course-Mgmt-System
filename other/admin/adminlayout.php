
<?php require '../classes/Table.php';?>
<div class="mainContent columns">

<div class="sidebarFunctions  column is-3">

        <nav class="panel "> <!--is-hidden-mobile-->
        <p class="panel-heading ">
        <i class="fas fa-user-cog" style="margin-right:10px;"></i>Administration 
        </p>
        
        <p class="mFunctions"> 

                <a class="panel-block currentBar " id="modules">
                    <span class="panel-icon">
                    <i class="fas fa-book" aria-hidden="true"></i>
                    </span>
                    Modules
                </a>
                
                <a class="panel-block" id="tutors">
                    <span class="panel-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                    </span>
                    Tutors
                </a>

                <a class="panel-block" id="students">
                    <span class="panel-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </span>
                    Students
                </a>

                <a class="panel-block" id="requests">
                    <span class="panel-icon">
                    <i class="fas fa-tasks"></i>
                    </span>
                    Requests
                </a>

               

                <a class="panel-block" id="routines"> 
                    <span class="panel-icon">
                    <i class="fas fa-clock"></i>
                    </span>
                    Routines
                </a>

              


                <a class="panel-block " id="announcements">
                    <span class="panel-icon">
                    <i class="fas fa-calendar-alt"></i>
                    </span>
                    Announcement
                </a>

                <a class="panel-block " id="applications">
                    <span class="panel-icon">
                    <i class="fas fa-envelope-open-text"></i>
                    </span>
                    Applications
                </a>

                
                <a class="panel-block " id="tutorandmodules">
                    <span class="panel-icon">
                    <i class="fas fa-puzzle-piece"></i>
                    </span>
                    Tutor & Modules
                </a>

                <a class="panel-block " id="archives">
                    <span class="panel-icon">
                    <i class="fas fa-archive"></i>
                    </span>
                    Archives
                </a>
            
        </p>
      
        </nav>
</div>



<div class="changingScreen column card ">

</div>


</div>


<style>
.panel-block{
    padding:13px;
}
.changingScreen {
    margin:18px;
 
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

.mFunctions a:hover{
    background: #00F260;  
    background: -webkit-linear-gradient(to right, #0575E6, #00F260); 
    background: linear-gradient(to right, #0575E6, #00F260);
    color:white;
} 

.mFunctions a:hover i{
    color:white;
} 

</style>



<script>


function clearstatus(){
    var a = $(".mFunctions a");
    a.each(function(idx, a) {
         $(a).removeClass("currentBar");
     });
}





 $('.mFunctions a').click(function(){
    clearstatus();
    $(this ).toggleClass('currentBar');
 });


function loadModules(){
    $.ajax({
			url:"../other/admin/modules.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}
	});
}


function loadTutors(){
    $.ajax({
			url:"../other/admin/tutors.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}
	});
}
function loadStudents(){
    $.ajax({
			url:"../other/admin/students.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}
	});
}

function loadAnnouncement(){
$.ajax({
    url:"../other/admin/announcement.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}
});

}

function loadRoutineS(){
$.ajax({
    url:"../other/admin/routine.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}
});

}

function loadApplications(){
$.ajax({
    url:"../other/admin/applications.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}
});

}

function loadArchives(){

    $.ajax({
        url:"../other/admin/allarchives.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}

    });

}

$('#archives').click(function(){
    loadArchives();
});

function loadRequests(){
$.ajax({
    url:"../other/admin/requests.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}
});   
}

$('#requests').click(function(){
    loadRequests();
});

function loadTM(){
$.ajax({
    url:"../other/admin/tut&mod.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}
});

}


function loadPatSessions(){

    $.ajax({
    url:"../other/admin/patSession.php",
			method:"POST",
			success:function(data)
			{$('.changingScreen').html(data);}
    });
}


loadModules();

$('#tutorandmodules').click(function(){
    loadTM();
});

$("#assignPat").click(function(){
    loadPatSessions();
});

$('#modules').click(
    function(){
        loadModules();
    }
);
$('#tutors').click(
    function(){
        loadTutors();
    }
);

$('#students').click(
    function(){
        loadStudents();
    }
);

$("#announcements").click(function(){
    loadAnnouncement();
});

$("#routines").click(function(){
    loadRoutineS();
});
$("#applications").click(function(){
    loadApplications();
});

</script>

<script src="../js/calender.js"></script>