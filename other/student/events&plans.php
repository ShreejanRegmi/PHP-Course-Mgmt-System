<?php 
require 'functions.php';
require '../../db/dbconnect.php';



$inserts = templateLoad('eventLayout.php',[]);
echo templateLoad('slayout.php',['inserts'=>$inserts]);

?>