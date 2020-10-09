<script src="../js/tabs.js"></script>
<?php 
if(!isset($_SESSION)){session_start();} 

require '../../db/dbconnect.php';
require '../../classes/headerinfo.php';

$read = new setHeader();
$read->setInfo('<i class="fas fa-paperclip"></i> Reading Resouces');
$read->addactionButtons(['']);

echo $read->placeHeader();

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
              <a class="readOfthisMod"  id="<?=$staff['m_code']?>">
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
    <nav class="level">
        <div class="level-left">

        </div>
        <div class="level-right" >
            <div class="level-item">
                        <button class="button  addreadonThisMod
                         is-info"  style="width:200px;" >
                            <i class="fas fa-paperclip" style="margin-right:10px;"></i>
                            Add
                        </button>
            </div>
        </div>
    </nav>
    
<?php } 


else{
  echo "Not affiliated to any modules";
}?>

    <div class="allreads">
    
    </div>
</div> 


<div class="modal" id="addreadModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Add Reading resources</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
    <form method="POST" id="readForm" enctype="multipart/form-data">

      <div class="field">
        <label class="label">Title:</label>
              <p class="control has-icons-left">
                <input class="input" id="r_title" type="text" placeholder="Title" required>
                <span class="icon is-small is-left">
                <i class="fas fa-folder"></i>
                </span>
              </p>
      </div>

        <input type="hidden"  id="rm_code">

          <div class="field">
            <label class="label">Link:</label>
              <p class="control has-icons-left">
                <input class="input" id="r_link" type="text" placeholder="https://....." required>
                <span class="icon is-small is-left">
                <i class="fas fa-paperclip"></i>
                </span>
              </p>  
          </div>

          <input type="submit" class="button is-success" value="Save">
     </form>
    </section>
      <footer class="modal-card-foot">
      </footer>
  </div>
</div>


<script>

$staff_id=<?=$_SESSION['id']?>;

$('#firstTaskTab').toggleClass('is-active');

function readsOf($m_code){
    $.ajax({
                url:"../other/tutor/readsof.php",
                method:"POST",
                data:{m_code:$m_code},
                success:function(data){
                    $(".allreads").html(data);   
                }
            });
}


function firstLoad($staff_id){
    $.ajax({
                url:"../other/tutor/preModule.php",
                method:"POST",
                data:{staff_id:$staff_id},
                success:function(data){
                    readsOf(data);
                    $(".addreadonThisMod").val(data);
                }
            });
}   


firstLoad($staff_id);

$('.readOfthisMod').click(function(){
    readsOf($(this).attr('id'));
    $(".addreadonThisMod").val($(this).attr('id'));
});

$(".addreadonThisMod").click(function(){
    $("#addreadModal").toggleClass('is-active');
    $("#rm_code").val($(this).val());
});

$('.delete').click(function(){
    $('.modal').removeClass('is-active');
});



$('#readForm').submit(function(event){
  event.preventDefault();
  var r_title=$('#r_title').val();
  var r_link =$('#r_link').val();
  var m_code = $("#rm_code").val();

  var dataS= 'm_code='+m_code+'&r_title='+r_title+'&r_link='+r_link;

  $.ajax({
    type: "POST",
    url: "../other/tutor/addRead.php",
    data: dataS,
    cache: false,
    success: function(data) {
      console.log(data);
      if(data.sourceAdded==true){
          $('.modal').removeClass('is-active');
          $('#r_title').val('');
          $('#r_link').val('');
          readsOf($(".addreadonThisMod").val());
      }
    }
});


});


</script>