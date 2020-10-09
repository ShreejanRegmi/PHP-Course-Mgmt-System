<link rel="stylesheet" href="../../css/bulma.css" />
<link rel="stylesheet" href="../../css/bulma-badge.min.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script type="text/javascript" src="../../classes/loadRoutine.js"></script>
<script type="text/javascript" src="../../js/calender.js"></script>
<script type="text/javascript" src="../../css/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/ribbon.css">

<?php 

 if(!isset($_SESSION)){session_start();}  
   require '../../templates/getSProfilePicture.php';
   require '../../db/dbconnect.php';

  
   function countN(){
     global $pdo;
    $notify = $pdo->prepare('SELECT COUNT(*) FROM notifications WHERE s_id=:s_id');
    $notify->execute(['s_id'=>$_SESSION['id']]);
    $n=$notify->fetchColumn();
    return $n;
  }

  function loadProfilePic(){
    global $pdo;
    $photo = $pdo->prepare('SELECT image FROM student_profile_pic WHERE s_id=:s_id');
    $photo->execute(['s_id'=>$_SESSION['id']]);
    $p=$photo->fetchColumn();
    return $p;
  }

  function loadProfileId(){
    global $pdo;
    $photoI = $pdo->prepare('SELECT sp_id FROM student_profile_pic WHERE s_id=:s_id');
    $photoI->execute(['s_id'=>$_SESSION['id']]);
    $pI=$photoI->fetchColumn();
    return $pI;
  }

  
  
 ?>

<header>
<nav class="navbar is-primary" role="navigation" aria-label="main navigation"  >
    <div class="navbar-brand"style="margin-left:20px;padding:3px;"> 
        <a href="student.php">
          <img src="../../images/w.png" style=" padding: 3px;width: 120px;
          border:3px solid rgba(255,255,255,0.6);
          border-radius: 11px;">
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>

    </div>
  
    <div id="navbarBasicExample" class="navbar-menu">

      <div class="navbar-end">

       <a href="student.php" class="navbar-item">
          Home
        </a>
  
        
  

            <!-- Notificaions -->
                  <a class="navbar-item" href="notifications.php">
                    
                        <div class="column">
                            <span class="badge is-badge-success" data-badge="<?=countN();?>" style="padding:6px;">
                            <i class="fas fa-bell"></i>     Notifications
                            </span>
                        </div>
                    
                        
                  </a>



       <!-- User stuff -->
                  <div class="navbar-item has-dropdown is-hoverable" style="padding:20px;">
                        <a class="navbar-link is-active">
                        <div >
                            <?php  myProfilePic($_SESSION['id']);?>
                        </div>
                             <div>
                                <p class="subtitle is-6"><?=" " . $_SESSION['username'] ?></p>
                             </div>
                        </a>
                          <div class="navbar-dropdown">
                          <a  id="changeP" class="navbar-item">
                                    Change Password
                                  </a>
                                  <a  id="changeDet" class="navbar-item">
                                    My Details
                                  </a>
                                  <a  id="setSecurity" class="navbar-item">
                                          Set Security Question
                                  </a>
                                  <hr class="navbar-divider">
                                  <a href="../../templates/logout.php" class="navbar-item">
                                    <div><i class="fas fa-power-off"></i>Logout</div>
                                  </a>    
                          </div>
                    </div>

       </div>
    </div>

  </nav>
</header>

<main>
  <?=$inserts?>
</main>



<footer id="footer">
 Copyright &#169; <?= date("Y") ?>. Woodland University College
</footer>

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


<div class="modal" id="routineModal" >
          <div class="modal-background"></div>
          <div class="modal-card" style="width:80%;">
            <header class="modal-card-head">
              <p class="modal-card-title"> 
                <img src="../../images/routine.png" alt="routine"style="width:25px;"> 
                Routine    
                </p>
              <button class="delete" id="closeRoutine" aria-label="close"></button>
            </header>
            <section class="modal-card-body" id="myRoutine" style="overflow-x: scroll;">
              <!-- Content ... -->
            </section>
          </div>
  </div>

  <div class="modal" id="announcementModal" >
          <div class="modal-background"></div>
          <div class="modal-card" style="width:80%;">
            <header class="modal-card-head">
              <p class="modal-card-title"> 
                <img src="../../images/announce.png" alt="routine"style="width:25px;"> 
                 Announcements  
                </p>
              <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body" id="allAnnounces" style="overflow-x: scroll;">
              <!-- Content ... -->
            </section>
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
      if(loadProfilePic()!=''){
          echo "<img src='../../images/studentPics/".loadProfilePic()."' style='width:200px;'  >";
      }

      ?>
        <form  id="imageForm">
            <input type="file" name="image"  class="input-file" required>
            <input type="hidden" name="sp_id" value="<?=loadProfileId();?>" class="idimage">
            <button type="submit" class="is-primary">Save</button>
        
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
 </div>  



 <div class="modal" id="detailModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title"> <i class="fas fa-info-circle"></i> Change My Details</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <form action="" id="detailForm">
        <input type="hidden" name="s_id" value="<?=$_SESSION['id']?>">
      <div class="field">
                <label class="label">Name</label>
                <div class="field-body is-horizontal">
                    <div class="field">
                    <p class="control is-expanded has-icons-left">
                        <input name="s_firstname" id="detFname" class="input is-hovered" type="text" placeholder="Firstname" required>
                        <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                        </span>
                    </p>
                    </div>
                    <div class="field">
                    <p class="control is-expanded has-icons-left has-icons-right">
                        <input name="s_lastname" id="detLname" class="input is-hovered" type="text" placeholder="Surname" required>
                    </p>
                    </div>
                </div>
        </div>

            <!-- For address -->
        <div class="field">
                <label class="label">Address</label>
            <div class="control has-icons-left field-body ">
                <input id ="detAddress" type="text" placeholder="Address" name="s_address" class="input is-hovered" required>  
                <span class="icon is-small is-left">
                <i class="fas fa-address-card"></i>   
                </span>   
            </div>
        </div>

        
         <!-- for contact -->
        <div class="field">
        <label class="label">Contact</label>
        <div class="control has-icons-left ">
            <input name="s_contact" id="detContact" class="input is-hovered" type="text" placeholder="Contact Number" required>
            <span class="icon is-small is-left">
            <i class="fas fa-phone"></i>
            </span>
        </div>
        </div>

     


        <!-- For email -->
        <div class="field">
        <label class="label">Email</label>
        <div class="control has-icons-left has-icons-right">
            <input name="s_email_address" id="detEmail" class="input is-hovered" type="email" placeholder="Email" required>
            <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
            </span>
        </div>
   
        </div>

                <!-- For date of birth    -->
                 <div class="field">
                        <label class="label">Date of birth</label>
                    <input name="s_dob" type="date"  id="detpDob" required>
                </div>
      
        <input type="submit" value="Save" class="is-pulled-right button is-success">

      </form>






    </section>
    <footer class="modal-card-foot">
    </footer>
  </div>
