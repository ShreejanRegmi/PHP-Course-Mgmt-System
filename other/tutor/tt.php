<?php
 if(!isset($_SESSION)){session_start();}  
$pdo= new PDO('mysql:dbname=csy2027e;host=localhost', 'root', '');?>
<div class="tutorContent">
<section class="section  has-background-light">
    <p class="title is-4">Choose Modules:</p>
    <div class="container">
        <div class="columns is-multiline" style="margin:20px;" >

        <?php
             global $pdo;
            $staffQuery = $pdo->prepare("SELECT * FROM teacher_modules WHERE staff_id=:id");
            $staffQuery->execute(['id'=>$_SESSION['id']]);
            foreach ($staffQuery as $staff) {?>
                <div class="column ">
                        <div class="notification is-info" style=" display:block;padding:50px;text-align:center;height:50vh;">
                            <div>
                                <img src="../images/clock.png" style="width:200px;">
                            </div>
                            <div>
                                <a class="button is-info teachthisModule" id="<?=$staff['m_code']?>">
                                <p class="title is-4"><u><?= $staff['m_code'];?></u></p>
                                </a>
                            </div>
                        </div>  
                </div>
                <?php }?>
        </div>
    </div>
</section>
</div>



<style>
.section{
    margin-top:40px;
}

</style>

<script>
<?php 
global $pdo;
$st= $pdo->prepare("SELECT count(*) FROM teacher_modules WHERE staff_id=:id");
$st->execute(['id'=>$_SESSION['id']]);
$count=$st->fetchColumn();
?>
var countModules = <?=$count;?>;

console.log(countModules);

$('.teachthisModule').click(function(){
    $otw =$(this).attr('id');
    loadDashboard($otw);
});

function loadDashboard($otw){
    $.ajax({
    url:"../other/tutor/moduleLayout.php",
			method:"POST",
			success:function(data)
			{$('.tutorContent').html(data);
            $('#currentModuleTut').val($otw);
            }

    });
}

</script>

