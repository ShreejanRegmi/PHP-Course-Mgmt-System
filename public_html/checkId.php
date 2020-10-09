<?php 
$pdo= new PDO('mysql:dbname=csy2027e;host=localhost', 'root', '');
if(!isset($_SESSION)){session_start();}  
require '../classes/Table.php';



function checkId($table,$field,$value){
    $table = new Table($table);
    $t=$table->groupProjectFind($field,$value);

    if($t->rowCount()>0){
            return true;
    }
    else{
        return false;
    }
}





if(checkId('staff','staff_id',$_POST['sid'] ) ==true){
    $_SESSION['id']=$_POST['sid'];
    $_SESSION['table']='staff_security';
    $_SESSION['field']='staff_id';
    header('Location:confirmAnswer.php');

}

if(checkId('students','s_id',$_POST['sid']) ==true){
    $_SESSION['id']=$_POST['sid'];
    $_SESSION['table']='student_security';
    $_SESSION['field']='s_id';
    header('Location:confirmAnswer.php');
    
}


if( 
    (checkId('students','s_id',$_POST['sid']) ==false)
        &&
    (checkId('staff','staff_id',$_POST['sid']) ==false)

){

header('Location:forgetPassID.php?message=No such id exist');

}




?>


