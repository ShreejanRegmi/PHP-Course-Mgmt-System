<?php 
require 'functions.php';
require '../../db/dbconnect.php';


if(!isset($_SESSION)){session_start();}  

$inserts= templateLoad('attendancelay.php',[]);
echo templateLoad('slayout.php',['inserts'=>$inserts]);


?>
