<?php 
   require '../../db/dbconnect.php';
   require '../../classes/Table.php';
   require '../../classes/headerInfo.php';
?>
<div style="margin:5px;padding:10px;" > 
    <?php 

    $moduleAc = new setHeader();
    $moduleAc->setInfo('<i class="fas fa-swatchbook"></i>  Module Activities');
    $moduleAc->addactionButtons([]);
    echo $moduleAc->placeHeader();
    
    if(isset($_POST['m_code'])){
    $content =$pdo->prepare('SELECT * FROM  module_content WHERE m_code=:m_code ORDER BY mc_id DESC');
    $content->execute(['m_code'=>$_POST['m_code']]);
    
    if($content->rowCount()>0){
    foreach ($content as $con ) {?>
            
            <div class="box  has-background-light has-ribbon-left is-small">
                 <div class="ribbon is-medium is-success " >
                <?=$con['mc_title']?> <a class="delete is-small" id="<?=$con['mc_id']?>" style="margin-top:8px;"></a>
                 </div>
                       
                 <div style="margin-top:20px;padding:10px;">
                   <?=$con['mc_description']?>
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
                               <a style="color:white;" download="<?=$f['mc_filename']?>" href="../../fileContent/<?=$f['mc_filename']?>">
                               <i class="fas fa-file-download"></i>  <?= substr($f['mc_filename'],3,8).".."?>
                               </a> 
                            </span>
                            </div>
                            
                          <?php  }
    
                            ?>
                            </div>
                        </div>         
                </div>
    
            </div>
           
    
        
    
    <?php
    }

    }
    else{
      echo '<br><div style="text-align:center"><p class="title is-4">No content found</p></div>';

    }



    }
    ?>
    
    
    

</div>