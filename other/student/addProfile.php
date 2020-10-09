<?php 
header('Content-type: application/json');
require '../../db/dbconnect.php';
require '../../classes/Table.php';


if(!isset($_SESSION)){session_start();}  
$err=[];
$out=[];

$supported_exT = array('jpg','jpeg','png','gif'); 

$fileexT =strtolower(substr($_FILES['image']['name'],strrpos($_FILES['image']['name'],'.')+1)); 

if(in_array($fileexT,$supported_exT)==false){
        $err[]='Please choose correct image format'; 
}

if(empty($err)){ 
    move_uploaded_file($_FILES['image']['tmp_name'],"../../images/studentPics/{$_FILES['image']['name']}");

    if($_POST['sp_id']==''){
        $sprofile= $pdo -> prepare('INSERT INTO student_profile_pic ( image,s_id) VALUES ( :image,:s_id)');   
        $scrit=["image"=> $_FILES['image']['name'],"s_id"=>$_SESSION['id']];

        if($sprofile->execute($scrit)){ 
            $out['picStat']="Profile Picture Added"; 
        }
    }   
    else{
            
        
        $eprofile= $pdo -> prepare('UPDATE student_profile_pic SET image=:image WHERE s_id=:s_id');   
        $ecr=["s_id"=>$_SESSION['id'],
                    "image"=> $_FILES['image']['name']];

        if($eprofile->execute($ecr)){ 
            $out['picStat']="Profile Picture Updated"; 
        }
      
    } 

} 
else{
    $out['picStat']="Upload supported file only";
}

echo json_encode($out);



?>