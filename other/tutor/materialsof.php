<link rel="stylesheet" type="text/css" href="../css/ribbon.css">
<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';

if(isset($_POST['m_code'])){
$content =$pdo->prepare('SELECT * FROM  module_content WHERE m_code=:m_code ORDER BY mc_id DESC');
$content->execute(['m_code'=>$_POST['m_code']]);

foreach ($content as $con ) {?>
    
    
        <div class="box  has-background-light has-ribbon-left is-small">
             <div class="ribbon is-medium is-success " >
            <?=$con['mc_title']?> <a class="delete delMContent is-small" id="<?=$con['mc_id']?>" style="margin-top:8px;"></a>
             </div>
                   
             <div style="margin-top:20px;padding:10px;">
                Description:  <?=$con['mc_description']?>
             </div>

            <div class="" style="padding:5px;">


                    <div class="filesHere" style="text-align:center;padding:10px;">
                        <div class="columns is-multiline">
                        <?php 
                        $files = new Table('module_files');
                        $file =$files->groupProjectFind('mc_id',$con['mc_id']);

                        foreach($file as $f){?>
                        <div class="column">
                        <span class="tag is-danger is-large" style="">
                           <a download="<?=$f['mc_filename']?>" href="../fileContent/<?=$f['mc_filename']?>">
                           <i class="fas fa-file-download"></i>  <?= substr($f['mc_filename'],3,8).".."?>
                           </a> 
                            <button class="delete dcontentFile is-small" id="<?=$f['mf_id']?>"></button>
                        </span>
                        </div>
                        
                      <?php  }

                        ?>
                        </div>
                        <button class=" addFileUnder button is-warning" id="<?=$con['mc_id']?>"style="padding:19px;">
                            <i class="fas fa-plus-square"></i>
                        </button>
                    </div>

                    
            </div>

        </div>
       

    

<?php
}

}
?>

<script>
$('.dcontentFile').click(function(){
    $('#deletetFileModal').toggleClass('is-active');
    $('#confirmtFileDelete').val($(this).attr('id'));

});


$('.delMContent').click(function(){
    $('#deleteContentModal').toggleClass('is-active');
    $('#confirmtContentDelete').val($(this).attr('id'));

});

$('.addFileUnder').click(function(){
    $('#addContemtFileModal').toggleClass('is-active');
    $('#confirmtFileAdd').val($(this).attr('id'));
});

$('#confirmtFileDelete').click(function(){
    $mfd=$('#confirmtFileDelete').val();
    $.ajax({
                url:"../other/tutor/deleteContentFile.php",
                method:"POST",
                data:{mf_id:$mfd},
                success:function(data){
                    console.log(data);
                    if(data=='contentFileDeleted'){
                        loadMaterials();
                       
                    }
                }
            });

});

$('#confirmtContentDelete').click(function(){
    $mcd=$('#confirmtContentDelete').val();
    $.ajax({
                url:"../other/tutor/deleteContentModule.php",
                method:"POST",
                data:{mc_id:$mcd},
                success:function(data){
                    console.log(data);
                    if(data=='contentModuleDeleted'){
                        loadMaterials();
                    }
                }
            });

});


</script>

<style>

a{
    color:white;
}
</style>