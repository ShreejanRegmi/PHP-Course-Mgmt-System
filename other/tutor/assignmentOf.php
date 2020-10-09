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
            <?=$con['asn_title']?> <a class="delete delTassign is-small" id="<?=$con['asn_id']?>" style="margin-top:8px;"></a>
             </div>
                   
             <div  style="margin-top:30px;padding:10px;">

                    <div class="assignDetails">
                        <p><?=$con['asn_details']?></p>
                    </div>


                    <div style="margin:10px;text-align:center;">
                        <div class="columns is-multiline">
                                <?php 
                                $files = new Table('assignment_files');
                                $file =$files->groupProjectFind('asn_id',$con['asn_id']);

                                foreach($file as $f){?>
                                <div class="column">
                                <span class="tag is-danger is-large" style="">
                                <a style="color:white;" download="<?=$f['assignment_file']?>" href="../assignmentFile/<?=$f['assignment_file']?>">
                                    <i class="fas fa-file-download"></i>  <?= substr($f['assignment_file'],3,8).".."?>
                                </a> 
                                    <button class="delete dAssFile is-small" id="<?=$f['asf_id']?>"></button>
                                </span>
                                </div>
                                
                            <?php  }

                                ?>
                        </div>           
                        <button class="addFileUnderAssign button is-warning" id="<?=$con['asn_id']?>"style="padding:19px;">
                                <i class="fas fa-plus-square"></i>
                        </button>
                    </div>
                    
                    <div   class="level">
                        <div class="  level-item">
                        <p class="subtitle is-6"><i class="fas fa-calendar-check"></i>  Starts: <?=$con['asn_start']?></p> 
                        </div>

                        <div class="level-item">
                        <p class="subtitle is-6"><i class="fas fa-calendar-times"></i> Ends: <?=$con['asn_end']?></p> 
                        </div>
                    </div>

             </div>

        </div>

<?php
}

}
?>


<script>

$('.delTassign').click(function(){
    $('#confirmAssignDelete').val($(this).attr('id'));
    $('#deletetAssignModal').toggleClass('is-active');
});

$('.dAssFile').click(function(){
    $('#deletetAFModal').toggleClass('is-active');
    $('#confirmAFDelete').val($(this).attr('id'));
});

$('#confirmAssignDelete').click(function(){
    $asn=$('#confirmAssignDelete').val();
    $.ajax({
                url:"../other/tutor/deleteAssignment.php",
                method:"POST",
                data:{asn_id:$asn},
                success:function(data){
                    if(data=='assignDeleted'){
                    assignmentOf($('.addTaskonThisMod').val());
                    $('.modal').removeClass('is-active');
                    }
                }
            });

});


$('#confirmAFDelete').click(function(){
    $asn=$('#confirmAFDelete').val();
    $.ajax({
                url:"../other/tutor/deleteFile.php",
                method:"POST",
                data:{table:'assignment_files',field:'asf_id',value:$asn},
                success:function(data){
                    if(data=='FileDeleted'){
                    assignmentOf($('.addTaskonThisMod').val());
                    $('.modal').removeClass('is-active');
                    }
                }
            });

});


$(".addFileUnderAssign").click(function(){
    $('#assId').val($(this).attr('id'));
    $("#assigFileModal").toggleClass('is-active');
});





</script>