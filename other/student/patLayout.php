<?php 
 if(!isset($_SESSION)){session_start();}  
 require '../../classes/Table.php';
 require '../../classes/headerInfo.php';

function patStat($stat){
    if($stat =="true"){
        return 'is-success';
    }
    else if($stat=='progress'){
        return 'is-warning';
    }
    else{
        return 'is-danger';
    }

}


 function iconChoose($string){
     if($string=='true'){
        return '<i class="fas fa-check"></i>';
     }

    if($string=='false'){
        return '<i class="fas fa-times-circle"></i>';
    }

     if($string=='progress'){
        return '<i class="fas fa-spinner"></i>' ;
     }   

 }
 
$pat = new setHeader();
$pat->setInfo('<i class="fas fa-hands-helping"></i> Personal Academic Tutoring');
$pat->addactionButtons([]);
echo $pat->placeHeader();

?>

<div  class="columns" style="margin:20px;">

<div class="tile  is-ancestor">
<div class="column">
    <article class=" tile is-child box">
      <p class="title is-5 panel-block"><i class="fab fa-creative-commons-share" style="margin-top:2px;margin-right:10px;"></i> Apply</p>
        <form  id="patForm">

        <div class="field">
            <label class="label">Date</label>
            <div class="control has-icons-left ">
                <input class="input" name="date" type="date" min="<?=  date("Y-m-d");?>" required>
                <span class="icon is-small is-left">
                    <i class="fas fa-calendar-alt"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label">Time</label>
            <div class="control has-icons-left">
                <input class="input" name="time" type="time" required>
                <span class="icon is-small is-left">
                    <i class="fas fa-clock"></i>
                </span>
            </div>
        </div>
        
        <div class="field">
            <label class="label">Query</label>
            <div class="control">
                <textarea name="query"  style="resize:none;width:100%;height:150px;" required></textarea>
               
            </div>
        </div>
        
        <input type="submit" value="Save" class="button is-success">
        
        </form>     
    </article>
  </div>

  <div class="tile is-child box column is-parent">
                    <article style="margin-left:10px;">
                            <p class="subtitle">Previous:</p>

                        <?php 
                            $pats = new Table('pat_session');
                            $pat=$pats->groupProjectFind('s_id',$_SESSION['id']);
                            foreach($pat as $p){
                        ?>
                            <div class="notification is-info <?= patStat($p['attended'])  ?>">
                            <button class="delete"></button>
                               <?=iconChoose($p['attended']);?>
                                <?=$p['query']?>
                                <p class=" has-text-right"><i class="fontg far fa-calendar-alt"></i> <?=$p['date'].' @ '.$p['time']?></p>
                            </div>

                        <?php }?>   

                    </article>
                </div>
</div>


</div>

<style>
.fontg{
    margin-right:5px;
}


</style>


<script>

$('form#patForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'addPat.php',
        method:'POST',
        data:formData,
        success:function(res){
            alert(res.dataSent);
            location.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


</script>