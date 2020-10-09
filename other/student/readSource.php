<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/headerInfo.php';
?>
<div style="margin:5px;padding:10px;" > 
    <?php 

$read = new setHeader();
$read->setInfo('<i class="fas fa-tags"></i>  Reading Resources');
$read->addactionButtons([]);
echo $read->placeHeader();

    if(isset($_POST['m_code'])){
    $content =$pdo->prepare('SELECT * FROM  readingresources WHERE m_code=:m_code ');
    $content->execute(['m_code'=>$_POST['m_code']]);
    
    if($content->rowCount()>0){
    foreach ($content as $con ) {?>
            <br>
            <div class="notification card">
                 <button class="delete"></button>
                    <p class="title ">
                        <a href="<?=$con['r_link']?>" target="_blank" style="text-decoration:none;">
                            <i class="fas fa-file-alt" style="font-size:40px;"></i>
                             <?=$con['r_title']?>
                        </a>   
                    </p>
                </div>
            </div>
    <?php
    }

    }
    else{
      echo '<br><div style="text-align:center"><p class="title is-4">No reading resources found.</p></div>';

    }



    }
    ?>
    
    
    

</div>