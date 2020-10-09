<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
    function setFields($file){
        $theFile=fopen($file, 'r');
        $row=fgetcsv($theFile);
        $firstname=$row[0];$lastname=$row[1];$address=explode(",", $row[2]);
        $street=$address[0];$city=$address[1];$country=$address[2];$contact=$row[3];$email=$row[5];$dob=explode("-", $row[4]);
        $day=$dob[2];$month=$dob[1];$year=$dob[0];$level=$row[6];
 
?>
        <script>
            $(document).ready(function(){
                $('#firstname').val("<?php echo $firstname; ?>");
                $('#lastname').val("<?php echo $lastname; ?>");
                $('#street').val("<?php echo $street; ?>");
                $('#city').val("<?php echo $city ?>");
                $('#country').val("<?php echo $country; ?>");
                $('#contact').val("<?php echo $contact; ?>");
                $('#email').val("<?php echo $email; ?>");
                $('#day').val("<?php echo $day; ?>");
                $('#month').val("<?php echo $month; ?>");
                $('#year').val("<?php echo $year; ?>");
                $('#level').val("<?php echo $level; ?>");
            });
        </script>
<?php 
    }
    if(isset($_POST['import'])){
        setFields($_FILES['csv']['tmp_name']);
    }
    
?>


<!-- back key redirects to home -->
<i class="fas fa-arrow-left" style="font-size:20px;color:#fff; cursor:pointer;margin:5px;"></i>

<div class=" card appform"> 
    <header class="card-header title is-4" style="padding:8px;">Application Form</header>
                 <form method="POST" action="" enctype="multipart/form-data">
                     <input type="file" name="csv" required="">
                    <input type="submit" name="import" value="Import">
                </form>

    <form> 
    <!-- for name -->
            <div class="field">
                
                <label class="label">Name</label>
                <div class="field-body is-horizontal">
                    <div class="field">
                    <p class="control is-expanded has-icons-left">
                        <input id="firstname" class="input is-hovered" type="text" placeholder="Firstname" required>
                        <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                        </span>
                    </p>
                    </div>
                    <div class="field">
                    <p class="control is-expanded has-icons-left has-icons-right">
                        <input id="lastname" class="input is-hovered" type="email" placeholder="Surname" required>
                    </p>
                    </div>
                </div>
        </div>

            <!-- For address -->
        <div class="field">
                <label class="label">Address</label>
            <div class="field-body is-horizontal">
                <input id="street" type="text " placeholder="Street" name="street" class="input is-hovered" required>
                <input id="city" type="text" placeholder="City" name="city" class="input is-hovered" required>
                <input id="country" type="text" placeholder="Country" name="country" class="input is-hovered" required>        
            </div>
        </div>

        
         <!-- for contact -->
        <div class="field">
        <label class="label">Contact</label>
        <div class="control has-icons-left has-icons-right">
            <input id="contact" class="input is-hovered" type="text" placeholder="Contact Number" required>
            <span class="icon is-small is-left">
            <i class="fas fa-phone"></i>
            </span>
        </div>
        </div>

        <!-- For email -->
        <div class="field">
        <label class="label">Email</label>
        <div class="control has-icons-left has-icons-right">
            <input id="email" class="input is-hovered" type="email" placeholder="Email" required>
            <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
            </span>
        </div>
        <!-- <p class="help is-danger">This email is invalid</p> -->
        </div>

                <!-- For date of birth    -->
                 <div class="field">
                        <label class="label">Date of birth</label>
                    <div class="field-body is-horizontal">
                            <div class="select">
                            <select id="day" name="day is-hovered">
                            <?php
			                    for ($i = 1; $i < 32; $i++) {
				                    echo '<option value="' . $i . '">' . $i  . '</option>';
                                    }
                                ?>
                            </select>
                            </div>

                            <div class="select is-hovered">
                                    <select id="month" name="month" >
                                    <?php
                                        $months = ['', 'January', 'Feburary', 'March', 
                                        'April', 'May', 'June', 'July', 'August', 'September', 
                                        'October', 'November', 'December'];
                                        for ($i = 1; $i < 13; $i++) {
                                            if ($i < 10) {
                                                echo '<option value="0' . $i . '">' . $months[$i]  . '</option>';	
                                            }
                                            else {
                                                echo '<option value="' . $i . '">' . $months[$i]  . '</option>';
                                            }			
                                        }
                                    ?>
                                    </select>
                            </div>


                            <div class="select is-hovered">
                            <select id="year" name="year">
                                    <?php
                                        for ($i = 1970; $i < 2019; $i++) {
                                            echo '<option value="' . $i . '">' . $i  . '</option>';
                                        }
                                    ?>
		                    </select>
                            </div>     
                    </div>
                </div>

                 <div class="field">
                    <label class="label">Level</label>
                    <select id="level" name="level">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                    <!-- for file -->
               <div class="field">
                  <label class="label">Application:</label>
                            <input type="file" class="is-primary" name="appF" onchange="appFile(this)">
                              <p class="help is-danger invalidtype">Must be in pdf</p>
                </div>
                        
                <!-- Submit button -->
                <div class="field ">
                    <div class="control ">
                        <button class="button is-dark">Submit</button>
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
    
    if(fileName){
        
        var pdf_ext = "pdf";
        var file_ext = fileName.split('.').pop().toLowerCase(); 
        if(pdf_ext!=file_ext)
        document.getElementsByClassName("invalidtype")[0].style.display="inline-flex";
        else{
            document.getElementsByClassName("file-name")[0].innerHTML="File inserted";
        }
    }  



}
</script>