<script src="../js/tabs.js"></script>
<?php 
if(!isset($_SESSION)){session_start();} 
require '../../db/dbconnect.php';
require '../../classes/headerinfo.php';
$materials = new setHeader();
$materials->setInfo('<i class="fas fa-book" aria-hidden="true"></i>  Topic & Materials');
$materials->addactionButtons(['']);

echo $materials->placeHeader();


    $staffQuery = $pdo->prepare("SELECT * FROM teacher_modules WHERE staff_id=:id");
            $staffQuery->execute(['id'=>$_SESSION['id']]);

        if($staffQuery->rowCount()>1){
            ?>
            <br>
       <div class="tabs is-boxed is-medium is-right">
           <ul class="tabsNav">
              <?php 
                foreach ($staffQuery as $staff) {?>

                        <li id="firstLM">
                          <a class="showthisMod"  id="<?=$staff['m_code']?>">
                            <span class="icon is-small"><i class="fas fa-book"></i></span>
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
                        <button class="button addOnthisModule is-info"  style="width:200px;" >
                            <i class="fas fa-folder-plus" style="margin-right:10px;"></i>
                            Add
                        </button>
            </div>
        </div>
    </nav>
    
<?php } 


else{
  echo "Not affiliated to any modules";
}?>


    <div class="allcontents">
    
    </div>

</div>              



<div class="modal" id="addTopicModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title"> <i class="fas fa-book" aria-hidden="true"></i> Add Topic</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <div class="field">
      <label class="label">Title</label>
        <div class="control">
            <input class="input" id="newCTitle" type="text" placeholder="Title">
        </div>
      </div>

      <div class="field">
            <label class="label">Description</label>
            <div class="control">
            <textarea class="textarea" id="newCDesc" placeholder="Add Details"></textarea>
            </div>
      </div>


    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" id="confirmTopicAdd">Save</button>
    </footer>
  </div>
</div>

<div class="modal" id="deleteContentModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Delete Content</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this content?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger" id="confirmtContentDelete">Delete</button>
      </footer>
  </div>
 
</div>




<div class="modal" id="deletetFileModal">
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
        <button  class="button is-danger" id="confirmtFileDelete">Delete</button>
      </footer>
  </div>
 
</div>

<div class="modal" id="addContemtFileModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Add File</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
    <form method="POST" action="../other/tutor/addFileUnder.php"  enctype="multipart/form-data">
        <input type="file" name="fileContent"  required/>
        <button  class="button is-info" id="confirmtFileAdd" name="contentFile">Save</button>
    </form>
    </section>
      <footer class="modal-card-foot">
       
      </footer>
  </div>
 
</div>


<script>
$staff_id=<?=$_SESSION['id']?>;

function contentOf($m_code){
    $.ajax({
                url:"../other/tutor/materialsof.php",
                method:"POST",
                data:{m_code:$m_code},
                success:function(data){
                    
                    $(".allcontents").html(data);   
                }
            });
}

$('.showthisMod').click(function(){
    contentOf($(this).attr('id'));
    $(".addOnthisModule").val($(this).attr('id'));
});
         

function firstLoad($staff_id){
    $.ajax({
                url:"../other/tutor/preModule.php",
                method:"POST",
                data:{staff_id:$staff_id},
                success:function(data){
                    contentOf(data);
                    $(".addOnthisModule").val(data);
                }
            });
}   

firstLoad($staff_id);

$("#firstLM").toggleClass('is-active');
         


$('.addOnthisModule').click(function(){
    $("#addTopicModal").toggleClass('is-active');
    $("#confirmTopicAdd").val($(this).val());
    $("#newCTitle").val('');
     $("#newCDesc").val('');
});       

$('.delete').click(function(){
    $('.modal').removeClass('is-active');
});


$('#confirmTopicAdd').click(function(){
  $mCode=$(this).val();
    if($("#newCTitle").val()!="" && $("#newCDesc").val()!=""){
        $.ajax({
                url:"../other/tutor/addNewContent.php",
                method:"POST",
                data:{m_code:$mCode,mc_title:$("#newCTitle").val(),mc_description:$("#newCDesc").val()},
                success:function(data){
                   if(data.newContentAdded=true){
                    contentOf($mCode); 
                    $('.modal').removeClass('is-active');
                   }
                }
            });
    }

    else{
        alert("Try filling the form again");
    }


});



</script>