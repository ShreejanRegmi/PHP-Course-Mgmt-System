<?php 
require '../../classes/headerInfo.php';
require '../../classes/levels.php';

$patSesh= new setHeader();
$patSesh->setInfo('  <i class="fas fa-hands-helping"></i> PAT Sessions');
$patSesh->addactionButtons(['']);
echo $patSesh->placeHeader();


?>