<?php 

function liveOrDormant($status){
    if($status =='live'){
            return '<i class="fas fa-running"></i> Live';
    }
    else{
        return '<i class="fas fa-bed"></i> Dormant';
    }
}


?>