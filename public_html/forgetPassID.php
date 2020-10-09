<link rel="stylesheet" href="../css/bulma.css">
<link rel="stylesheet" href="../css/for.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" />

<a href="gotologin.php">
  <i class="fas fa-backspace" style="font-size:20px; padding:10px;color:white;"></i>
</a>

<form action='checkId.php' method="POST">

  <p class="subtitle is-size-5">Id:</p>
  <div class="field">
  <input type="text" class="input is-hovered" placeholder="Enter your id"  name="sid" id="id" required>
  
  </div>
  <button class="button is-success is-pulled-right" id="submitId">Continue</button>
  <br>
</form>


<?php 

if(isset($_GET['message'])){
  $message= $_GET['message'];
  unset($_GET);
  echo "<script type='text/javascript'>alert('$message');</script>"; 
}

?>






