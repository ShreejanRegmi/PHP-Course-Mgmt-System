<?php 
require 'functions.php';

require '../db/dbconnect.php';

if(!isset($_SESSION)){session_start();}  

if(isset($_SESSION['id'])){

    if($_SESSION['type']=='Admin'){
        $content =templateLoad('../other/admin/adminlayout.php',[]);
        echo templateLoad('../templates/layout.php',['content'=>$content]);
    }
    else if($_SESSION['type']=='Tutor'){
        $content =templateLoad('../other/tutor/tutorlayout.php',[]);
        echo templateLoad('../templates/layout.php',['content'=>$content]);
    }
    else if($_SESSION['type']='Student'){
        header('Location:../other/student/student.php');
    }

}
else{
    header('Location:login.php');
}
?>


