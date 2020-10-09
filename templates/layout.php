<?php 
require 'links.php';

function myStaffProfilePic($id){
  $pics =new Table('staff_profile_pic');
  $pic = $pics->groupProjectFind('staff_id',$id);
  if($pic->rowCount()>0){
     foreach($pic as $p){
          echo "<img  id='myprofilePic'  src='../images/staffPics/".$p['image']."' style='margin-right:5px;width:50px;height:80px;'  >";
     }     
  }
  else{ echo ' <i id="myprofilePic" class="fas fa-user-circle" style="margin-right:10px;font-size:25px;"></i>';}
}


if(!isset($_SESSION)){session_start();}  



function loadStaffProfilePic(){
  global $pdo;
  $photo = $pdo->prepare('SELECT image FROM staff_profile_pic WHERE staff_id=:s_id');
  $photo->execute(['s_id'=>$_SESSION['id']]);
  $p=$photo->fetchColumn();
  return $p;
}

function loadStaffProfileId(){
  global $pdo;
  $photoI = $pdo->prepare('SELECT sp_id FROM staff_profile_pic WHERE staff_id=:s_id');
  $photoI->execute(['s_id'=>$_SESSION['id']]);
  $pI=$photoI->fetchColumn();
  return $pI;
}



?>
<script src="../classes/loadRoutine.js"></script>
<script src="../js/calender.js"></script>
<header>
<nav class="navbar is-primary" role="navigation" aria-label="main navigation"  >
    <div class="navbar-brand"style="margin-left:20px;padding:3px;"> 
        
          <img src="../images/w.png" style=" padding: 3px;width: 120px;
          border:3px solid rgba(255,255,255,0.6);
          border-radius: 11px;">

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>

    </div>
  
    <div id="navbarBasicExample" class="navbar-menu">

      <div class="navbar-end">


       <!-- User stuff -->
                  <div class="navbar-item has-dropdown is-hoverable" style="padding:20px;">
                        <a class="navbar-link is-active">
                        <div id="myprofilePic">
                            <?php  myStaffProfilePic($_SESSION['id']);?>
                        </div>
                             <div>
                                <p  id="myName" class="subtitle is-6" style="color:black;"><?=" " . $_SESSION['username'] ?></p>
                             </div>
                        </a>
                          <div class="navbar-dropdown">
                                  <a  id="changeP" class="navbar-item">
                                    Change Password
                                  </a>
                                  <hr class="navbar-divider">

                                  <a  id="setSecurity" class="navbar-item">
                                          Set Security Question
                                  </a>
                                  <hr class="navbar-divider">
                                  <a href="../templates/logout.php" class="navbar-item">
                                    <div><i class="fas fa-power-off"></i>Logout</div>
                                  </a>    

                          </div>
                    </div>

       </div>
    </div>

  </nav>
</header>


<div class="modal" id="secureModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Set Security Question</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
        <form  id="securityAnswerForm" >
          <div class="field">
            <label  class="label">Question:</label>
            <input type="text" name="sec_question" id="sec_question" class="input" required>
          </div>
          <div class="field">
          <label class="label">Answer</label>
          <input type="text" name="sec_answer" id="sec_answer" class="input" required>
          </div>
          <input type="submit" value="Save" class="button is-info">
        </form>
    </section>
    <footer class="modal-card-foot">
    </footer>
  </div>
</div>





        <div class="modal" id="changePModal" >
          <div class="modal-background"></div>
          <div class="modal-card" style="width:60%;">
            <header class="modal-card-head">
              <p class="modal-card-title"> 
              <i class="fas fa-shield-alt"></i>
                Change Password   
                </p>
              <button class="delete" id="closeP" aria-label="close"></button>
            </header>
            <section class="modal-card-body">

                <form id="changePassForm">
                  <div class="field">
                      <p class="control has-icons-left ">
                        <input class="input" id="oldP" name="oldP" type="password" placeholder="Old Password" required>
                        <span class="icon is-small is-left">
                        <i class="fas fa-unlock"></i>
                        </span>
                      </p>
                  </div>


                  <div class="field">
                      <p class="control has-icons-left ">
                        <input class="input" id="newP" name="newP" type="password" placeholder="New Password"  required>
                        <span class="icon is-small is-left">
                        <i class="fas fa-key"></i>
                        </span>
                      </p>
                  </div>

                  <div style="text-align:center;">
                  <i  id="myPasswords" class="fas fa-eye" style="font-size:30px;"></i>
                  </div>

                  <input type="submit" value="Save" class="button is-info">
                
                </form>

            </section>
            <footer class="modal-card-foot">
            </footer>
          </div>
        </div>



        <div class="modal" id="imageModal">
  <div class="modal-background"></div>
  <div class="modal-card" style="width:60%;">
    <header class="modal-card-head">
      <p class="modal-card-title">Profile Picture</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
  <?php
      if(loadStaffProfilePic()!=''){
          echo "<img src='../images/staffPics/".loadStaffProfilePic()."' style='width:200px;'  >";
      }

      ?>
        <form  id="imageForm">
            <input type="file" name="image"  class="input-file" required>
            <input type="hidden" name="sp_id" value="<?=loadStaffProfileId();?>" class="idimage">
            <button type="submit" class="is-primary">Save</button>
        
        </form>

    </section>
    <footer class="modal-card-foot">
    </footer>
  </div>
