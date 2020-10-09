<?php 

function createPassword($id,$firstname){
    $lastThree =substr($firstname,0,3);
    $combined= $id.$lastThree;
  return password_hash($combined, PASSWORD_DEFAULT);
}

?>