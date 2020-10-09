<?php 
header('Content-type: application/json');
require '../db/dbconnect.php';
require '../classes/Table.php';
if(!isset($_SESSION)){session_start();}  



$event=[];


if($_SESSION['table']=="staff"){

    $teachsec= new Table('staff_security');
    $teach= $teachsec->groupProjectFind('staff_id',$_SESSION['id']);

    if($teach->rowCount()>0){
        $upStSec = $pdo->prepare("UPDATE staff_security SET sec_question=:sec_question, sec_answer=:sec_answer WHERE staff_id=:id");
        if(  $upStSec->execute(
            [ 'sec_question'=>$_POST['sec_question'], 'sec_answer' => $_POST['sec_answer'] ,'id'=> $_SESSION['id']           ])    ){
                $event['what']="Security question updated";
        }

    }

    else{
       
        $inStSec = $pdo->prepare("INSERT INTO staff_security (staff_id, sec_question, sec_answer) VALUES (:staff_id, :sec_question, :sec_answer)");
        if($inStSec->execute(['sec_question'=> $_POST['sec_question'], 'sec_answer'=>$_POST['sec_answer'] ,'staff_id' =>$_SESSION['id']] )){
            $event['what']="Security question added";
        }
    
    }
 
}


else if($_SESSION['table']=="students"){


    $studentsec= new Table('student_security');
    $stu= $studentsec->groupProjectFind('student_id',$_SESSION['id']);

    if($stu->rowCount()>0){
        $upStuSec = $pdo->prepare("UPDATE student_security SET sec_question=:sec_question, sec_answer=:sec_answer WHERE student_id=:id");
        if(  $upStuSec->execute(
            [ 'sec_question'=>$_POST['sec_question'], 'sec_answer' => $_POST['sec_answer'] ,'id'=> $_SESSION['id']           ])    ){
                $event['what']="Security question updated";
        }

    }

    else{

        $inStuSec = $pdo->prepare("INSERT INTO student_security (student_id, sec_question, sec_answer) VALUES (:student_id, :sec_question, :sec_answer)");
        if($inStuSec->execute(['sec_question'=> $_POST['sec_question'], 'sec_answer'=>$_POST['sec_answer'] ,'student_id' =>$_SESSION['id']] )){
            $event['what']="Security question added";
        }
    
    }


}


echo json_encode($event);

?>