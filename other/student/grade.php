<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/headerInfo.php';
if(!isset($_SESSION)){session_start();}  

$moduleAc = new setHeader();
$moduleAc->setInfo('<i class="fas fa-tags"></i>  Grades');
$moduleAc->addactionButtons([]);
echo $moduleAc->placeHeader();


function loadResult($asn_id ,$id){
    global $pdo;
    $content =$pdo->prepare('SELECT s_grade FROM  submission_grade WHERE asn_id=:asn_id AND s_id=:s_id');
    $content->execute(['asn_id'=>$asn_id  , 's_id'=>$id   ]); 

    if($content->rowCount()>0){
        $grade = $content->fetchColumn();
        return '<p class="title is-3">'.$grade.'</p>';
    }

    else{
            return "Submit  your work and wait for the grade";
    }
}

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
                   
            <div style="margin:10px;padding:20px;">

                <?= loadResult($con['asn_id'], $_SESSION['id']);?>
            
            </div>
            

        </div>

<?php
}
}
else{
    echo '<br><div style="text-align:center"><p class="title is-4">No gradings found</p></div>';
}
}
?>