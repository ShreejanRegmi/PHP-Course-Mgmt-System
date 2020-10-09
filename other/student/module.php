<?php 
require 'functions.php';
require '../../db/dbconnect.php';


if(!isset($_SESSION)){session_start();}  

$inserts= templateLoad('modulelayout.php',['code'=>$_GET['m_code']]);
echo templateLoad('slayout.php',['inserts'=>$inserts]);


?>