</div>



<main>
   

<?= $content;?>


</main>

<footer id="footer">
 Copyright &#169; <?= date("Y") ?>. Woodland University College
</footer>







  <style>
    .navbar{
        border-bottom: 1px solid lightgrey;
    }
  
    .navbar-item:hover{
      transition: all 0.2s ease-in-out;
    }
    #footer{
        background-color: #0A0A0A; 
        padding:9px;
        text-align:center;
        color:white;
    }
    main{
        min-height:83vh;
       
    }
    #sidebar{
        position:fixed;
        top:60vh;
        background-color:rgb(0,0,0,0.1);
        cursor:pointer;
       
    }
    
    .entry{
        padding:20px;
    }
   
  
  </style>

  <script>


  
  $(document).ready(function() {

// Check for click events on the navbar burger icon
$(".navbar-burger").click(function() {

    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
    $(".navbar-burger").toggleClass("is-active");
    $(".navbar-menu").toggleClass("is-active");

});
var modal = document.getElementById("routineModal");

    $("#changeP").click(function() {
        $("#changePModal").toggleClass("is-active");
        $("#oldP").val('');
        $("#newP").val('');
    });

    $("#closeP").click(function() {
        
        $("#changePModal").removeClass("is-active");
    });


$session_id = <?= $_SESSION['id']?>;

function rS($id){
  $.ajax({  
                url:"../classes/returnLevel.php",
                method:"POST",
                data:{id:$id},
                success:function(data){ 
                  shMyRoutine(data);
                }  
           }) ; 
}

$('#setSecurity').click(function(){
    $("#secureModal").toggleClass('is-active');
});
function loadmySec($id){
   $.ajax({
        url:'../classes/getDetails.php',
        method:'POST',
        data:{table:'staff_security',field:'staff_id',value:$id},
        success:function(dd){
          
                if(dd!=false){
                  $('#sec_question').val(dd.sec_question);
                  $('#sec_answer').val(dd.sec_answer);
                }
        }
   });
}

loadmySec($session_id);


$('#myprofilePic').click(function(){
  $('#imageModal').toggleClass('is-active');
  
});




$('form#securityAnswerForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'../templates/setSecurity.php',
        method:'POST',
        data:formData,
        success:function(rest){
          alert(rest.what);
               location.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


$('form#imageForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'../classes/addStaffProfile.php',
        method:'POST',
        data:formData,
        success:function(res){
           
            if(res.picStat!='Upload supported file only'){
              location.reload();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});



function shMyRoutine(data){
  $.ajax({
           url:"../other/admin/allroutines.php",
           method:"POST",
           data:{ level:data},
           success:function(response){
                    loadRoutine("#myRoutine",response.file);
                }
           });
}

function shMyAnnouncement(data){
  $.ajax({
           url:"../other/student/announcementForme.php",
           method:"POST",
           data:{ level:data},
           success:function(response){
                    loadRoutine("#myRoutine",response.file);
                }
        });

}


rS($session_id);

var myPass =document.getElementById("myPasswords");
var oldP =document.getElementById("oldP");
var newP =document.getElementById("newP");

myPass.addEventListener("click", function(){ 

  if(oldP.type == 'password'){
    oldP.type="text";
    newP.type="text";
    myPass.classList.add("fa-eye-slash");
  }

  else{
    oldP.type="password";
    newP.type="password";
    myPass.classList.remove("fa-eye-slash");
  }

}); 



$('form#changePassForm').submit(function(e){

e.preventDefault();
    $.ajax({
        url:'../templates/changePassword.php',
        method:'POST',
        data:{oldP:$('#oldP').val(),newP:$('#newP').val(),field:'staff_id'},
        dataType:'json',
        success:function(res){
          alert(res.result);
          
          if(res.result=='Password Changed'){
            window.location="../templates/logout.php";
          }
        
        }
    });
});









});

</script>


 

