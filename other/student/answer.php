<?php 
require 'functions.php';
require '../../db/dbconnect.php';


if(!isset($_SESSION)){session_start();}  

$inserts= templateLoad('answersof.php',['d_id'=>$_GET['d_id']]);
echo templateLoad('slayout.php',['inserts'=>$inserts]);


?>
