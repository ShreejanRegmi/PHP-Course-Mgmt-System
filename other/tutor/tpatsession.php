<link rel="stylesheet" type="text/css" href="../css/ribbon.css">
<?php 
if(!isset($_SESSION)){session_start();} 

function attendColor($what){
    if($what =='true'){
        return 'is-success';
    }
    else{
        return 'is-danger';
    }
}

require '../../db/dbconnect.php';
require '../../classes/headerinfo.php';
require '../../classes/Table.php';

$patsession = new setHeader();
$patsession->setInfo(' <i class="fas fa-hands-helping"></i> PAT SESSIONS');
$patsession->addactionButtons(['']);
echo $patsession->placeHeader();
?>

<div class="modal" id="patModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">  <i class="fas fa-hands-helping"></i>PAT SESSION</p>
      <button class="delete closepatModal" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <form  id="sessionForm">
          <input type="hidden" id="seshId" name="sess_id">
        <div class="field">
            <label class="label">Summary:</label>
            <div class="control">
                <textarea  id="summary" name="summary"  style="resize:none;width:100%;height:150px;" required></textarea>
            </div>
        </div>

        <div class="field">
            <label class="label">Attended:</label>
            <div class="control">
                <div class="select">
                    <select name="attended">
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                </div>
            </div>

        </div>
        <input type="submit" value="Save" class="button is-info is-pulled-right">
      </form>
    </section>
    <footer class="modal-card-foot">
    </footer>
  </div>
</div>


<div class="columns" style="margin:10px;">

    <div class="column is-6">
        <p class="subtitle is-5"><i class="fas fa-spinner"></i> Pending:</p>
        <?php 
        $patSeshs =$pdo->prepare('SELECT * FROM pat_session JOIN students WHERE pat_session.s_id=students.s_id AND pat_session.summary IS NULL
                                    AND pat_session.staff_id=:staffId');
        $patSeshs->execute(['staffId'=>$_SESSION['id']]);
        ?>

        <div style="padding:10px;">
        
            <?php 
            if($patSeshs->rowCount()>0){
            foreach($patSeshs as $pat){?>

            <div class="box  has-background-light has-ribbon-left is-small">
                <div class="ribbon is-medium is-success " >
                         <?=$pat['s_firstname']." ".$pat['s_lastname']?> <a class="delete"  style="margin-top:8px;"></a>
                </div>
                <div  class="query" style="width:100%;word-wrap: break-word;padding:10px; margin-top:20px;">
                    <p class="subtitle has-text-right is-6">
                        <i class="fas fa-calendar-alt"></i>
                        <?=$pat['date']?>
                        <br>
                        <i class="fas fa-clock"></i>
                        <?=$pat['time']?>
                    </p>

                    <br>
                   <p class="title is-6">Query : </p> 
                   <?=$pat['query']?>
                        <br><br>
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <a id="<?=$pat['sess_id']?>" class="button changePat is-info">
                                    <i class="fas fa-cog" style="margin-right:5px;"></i>   
                                    Check
                                </a>
                            </p>

                            <p class="control">
                                <a id="<?=$pat['sess_id']?>" class="button rejectPat is-danger">
                                    <i class="fas fa-user-slash"  style="margin-right:5px;"></i> 
                                    Reject
                                </a>
                            </p>
                        </div>
                    
                </div>
             </div>
            <?php    }
            }
            else{
                echo  "No pat sessions ";
            }
            ?>
        </div>        
    </div>

    <div class="column card " >
        <p class="subtitle is-5"><i class="fas fa-history"></i> Previous records:</p>
        <br>
        <div>
        <?php 
        $studentList = new Table('students');
        $patList = $studentList->groupProjectFind('staff_id',$_SESSION['id']);
        foreach($patList as $p){?>
            <div class="card notification dropMenu"  style="padding:5px; cursor:pointer;">
              <p class="subtitle is-size-5" style="margin:5px;"><i class="fas fa-user"></i> <?=$p['s_firstname']." ".$p['s_lastname']?></p>    
                <br>
                <?php 
                    $summarys = $pdo->prepare('SELECT * FROM pat_session WHERE s_id=:ssid AND summary IS NOT NULL ');
                    $summarys->execute(['ssid'=>$p['s_id']]);

                    if($summarys->rowCount()>0){
                        foreach($summarys as $ss){?> 
                            <div class="notification card <?=attendColor($ss['attended'])?> dropThis" style="text-align: justify; ">
                                    <p class="is-pulled-right">
                                    <i class="fas fa-calendar-alt"></i>   <?=$ss['date']?>
                                        <br>
                                    <i class="fas fa-clock"></i>    
                                        <?=$ss['time']?>
                                    </p>
                                    <br>  
                                    <br> 
                                    <br> 
                                
                                <div style="word-break: break-all;">
                                        <p class="subtitle is-size-5"><?=$ss['query'] ?></p>
                                        <br>
                                        <?=$ss['summary']?>
                                </div> 
                            </div>    
                        <?php  
                        }   
                    }    
                    else{?>
                        <div class="dropThis">
                             No records found
                        </div>
                        
                   <?php }             
                ?>
            </div>  
        <?php }?>
        </div>
    </div>
</div>

<script>

$('.changePat').click(function(){
    $('#patModal').toggleClass('is-active');
    $("#seshId").val($(this).attr('id'));
    $("#summary").val('');
});


$('.rejectPat').click(function(){
    $.ajax({
        url:"../other/tutor/rejectpat.php",
        method:"POST",
        data:{sess_id:$(this).attr('id')},
        success:function(data){
                alert(data.pat);
                loadPAT();
        }
    });
});


$('.closepatModal').click(function(){
    $('#patModal').removeClass('is-active');
});

$('form#sessionForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'../other/tutor/updateSession.php',
        method:'POST',
        data:formData,
        success:function(res){
            loadPAT();
        },
        cache: false,
        contentType: false,
        processData: false
    });
});




</script>


<style>
.dropThis{
    display:none;
}

.dropMenu:hover .dropThis{
    display: block;
  opacity: 1;
  transition: visibility 0s, opacity 10s linear;
}
</style>