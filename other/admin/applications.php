<?php 
require '../../classes/headerInfo.php';
require '../../classes/levels.php';
require 'applicationScript.php';

function import($file){
  global $pdo;
  $theFile= fopen($file, 'r');
  
  while ($eachRow=fgetcsv($theFile)) {
      $arguments= "'".implode("','", $eachRow)."'";
    $insertStmt=$pdo->prepare("INSERT INTO applications(s_firstname, s_lastname, s_address, s_contact, s_dob, s_email, level, intake, s_qualifications) VALUES (".$arguments.")");
    if($insertStmt->execute()){
      echo '<script>alert("Inserted!!!")</script>';
    }
    else{
      echo 'Fail';
    }
    
  }
}


if (isset($_POST['importCsv'])) {
  import($_FILES['csv']['tmp_name']);
}

$app= new setHeader();
$app->setInfo('<i class="fas fa-envelope-open-text"></i> Applications');
$app->addactionButtons(['<button id="importCsvApp" class="button is-success"><i class="fas fa-plus" style="margin-right:10px;"></i>  Import</button>


']);

echo $app->placeHeader();


?>

<div style="text-align:center;margin-top:30px;">

<div class="tabs is-centered is-boxed">
  <ul class="appTabs">
    <li class="is-active">
      <a id="showappPend">
      <i class="material-icons" style="margin-right:10px;">filter_1</i>All
      </a>
    </li>

    <li>
      <a id="showappCond">
        <i class="material-icons" style="margin-right:10px;">filter_2</i>Conditional
      </a>
    </li>
    
    <li>
      <a id="showappAccept">
      <i class="material-icons" style="margin-right:10px;">filter_3</i>Accepted
      </a>
    </li>

    <li>
      <a id="showappReject">
     <i class="material-icons" style="margin-right:10px;">filter_4</i>Rejected
      </a>
    </li>

  </ul>
</div>

</div>




<div class="card" style="margin-top:30px;padding:20px;">
   
    <div class="allapplicants" style="overflow-x:scroll;">
    </div>
</div>

<div class="modal" id="appApprovalModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Approval</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
            <div class="field">
                <label class="label">Accepted :</label>
                <div class="select">
                    <select id="appApprovestatus">
                        <option value="accepted">Unconditionally</option>
                        <option value="conditional">Conditionally</option>
                    </select>
                </div>
            </div>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" id="confirmappApproval">Save</button>
    </footer>
  </div>
</div>


<div class="modal" id="applicantModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Applicant</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
            <div id="applicantDetails">
            </div>
    </section>
    <footer class="modal-card-foot">
    </footer>
  </div>
</div>



<div class="modal" id="importAppModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Import</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">

    <form method="POST" id="importForm" action="applications.php" enctype="multipart/form-data">
        <input type="file" name="csv" onchange="appFile(this)" required>
        <input type="submit" name="importCsv" id="submit-buttonid" value="Import">
        <p class="help is-danger">Must be in csv format</p>
	</form>
    </section>
    <footer class="modal-card-foot">
    </footer>
  </div>
</div>




<script>

$('#importCsvApp').click(function(){
  $('#importAppModal').toggleClass('is-active');
  document.getElementById('importForm').reset();
});


function tabActiveStatus(){
                var li = $(".appTabs li");
            li.each(function(idx, li) {
                $(li).removeClass('is-active');
            });
}



$('.appTabs li').click(function(){
    tabActiveStatus();
    $(this ).toggleClass('is-active');
 });

allApplied();

$("#showappPend").click(function(){
    allApplied();
});


$("#showappCond").click(function(){
    showConditionalApplicants();
});


$("#showappAccept").click(function(){
    finalizedApp('accepted');
});

$("#showappReject").click(function(){
    finalizedApp('rejected');
});



function appFile(file){
    var fileName=file.value;
    document.getElementById('submit-buttonid').disabled=false;
    if(fileName){
        var csv_ext = "csv";
        var file_ext = fileName.split('.').pop().toLowerCase(); 
        if(csv_ext!=file_ext){
        document.getElementById('submit-buttonid').disabled=true;    
        }
       
    }  



}
</script>

