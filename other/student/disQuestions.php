<?php 
   require '../../db/dbconnect.php';
   require '../../classes/Table.php';
   require '../../classes/headerInfo.php';
?>

<div style="margin:5px;padding:10px;" > 
    <?php 

    $moduleAc = new setHeader();
    $moduleAc->setInfo('  <i class="fas fa-comments"></i>  Discussion Boards');
    $moduleAc->addactionButtons(['<button id="startDiscuss" class="button is-success"><i class="fas fa-plus-square" style="margin-right:10px;"></i>  Start a Discussion </button>']);
    echo $moduleAc->placeHeader();
    

if(isset($_POST['m_code'])){
    $content =$pdo->prepare('SELECT * FROM  discussion WHERE m_code=:m_code ORDER BY d_id DESC');
    $content->execute(['m_code'=>$_POST['m_code']]);
    
    if($content->rowCount()>0){
        foreach ($content as $con ) {?>
               <br>
               <a href="answer.php?d_id=<?=$con['d_id']?>">
                    <div class="notification card">
                    <button class="delete"></button>
                    <br>
                    <p class="subtitle" style=" word-break: break-all;"><i class="fas fa-comments"></i>   <?= $con['d_question']?></p> 
                    </div>
                </a>
        <?php
        }

    }

    else{
      echo '<br><div style="text-align:center"><p class="title is-4">No Discussions found</p></div>';

    }



}
?>
    
    
    

</div>


<div class="modal" id="askModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title"> <i class="fas fa-question-circle"></i> Ask a Question</p>
      <button class="delete"  id="closeAsk" aria-label="close"></button>
    </header>
    <section class="modal-card-body">

        <form  id="askForm">
            <div class="field">
            <label  class="label">Question: </label>
                <div class="control">
                <textarea  id="d_question" name="d_question"  style="resize:none;width:100%;height:150px;" required></textarea>
                </div>
            </div>
        
        <input type="submit" class="button is-success" value="Save">
        
        </form>
    </section>
    <footer class="modal-card-foot">
    </footer>
  </div>
</div>


<script>

$("#startDiscuss").click(function(){
    $('#askModal').toggleClass('is-active');
});


$('#closeAsk').click(function(){
    $('#askModal').removeClass('is-active');
});




$('#askForm').submit(function(e){
    e.preventDefault();

    var currentModule =$('.curMod').attr('id');
  
    $.ajax({
        url:'askQuestion.php',
        method:'POST',
        data:{d_question:$('#d_question').val(),m_code:currentModule},
        success:function(res){
            alert(res.event);
            underlyingD();
            document.getElementById('#askForm').reset();
        }

    });


});

</script>