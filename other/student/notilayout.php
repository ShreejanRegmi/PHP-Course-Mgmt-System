<?php 
require '../../classes/Table.php';
require '../../db/dbconnect.php';
if(!isset($_SESSION)){session_start();}  


?>

<div style="margin:40px;">
    <nav class="panel">
    <p class="panel-heading">
    <i class="fas fa-bell"></i>  Notifications
    </p>
   
 <?php 
    $notifications = $pdo->prepare('SELECT * FROM notifications JOIN module_content WHERE notifications.mc_id=module_content.mc_id AND s_id=:s_id ');
        $notifications->execute(['s_id'=>$_SESSION['id']]);

    if($notifications->rowCount()>0){
        foreach($notifications as $not){
 
 ?>
    <a  id="<?=$not['n_id'].','.$not['m_code']?>" class=" panel-block is-active notLink">
            
        <span class="panel-icon">
            <i class="far fa-bell"></i>
        </span>
       <?='New content added on '.$not['m_code'].'  ( '.$not['mc_title']. ' - '. substr($not['mc_description'],0,3). '......)  
       
       '?>
       <p  class="is-hidden-mobile  has-text-weight-light is-italic subtitle is-6 "style="margin-left:50%;color:#6d8891;"><?='@ '.$not['n_timestamp']?></p>
    </a>
    
        <?php } ?>

    <div class="panel-block">
        <button id="clearNoti" class="button is-link is-outlined is-fullwidth">
       Reset all notifications
        </button>
    </div>

    </nav>
</div>

        <?php }
        
        else{?>
                <a class="panel-block" style="padding:20px;">
                    No notifications found
                </a>

       <?php }?>


<script>

$('.notLink').click(function(){

    var codes=$(this).attr('id');
    var nsid= codes.split(',')[0];
    var mcode=codes.split(',')[1];

    var init ="module.php?m_code=";
    var url=init.concat(mcode);


    $.ajax({
        url:'deleteNotification.php',
        method:'POST',
        data: {action: 'specific',nid:nsid},
         success: function(output) {
            window.location = url;
         
        }

    });
    
});

$('#clearNoti').click(function(){
    $.ajax({
        url:'deleteNotification.php',
        method:'POST',
        data: {action: 'all'},
         success: function(output) {
            location.reload();
        }

    });

});




</script>