<?php 
class setHeader{

public $info;
public $actionButtons=[];

public function setInfo($info){
    $this->info=$info;
}

public function addactionButtons($actionButtons){
$this->actionButtons[]=$actionButtons;
}

public function placeHeader(){
  $header='<div class="card" style="padding:20px;">';
$header .='<div class=" level headerInfo">';
$header.='<div class="level-left">
            <div class="level-item">
                <div class="title has-text-primary is-5">';
                  $header.=$this->info;
$header.='</div></div></div>';
$header.='<div class="level-right">';

foreach ($this->actionButtons as $values) {
    foreach ($values as $key => $value) {
        $header.=' <div class="level-item">';
        $header.=$value;
        $header.=' </div>';
    }
  }

$header.='</div></div></div>';
return $header;
}

}


?>
