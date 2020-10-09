<?php 
$pdo= new PDO('mysql:dbname=csy2027e;host=localhost', 'root', '');
if(!isset($_SESSION)){session_start();}  
require '../classes/Table.php';

function checkAnswer($table,$field,$id){
    $table = new Table($table);
    $t=$table->groupProjectFind($field,$id);

    foreach($t as $tt ){
        return $tt['sec_answer'];
    }
}


if(  
    $_POST['sec_answer']== (checkAnswer ($_SESSION['table'],$_SESSION['field'] ,$_SESSION['id']) )    
        
) {

    header('Location:updatePassword.php');
}

else{
header('Location:confirmAnswer.php?message=Wrong answer ! Try again!');
}

?>


