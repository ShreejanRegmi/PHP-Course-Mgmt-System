
<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';

$fName= $_POST["contentFile"] . '_' .$_FILES['fileContent']['name'];
move_uploaded_file($_FILES['fileContent']['tmp_name'],"../../fileContent/{$fName}");

$moduleFiles= $pdo -> prepare("INSERT INTO module_files (mc_id, mc_filename) VALUES (:mc_id, :mc_filename)");
           
$pass=["mc_id"=>$_POST["contentFile"], "mc_filename"=> $fName];

if($moduleFiles->execute($pass)){ 
    header('Location:../../public_html');  
}

   
 

?>