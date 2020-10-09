<?php 
require '../../classes/Table.php';
require '../../db/dbconnect.php';
require '../../classes/headerInfo.php';

if(!isset($_SESSION)){session_start();}  


$query = $pdo->prepare('SELECT d.* FROM discussion d JOIN modules m ON d.m_code= m.m_code WHERE m.level=:level AND d.d_id=:d_id');
$query->execute(['level'=>$_SESSION['level'],'d_id'=>$_GET['d_id']]);
$rowCount=$query->rowCount();


if($rowCount==0){
  header('Location:student.php');
}

function specificProfilePic($id){
    $pics =new Table('student_profile_pic');
    $pic = $pics->groupProjectFind('s_id',$id);

    if($pic->rowCount()>0){
       foreach($pic as $p){
            echo "<img  id='myprofilePic'  src='../../images/studentPics/".$p['image']."' style='width:128px;height:64px;'  >";
       }     
    }
    else{
        echo ' <i id="myprofilePic" class="fas fa-user-circle" style="font-size:64px;"></i>';
    }
}

$question=$pdo->prepare('SELECT d_question FROM discussion WHERE d_id=:d_id');
$question->execute(['d_id'=> $_GET['d_id']]);

$qTions = $question->fetchColumn();


$qq= new setHeader();
$qq->setInfo('<i class="fas fa-question-circle"></i> '.$qTions);
$qq->addactionButtons([]);
echo $qq->placeHeader();

?>

<div class="card" style="margin:20px; padding:30px;"> 

<?php

$students= $pdo->prepare('SELECT * FROM discussion_comment dc JOIN students s ON dc.s_id=s.s_id

              WHERE dc.d_id =:d_id ORDER BY dc.dc_id DESC');

$students->execute(['d_id'=>$_GET['d_id']]);

if($students->rowCOunt()>0){

foreach($students as $st){
?>



<div class="">
  <article class="media">
    <div class="media-left">
      <figure class="image is-64x64">
       <?php specificProfilePic($st['s_id'])?>
      </figure>
    </div>
    <div class="media-content">
      <div class="content">
        <p>
          <strong><?= $st['s_firstname']." ".$st['s_lastname'] ?></strong> <small>@ <?= $st['date']?> </small>
          <br>
          <?=$st['comment']?>
         </p>
      </div>

      <?php  if($st['s_id']==$_SESSION['id']){ ?>
          <nav class="level is-mobile">
            <div class="level-left">
              <br>
              <a class="level-item" aria-label="reply">
                <span class="icon is-small ">
                <i class="fas fa-trash-alt deleteMycomment" id="<?= $st['dc_id']?>" ></i>
                </span>
              </a>
            </div>
          </nav>
      <?php } ?>

    </div>
  </article>
</div>
<hr>


<?php }

}


else{?>

<div style="tex-align:center;margin:20px;">

<p class="subtitlte is-size-5">Be the first to comment...</p>
</div>

<?php }
?>


<br>


<article class="media  notification">
  <figure class="media-left">
    <p class="image is-64x64">
     <?php specificProfilePic($_SESSION['id'])?>
    </p>
  </figure>
  <div class="media-content">
    <form id="writeComment">
        <textarea class="textarea" name="comment" placeholder="Add a comment..." required></textarea>
        <input type="hidden" id="d_id" name="d_id" value="<?=$_GET['d_id']?>">
        <br>       
        <input type="submit" class="button is-link" value="Submit">
    </form>
  </div>
</article>


</div>




<div class="modal" id="deleteMycommentModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Delete this comment?</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
        Confirm Deletion?
    </section>
    <footer class="modal-card-foot">
      <button class="button is-danger" id="confirmCommentDelete">Delete</button>
    </footer>
  </div>
</div>

<script>

$('.deleteMycomment').click(function(){

  $('#deleteMycommentModal').toggleClass('is-active');
  $('#confirmCommentDelete').val($(this).attr('id'));
});


$('form#writeComment').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'addComment.php',
        method:'POST',
        data:formData,
        success:function(res){
           location.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


$('#confirmCommentDelete').click(function(){

$.ajax({
  url:'deleteMycomment.php',
  method:'POST',
  data:{dc_id:$('#confirmCommentDelete').val()},
  success:function(data){
    alert(data);
    location.reload();
  }
});

});


</script>