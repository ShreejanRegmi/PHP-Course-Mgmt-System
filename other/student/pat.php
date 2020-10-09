<?php
require 'functions.php';
require '../../db/dbconnect.php';


if(!isset($_SESSION)){session_start();}  

$inserts = templateLoad('patlayout.php',[]);
echo templateLoad('slayout.php',['inserts'=>$inserts]);

?>