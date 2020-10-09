<link rel="stylesheet" type="text/css" href="../css/ribbon.css">
<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';




if(isset($_POST['m_code'])){
$content =$pdo->prepare('SELECT * FROM  assignments WHERE m_code=:m_code ORDER BY asn_id DESC');
$content->execute(['m_code'=>$_POST['m_code']]);

foreach ($content as $con ) {?>
        <div class="box  has-background-light has-ribbon-left is-small">
             <div class="ribbon is-medium is-success " >
            <?=$con['asn_title']?> <a class="delete  is-small"  style="margin-top:8px;"></a>
             </div>
                   
             <div  style="margin-top:30px;padding:10px;">

                 <p class="subtitle"><i class="far fa-calendar-times" style="margin-right:10px;"></i><?="End Date : ".$con['asn_end']?></p> 
             
                <button class="button gradeonThisassign is-info" id="<?= $con['asn_id']?> " value="<?=$_POST['m_code']?>">
                            <i class="fas fa-cogs" style="margin-right:10px;"></i>Grade
                </button>

             </div>

        </div>

<?php
}

}
?>


<div class="modal" id="markingmodal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Grade</p>
      <button class="delete closemarking" aria-label="close"></button>
    </header>
    <section class="modal-card-body">

      <div class="gradeStudents"></div>

    </section>
    <footer class="modal-card-foot">
    </footer>
  </div>
</div>


<script>

function gradingof(id,code){
    $.ajax({

        url:'../other/tutor/gradingof.php',
        method:'POST',
        data:{asn_id:id ,m_code:code},
        success:function(data){
            $('.gradeStudents').html(data);
        }
    });
}

$('.gradeonThisassign').click(function(){
    $('#markingmodal').toggleClass('is-active');
    gradingof($(this).attr('id'),$(this).val());
});

$('.closemarking').click(function(){
    $('#markingmodal').removeClass('is-active');
});



</script>