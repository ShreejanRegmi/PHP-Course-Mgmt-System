<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';




$reads = new Table('readingresources');
$read = $reads->groupprojectFind('m_code',$_POST['m_code']);

foreach($read as $r){?>

<div class="notification card ">
  <button class="delete deleteRead" id="<?=$r['r_id']?>"></button>
    <a target="_blank" href="<?=$r['r_link']?>" style="text-decoration:none;">
            <p class="title is-4"><i class="fas fa-file-alt" style="font-size:40px;"></i>
            <strong><?=$r['r_title']?></strong>
            </p> 
    </a>
</div>



<?php }?>

<input type="hidden" value="<?=$_POST['m_code']?>" id="cM">

<div class="modal" id="deletetReadModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Delete </p> 
      <button class="delete closerm" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
       Are you sure you want to delete this link?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger " id="confirmtReadDelete" >Delete</button>
      </footer>
  </div>
 
</div>

<script>

$('.deleteRead').click(function(){
    $('#confirmtReadDelete').val($(this).attr('id'));
    $('#deletetReadModal').toggleClass('is-active');
});

$('.closerm').click(function(){
    $('.modal').removeClass('is-active');
});

$('#confirmtReadDelete').click(function(){
    $id=$(this).val(); 
    $.ajax({
        url:"../other/tutor/delete.php",
        method:'POST',
        data:{table:'readingresources',field:'r_id',value:$id},
        success:function(data){
            console.log(data);
            if(data=='Deleted'){
              readsOf($('#cM').val());
            }
        }
    });

});

</script>