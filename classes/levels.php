<?php
class setLevels{

public $levels=[];

public function addLevels($levels){
    $this->levels[]=$levels;
 }


 public function showLevels(){

$panel='<div class=" card level" style="padding:10px;margin-top:20px;">';  
foreach ($this->levels as $values) {
    foreach ($values as $key => $value) {
        $panel.='<div class="level-item">';
        $panel.=$value;
        $panel.=' </div>';
    }
  }
$panel.='</div>';

return $panel;

 }
  
}


?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">