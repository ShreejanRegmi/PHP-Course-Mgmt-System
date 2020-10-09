<?php 
if(!isset($_SESSION)){session_start();}  
$pdo= new PDO('mysql:dbname=csy2027e;host=localhost', 'root', '');


if(isset($_POST["submit"])){

    if($_SESSION['table']=='staff_security'){
            $table =$pdo->prepare('UPDATE staff SET s_password=:pass WHERE staff_id=:id');
    }

    else{
        $table =$pdo->prepare('UPDATE students SET s_password=:pass WHERE s_id=:id');   
    }

    $pcrit=['pass'=>password_hash($_POST['newpass'], PASSWORD_DEFAULT),'id'=>$_SESSION['id']];

        if($table->execute($pcrit)){
            header('Location:gotologin.php');
        }
    

}

?>

<link rel="stylesheet" href="../css/bulma.css">

<link rel="stylesheet" href="../css/for.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" />
<script src="../css/jquery.js"></script>

<a href="gotologin.php">
  <i class="fas fa-backspace" style="font-size:20px; padding:10px;color:white;"></i>
</a>

<form action="updatePassword.php" method="POST">    
<p class="title is-size-5">Change Password</p>

<input type="password" class="input" name="newpass" placeholder="New password" required>

<br>
<br>
<input type="submit" name="submit" class="button is-success is-pulled-right" value="Submit">
<br>

</form>