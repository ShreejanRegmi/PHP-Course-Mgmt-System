<?php 
if(!isset($_SESSION)){session_start();}  

if(isset($_GET['message'])){
  $message= $_GET['message'];
  unset($_GET);
  echo "<script type='text/javascript'>alert('$message');</script>"; 
}
?>

<link rel="stylesheet" href="../css/bulma.css">

<link rel="stylesheet" href="../css/for.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" />
<script src="../css/jquery.js"></script>

<a href="gotologin.php">
  <i class="fas fa-backspace" style="font-size:20px; padding:10px;color:white;"></i>
</a>


<form action='checkAnswer.php' method="POST">


  <p class="subtitle is-size-5" id="what">Answer</p>
  <div class="field">
  <input type="text" class="input is-hovered" id="sec_question" required>
  </div>
  <div class="field">
    <input type="text" class="input" placeholder="Enter  your answer "  name="sec_answer">
  </div>
  <button class="button is-success is-pulled-right" id="submitAnswer">Continue</button>
  <br>

</form>



<script>


function loadQuestion(table , field, value){
   $.ajax({
        url:'../classes/getDetails.php',
        method:'POST',
        data:{table:table, field:field, value:value},
        success:function(dd){
          console.log(dd);
                if(dd!=false){
                  $('#sec_question').val(dd.sec_question);
                }

        }
   });


}

var id = <?php echo json_encode($_SESSION['id']) ?>;
var table = <?php echo json_encode($_SESSION['table']) ?>;
var field = <?php echo json_encode($_SESSION['field']) ?>;


console.log(id);
console.log(table);
console.log(field);


loadQuestion(table,field,id);

</script>