<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/headerInfo.php';
if(!isset($_SESSION)){session_start();}

$submitAssign = new setHeader();
$submitAssign->setInfo('<i class="fas fa-file-upload"></i> Submit your work');
$submitAssign->addactionButtons([]);
echo $submitAssign->placeHeader();

if(isset($_POST['m_code'])){
$content =$pdo->prepare('SELECT * FROM  assignments WHERE m_code=:m_code ORDER BY asn_id DESC');
$content->execute(['m_code'=>$_POST['m_code']]);

if($content->rowCount()>0){
foreach ($content as $con ) {?>
<br>
        <div class="box  has-background-light has-ribbon-left is-small">
             <div class="ribbon is-medium is-success " >
            <?=$con['asn_title']?> <a class="delete is-small" style="margin-top:8px;"></a>
             </div>
                   
             <div  style="margin-top:30px;padding:10px;">

                <div>
                <?php 
                $mywork = $pdo->prepare("SELECT submission_file FROM submitted_assignments WHERE s_id=:s_id AND asn_id=:asn_id");
                $mywork->execute([ 's_id'=> $_SESSION['id'] ,'asn_id'=>$con['asn_id']]);
                
                $sfile = $mywork->fetchColumn();

                if($sfile!=''){
                
                ?>
                     <span class="tag is-danger is-large" style="">
                                <a style="color:white;"download="<?=$sfile?>" href="../../assignmentSubmission/<?=$sfile?>">
                                    <i class="fas fa-file-download"></i>  <?= substr($sfile,3,8).".."?>
                                </a> 
                                    <button class="delete  is-small"></button>
                    </span>
            
                <?php }?>
                </div>

             <br>
                <form class="submitFile" id="form">

                <input type="file" name="submission_file" required>
                <input type="hidden" name="asn_id" value="<?=$con['asn_id']?>">
                <input type="hidden" name="s_id" value="<?=$_SESSION['id']?>">
                <input type="hidden" name="submission_date" value="<?=date("Y/m/d");?>">
                <input type="submit" value="Upload" class="button is-link">
                
                </form>
            </div>

        </div>

<?php
}
}
else{
    echo '<br><div style="text-align:center"><p class="title is-4">No assignments found</p></div>';
}
}
?>


<script>

$('form.submitFile').submit(function(e){
    e.preventDefault();
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'submitWork.php',
        method:'POST',
        data:formData,
        success:function(res){
           alert(res);
           submitWork();
           document.getElementById('form').reset();
        },
        cache: false,
        contentType: false,
        processData: false
    });


});

</script>