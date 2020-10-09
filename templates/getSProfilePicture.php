<?php 


function myProfilePic($id){

    $pics =new Table('student_profile_pic');
    $pic = $pics->groupProjectFind('s_id',$id);

    if($pic->rowCount()>0){
       foreach($pic as $p){
            echo "<img  id='myprofilePic'  src='../../images/studentPics/".$p['image']."' style='margin-right:5px;width:50px;height:80px;'  >";
       }     
    }
    else{
        echo ' <i id="myprofilePic" class="fas fa-user-circle" style="margin-right:10px;font-size:25px;"></i>';
    }
}


?>