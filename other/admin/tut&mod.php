
<?php 
require '../../db/dbconnect.php';
require '../../classes/headerInfo.php';
require '../../classes/Table.php';
$tm= new setHeader();
$tm->setInfo(' <i class="fas fa-puzzle-piece"></i> Tutor & Modules');
$tm->addactionButtons([]);

echo $tm->placeHeader();
?>


<div style="padding:8px;margin:5px;margin-top:20px;">
    <div id="tandm">
    <table class='table table is-bordered is-striped is-narrow is-hoverable is-fullwidth' >  
               <tr class='Theader'> 
                    <th>Id</th> 
	               <th >Name</th>  
	               <th >Modules</th>  
	               <th >Action</th>  
	           </tr>
    <?php

    $stmt= $pdo->prepare('Select s.staff_id, s.s_firstname ,s.s_lastname FROM staff s WHERE s.s_type!="Admin"');
    $stmt->execute();
    foreach ($stmt as $st) {?>
            <tr>
                <td><?=$st['staff_id']?></td>
                <td><?=$st['s_firstname']." ".$st['s_lastname']?></td>
                <td>
                    <?php  
                    $mQ=$pdo->prepare('SELECT m_code FROM teacher_modules WHERE staff_id=:st');
                    $mQ->execute(['st'=>$st['staff_id']]);
                        foreach($mQ as $m){
                    ?>
                        <span class="tag is-danger is-medium">
                            <?=$m['m_code']?>
                        <button class="delete dModule is-small" id="<?=$st['staff_id']?>" value="<?=$m['m_code']?>"></button>
                        </span>
                    <?php }?>
                </td>
                <td><button class="button addTModule is-success" id="<?=$st['staff_id']?>"><i class="fas fa-plus"></i>Add</button></td>
            </tr>
   <?php }  ?>

    </table>
    </div>
</div>

<div class="modal" id="dmModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Delete</p> 
      <button class="delete" id="clModal" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
        <input type="hidden" id="staffM" val="" >
       Do you want to delete?
    </section>
      <footer class="modal-card-foot is-right">
        <button  class="button is-danger confirmTMDelete" value="">Delete</button>
      </footer>
  </div>
 
</div>

<div class="modal" id="addTM">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Add Module</p>
      <button class="delete" id="hideaddTM" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
    <label class="label">Select Module</label>
        <div class="select">
            <select id="newTM">
            <?php 
                $modules = new Table('modules');
                $module = $modules->groupProjectFindAll();
                foreach ($module as $m) { ?>
                    <option value="<?=$m['m_code']?>"><?=$m['m_name']." (".$m['m_code'].")"?></option>
               <?php }
            
            ?>
            </select>
        </div>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" id="confirmADDT">Save</button>
    </footer>
  </div>
</div>



<script>

$('.dModule').click(function(){
    $('#dmModal').toggleClass('is-active');
    $('.confirmTMDelete').val($(this).val());
    $('#staffM').val($(this).attr('id'));
});

$('#clModal').click(function(){
    $('#dmModal').removeClass('is-active');
});

$('.confirmTMDelete').click(function(){
    $.ajax({
              url:"../other/admin/deleteTM.php",
              method:"POST",
              data:{ m_code:$('.confirmTMDelete').val(),staff_id:$('#staffM').val()},
              success:function(data){
                  console.log(data);
                if(data=='tmDeleted'){
                    loadTM();
                }
              }
      });  
});


$('.addTModule').click(function(){
    $('#addTM').toggleClass('is-active');
    $('#confirmADDT').val($(this).attr('id'));
});

$('#hideaddTM').click(function(){
    $('#addTM').removeClass('is-active');
});

$('#confirmADDT').click(function(){
    $.ajax({
              url:"../other/admin/addTM.php",
              method:"POST",
              data:{ m_code:$('#newTM').val(),staff_id:$('#confirmADDT').val()},
              success:function(data){
                  console.log(data);
                if(data.TMAdded==true){
                    loadTM();
                }
              }
      });  
});
</script>
