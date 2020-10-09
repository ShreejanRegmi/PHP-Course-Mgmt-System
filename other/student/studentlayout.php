<?php 
require '../../classes/Table.php';



function countE(){
   global $pdo;
    $events = $pdo->prepare('SELECT COUNT(*) FROM eventsplans WHERE student_id=:s_id');
    $events->execute(['s_id'=>$_SESSION['id']]);
    $e=$events->fetchColumn();
    return $e;
  }

  function countA(){
    global $pdo;
    $anns = $pdo->prepare("SELECT COUNT(*) FROM announcement WHERE level='0' OR level=:levs");
    $anns->execute(['levs'=>$_SESSION['level']]);
    $a=$anns->fetchColumn();
    return $a;
  }
 

?>

<div class="columns" style="margin:0px;">

    <div class="column has-background-light card is-one-third functionalities " style="display:block;margin:20px;text-align:center;">

            <div class="notification card is-success" id="openRoutine">
                <img id="openRoutine" src="../../images/routine.png" alt="routine"style="width:90px;" title="Routine">
                <br>
                <p class="title is-5">Routine</p>
            </div>
                  
            <div class=" card notification is-warning" id="openAnnouncement">
                <span class="badge is-badge-danger" data-badge="<?=countA();?>" style="padding:6px;">
                    <img id="openAnnouncement" src="../../images/announce.png" alt="announcement"style="width:90px;" title="Announcements">
                </span>

                <br>
                <p class="title is-5">Announcements</p>
            </div>

             <a href="events&plans.php">  
                <div class="card notification is-info">
                    <span class="badge is-badge-warning" data-badge="<?=countE();?>" style="padding:6px;">
                        <img id="openMyEvents" src="../../images/timeline.png" alt="events"style="width:90px;" title ="Events">
                    </span>    
                    <br>              
                    <p class="title is-5">Events & Plans<p>       
                </div>
            </a> 

    </div>

    <div class="column" style="margin:20px;">

        <div class="tile  is-ancestor">
                <div class="tile is-parent is-5 ">
                     <article class="tile  is-child box" style="text-align:center;">
                        <a href="pat.php">
                            <div class="card notification is-primary">
                                <img id="openMyEvents" src="../../images/interview.png" alt="events"style="width:90px;" title ="Events">
                                <br>
                                <p class="title is-5">Personal Academic Tutoring<p>
                            </div>
                         </a>
                            <br>
                        <a href="attendance.php">
                         <div class="card notification is-link">
                            <img id="openMyEvents" src="../../images/analytics.png" alt="events"style="width:90px;" title ="Events">
                            <br>
                            <p class="title is-5">  Attendance    <p>
                         </div>
                         </a>
                        

                    </article>
                </div>

                <div class="tile  is-parent">
                    <article style="margin-left:8px;">
                        <nav class="panel">
                            <p class="panel-heading">
                                <i class="fas fa-user-cog" style="margin-right:10px;"></i>Modules
                            </p>
                                <input type="hidden"  id="myLevel">                              
                            <?php 
                                $modules = new Table('modules');
                                $module =$modules->groupProjectFind('level',$_SESSION['level']);
                                foreach ($module as $m ) { ?>
                                
                                    <a class="panel-block moduleLink " href="module.php?m_code=<?=$m['m_code']?>" id="<?=$m['m_code'];?>">
                                        <span class="panel-icon">
                                        <i class="fas fa-book" aria-hidden="true"></i>
                                        </span>
                                       <?=$m['m_code']." ". $m['m_name']?>
                                     </a>
                            <?php  } ?>
                        </nav>    
                    </article>
                </div>


        </div>

    </div>


</div>

<style>
.functionalities div{
    cursor:pointer;
    padding:20px;
    font-size:20px;
}


</style>

<script>

$('.moduleLink').click(function(){
    window.location = "../other/student/modules.php";
    $.ajax({
        url:'modules.php',
        method:"POST",
        data:{m_code:$(this).attr('id')},
        success:function(data){
            $('#studentInsert').html(data);
        }
    });
});




</script>