<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/headerInfo.php';

$moduleAc = new setHeader();
$moduleAc->setInfo('<i class="fas fa-tags"></i>  Assessment Information');
$moduleAc->addactionButtons([]);
echo $moduleAc->placeHeader();

if(isset($_POST['m_code'])){
$content =$pdo->prepare('SELECT * FROM  assignments WHERE m_code=:m_code ORDER BY asn_id DESC');
$content->execute(['m_code'=>$_POST['m_code']]);

if($content->rowCount()>0){
foreach ($content as $con ) {?>
        <div class="box  has-background-light has-ribbon-left is-small">
             <div class="ribbon is-medium is-success " >
            <?=$con['asn_title']?> <a class="delete is-small" style="margin-top:8px;"></a>
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
                                <a style="color:white;" download="<?=$f['assignment_file']?>" href="../../assignmentFile/<?=$f['assignment_file']?>">
                                    <i class="fas fa-file-download"></i>  <?= substr($f['assignment_file'],3,8).".."?>
                                </a> 
                                    <button class="delete  is-small" id="<?=$f['asf_id']?>"></button>
                                </span>
                                </div>   
                            <?php  } ?>
                        </div>           
                    </div> 
                    <br>                  
                    <div class="level">
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
else{
    echo '<br><div style="text-align:center"><p class="title is-4">No assignments found</p></div>';
}
}
?>