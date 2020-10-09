<?php


$pdo= new PDO('mysql:dbname=csy2027e;host=localhost','root','');
    require_once '../classes/Table.php';

    $applicationTable= new Table('applications');
    
    if(isset($_POST['submit-button'])){
        if($_POST['level']==1)
            $_POST['intake']=2013;
        else if($_POST['level']==2)
            $_POST['intake']=2012;
        else if($_POST['level']==3)
            $_POST['intake']=2011; 
        $_POST['s_qualifications']=$_FILES['s_qualifications']['name'];
        
        unset($_POST['submit-button']);
       $applicationTable->groupProjectSave($_POST, 'application_id'); 
       $target="../applications/".basename($_FILES['s_qualifications']['name']) ;
       move_uploaded_file($_FILES['s_qualifications']['tmp_name'], $target);
       header('Location:index.php');
    }

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">




<div class=" card appform"> 
    <header class="card-header title is-4" style="padding:8px;">Application Form</header>

    <form id="application-form" action="" method="POST" enctype="multipart/form-data"> 
    <!-- for name -->
            <div class="field">
                <label class="label">Name</label>
                <div class="field-body is-horizontal">
                    <div class="field">
                    <p class="control is-expanded has-icons-left">
                        <input name="s_firstname" id="appFname" class="input is-hovered" type="text" placeholder="Firstname" required>
                        <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                        </span>
                    </p>
                    </div>
                    <div class="field">
                    <p class="control is-expanded has-icons-left has-icons-right">
                        <input name="s_lastname" id="appLname" class="input is-hovered" type="text" placeholder="Surname" required>
                    </p>
                    </div>
                </div>
        </div>

            <!-- For address -->
        <div class="field">
                <label class="label">Address</label>
            <div class="field-body ">
                <input id ="appAddress" type="text" placeholder="Address" name="s_address" class="input is-hovered" required>        
            </div>
        </div>

        
         <!-- for contact -->
        <div class="field">
        <label class="label">Contact</label>
        <div class="control has-icons-left has-icons-right">
            <input name="s_contact" id="appContact" class="input is-hovered" type="text" placeholder="Contact Number" required>
            <span class="icon is-small is-left">
            <i class="fas fa-phone"></i>
            </span>
        </div>
        </div>

     


        <!-- For email -->
        <div class="field">
        <label class="label">Email</label>
        <div class="control has-icons-left has-icons-right">
            <input name="s_email" id="appEmail" class="input is-hovered" type="email" placeholder="Email" required>
            <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
            </span>
        </div>
        <!-- <p class="help is-danger">This email is invalid</p> -->
        </div>

                <!-- For date of birth    -->
                 <div class="field">
                        <label class="label">Date of birth</label>
                    <input name="s_dob" type="date"  id="appDob" required>
                </div>

                <div class="field">
        <label class="label">Level:</label> 
            <div class="select">
                <select name="level" id="appLevel">
                <option value="1">Level 1</option>
                <option value="2">Level 2</option>
                <option value="3">Level 3</option>
                </select>
            </div>
        </div>



                    <!-- for file -->
               <div class="field">
                  <label class="label">Application:</label>
                            <input name="s_qualifications" type="file" class="is-primary" name="appF" onchange="appFile(this)" required>
                              <p class="help is-danger invalidtype">Must be in pdf</p>
                </div>
                        
                <!-- Submit button -->
                <div class="field ">
                    <div class="control ">
                        <button id="submit-buttonid" type="submit" name="submit-button" form="application-form" class="button is-dark">Submit</button>
                    </div>
        </div>
               
    </form>
</div>    

<style>

.appform{
  margin-left:10%;
  margin-right:10%;
  margin-top:1%;
  padding:18px;
  margin-bottom:20px;
}

html{
  background: #00c9ff;
  background: -webkit-linear-gradient(to right, #00c9ff, #92fe9d);
  background: linear-gradient(to right, #00c9ff, #92fe9d);
  
}
.invalidtype{
    display:none;
}


</style>

<script>
function appFile(file){
    document.getElementsByClassName("invalidtype")[0].style.display="none";
    var fileName=file.value;
    document.getElementById('submit-buttonid').disabled=false;
    if(fileName){
        
        var pdf_ext = "pdf";
        var file_ext = fileName.split('.').pop().toLowerCase(); 
        if(pdf_ext!=file_ext){
         document.getElementsByClassName("invalidtype")[0].style.display="inline-flex";
        document.getElementById('submit-buttonid').disabled=true;    
        }
        else{
            document.getElementsByClassName("file-name")[0].innerHTML="File inserted";
        }
    }  



}

</script>

