<script src="../js/tabs.js"></script>
<?php 
if(!isset($_SESSION)){session_start();} 

require '../../db/dbconnect.php';
require '../../classes/headerinfo.php';

$att = new setHeader();
$att->setInfo('<i class="fas fa-clipboard-list"></i> Attendance');
$att->addactionButtons(['']);

echo $att->placeHeader();

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
              <a class="attendanceOfthisMod"  id="<?=$staff['m_code']?>">
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
if($staffQuery->rowCount()>0){?>
        <div class="attendanceDiv">
        
        </div>
    
<?php } 


else{
  echo "Not affiliated to any modules";
}?>


<script>



$('#firstTaskTab').toggleClass('is-active');
$staff_id=<?=$_SESSION['id']?>;

function attendanceOf($m_code){
    $.ajax({
                url:"../other/tutor/attendanceof.php",
                method:"POST",
                data:{m_code:$m_code},
                success:function(data){
                    $(".attendanceDiv").html(data);   
                }
            });
}


function firstAtten($staff_id){
    $.ajax({
                url:"../other/tutor/preModule.php",
                method:"POST",
                data:{staff_id:$staff_id},
                success:function(data){
                    attendanceOf(data);
                }
            });
} 

firstAtten($staff_id);

$('.attendanceOfthisMod').click(function(){
    attendanceOf($(this).attr('id'));
});
</script>