</div>


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

    

   
  
  </style>

  <script>


$session_id = <?= $_SESSION['id']?>;
$session_level=<?= $_SESSION['id']?>;


$('#setSecurity').click(function(){
    $("#secureModal").toggleClass('is-active');
});

function loadmySec($id){
   $.ajax({
        url:'../../classes/getDetails.php',
        method:'POST',
        data:{table:'student_security',field:'student_id',value:$id},
        success:function(dd){
          
                if(dd!=false){
                  $('#sec_question').val(dd.sec_question);
                  $('#sec_answer').val(dd.sec_answer);
                }
        }
   });
}

$('form#securityAnswerForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'../../templates/setSecurity.php',
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



loadmySec($session_id);
  
  $("#openRoutine").click(function() {
        $("#routineModal").toggleClass("is-active");
    });

    $(".delete").click(function() {
        
        $(".modal").removeClass("is-active");
    });

$("#openAnnouncement").click(function(){
    $("#announcementModal").toggleClass("is-active");
});




function rS($id){
  $.ajax({  
                url:"../../classes/returnLevel.php",
                method:"POST",
                data:{id:$id},
                success:function(data){ 
                  shMyRoutine(data);
                  shMyAnnounce(data);
                }  
           }) ; 
}





function shMyRoutine(data){
  $.ajax({
           url:"../../other/admin/allroutines.php",
           method:"POST",
           data:{ level:data},
           success:function(response){
                    var dir = "../../csv/";
                    var file= response.file;
                    var load = dir.concat(file);
                    loadRoutine("#myRoutine",load);
                }
           });
}




function shMyAnnounce(data){
  $.ajax({
           url:"seeannouncements.php",
           method:"POST",
           data:{ level:data},
           success:function(response){
                      $('#allAnnounces').html(response);
                }
           });
}

rS($session_id);




$(".navbar-burger").click(function() {
  $(".navbar-burger").toggleClass("is-active");
  $(".navbar-menu").toggleClass("is-active");
});


function countNoti(){
    var id =<?=$_SESSION['id']?>;
    $.ajax({
        url:'countnotification.php',
        method:'POST',
        data:{s_id:id},
        success:function(res){
            
        }
    });
}

$('#myprofilePic').click(function(){
  $('#imageModal').toggleClass('is-active');
  
});

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




$("#changeP").click(function() {
    $("#changePModal").toggleClass("is-active");
    $("#oldP").val('');
    $("#newP").val('');
});

$("#closeP").click(function() {
    
    $("#changePModal").removeClass("is-active");
});

$('form#imageForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'addProfile.php',
        method:'POST',
        data:formData,
        success:function(res){
            alert(res.picStat);
            if(res.picStat!='Upload supported file only'){
              location.reload();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

$('form#detailForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'addDetails.php',
        method:'POST',
        data:formData,
        success:function(rest){
           alert("Requests sent!");
           $('.modal').removeClass('is-active');
           
        },
        cache: false,
        contentType: false,
        processData: false
    });
});



$('form#changePassForm').submit(function(e){

e.preventDefault();
    $.ajax({
        url:'../../templates/changePassword.php',
        method:'POST',
        data:{oldP:$('#oldP').val(),newP:$('#newP').val(),field:'s_id'},
        dataType:'json',
        success:function(res){
          alert(res.result);
          
          if(res.result=='Password Changed'){
            window.location="../../templates/logout.php";
          }
        
        }
    });
});



$('#changeDet').click(function(){
   $('#detailModal').toggleClass('is-active');
});



function getDetails(){
  var sid=<?=$_SESSION['id']?>;
  $.ajax({
        url:'../../classes/getDetails.php',
        method:'POST',
        data:{table:'students',field:'s_id',value:sid},
          success:function(dt){
            $('#detFname').val(dt.s_firstname);
            $('#detLname').val(dt.s_lastname);
            $('#detAddress').val(dt.s_address);
            $('#detContact').val(dt.s_contact);
            $('#detEmail').val(dt.s_email_address);
            $('#detpDob').val(dt.s_dob);
          }
  });
}

getDetails();


  </script>


  
     
